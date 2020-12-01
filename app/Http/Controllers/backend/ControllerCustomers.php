<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Customers;
use App\Model\Payment;
use App\Model\PaymentDetail;
use PDF;
class ControllerCustomers extends Controller
{
   public function view(){
    	$customers = Customers::All();
    	return view('backend.layouts.customers.customersview', compact('customers'));
    }
    public function add(){
    	return view('backend.layouts.customers.customersadd');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'email' =>'required|unique:customers,email',
        ]);
    	$insert_customers = new Customers();
    	$insert_customers->name = $request->name;
    	$insert_customers->mobile = $request->mobile;
    	$insert_customers->email = $request->email;
    	$insert_customers->address = $request->address;
    	$insert_customers->save();
    	return redirect()->route('customers.view')->with('success','Customers Insert Successful');
    }
    public function edit($id){
        $edit_customers = Customers::findorfail($id);
        return view('backend.layouts.customers.editcustomers',compact('edit_customers'));
    }
    public function update(Request $request, $id){
        //$validatedData = $request->validate([
            //'email' =>'unique:users,email',
        //]);
        $update_customers = Customers::findorfail($id);
        $update_customers->name = $request->name;
        $update_customers->mobile = $request->mobile;
        $update_customers->email = $request->email;
        $update_customers->address = $request->address;
        $update_customers->save();
        return redirect()->route('customers.view')->with('success','Customers Update Successful');
    }
    public function delete(Request $request){
        $deletecustomers = Customers::find($request->id);
        $deletecustomers->delete();
        return redirect()->route('customers.view')->with('success','Customers Delete Successful');
    }
    public function report(){
        $alldata = Payment::whereIn('paid_status',['partial_paid','full_due'])->get();
        return view('backend.layouts.customers.customers-report-view', compact('alldata'));
    }
    public function reportPdf(){
        $data['coustomer'] = Payment::whereIn('paid_status',['partial_paid','full_due'])->get();
      $pdf = PDF::loadView('backend.layouts.pdf.coustomer-cradit-pdf', $data);
      $pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('document.pdf');
    }
    public function cusEditIncoice($invoice_id){
         $payment = Payment::where('invoice_id',$invoice_id)->first();
        // dd($payment->toArray());
        return view('backend.layouts.customers.edit-invoice',compact('payment'));
    }
    public function cusUpdateIncoice(Request $request,$invoice_id){
         if($request->new_paid_amount<$request->paid_amount){
            return redirect()->back()->with('error','Sorry! you have paid maximum value');
        }else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if($request->paid_status=='full_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;
            }elseif($request->paid_status=='partial_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->save();
            return redirect()->route('customers.report.view')->with('success','Invoice Successfully Updated');
        }
    }
    public function cusDetailsIncoice($invoice_id){
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('backend.layouts.customers.details-invoice',compact('payment'));
    }
    public function cusDetailsIncoicePdf($invoice_id){
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $pdf = PDF::loadView('backend.layouts.pdf.coustomer-invoice-details-pdf', $data);
      $pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('document.pdf');
    }
    public function Paidreport(){
        $allData = Payment::where('paid_status','!=','full_due')->get();
        // dd($allData->toArray());
        return view('backend.layouts.customers.paid-customer',compact('allData'));
    }
    public function PaidreportPdf(){
         $data['allData'] = Payment::where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('backend.layouts.pdf.coustomer-paid-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function CustomerWiseReport(){
        $customers = Customers::all();
        return view('backend.layouts.customers.customer-wise-report',compact('customers'));
    }

    public function CustomerWiseCreditReport(Request $request){
        $data['allData'] = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('backend.layouts.pdf.customer-wise-credit-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function CustomerWisePaidReport(Request $request){
        $data['allData'] = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('backend.layouts.pdf.customer-wise-paid-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
