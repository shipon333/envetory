<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Products;
use App\Model\Suppliers;
use App\Model\Categorys;
use App\Model\Units;
use App\Model\Purchases;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Customers;
use Auth;
use DB;
use PDF;
class ControllerInvoices extends Controller
{
    public function view(){
      $view_invoice = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
      return view('backend.layouts.invoice.view-invoice',compact('view_invoice'));
    }

    public function add(){
      $add_invoice['categories'] = Categorys::all();
      $invoice_data = Invoice::orderBy('id','desc')->first();
      if ($invoice_data == null) {
      	$firstReg = '0';
      	$add_invoice['invoice_no'] = $firstReg + 1; 
      }
      else{
      	$invoice_data = Invoice::orderBy('id','desc')->first()->invoice_no;
      	$add_invoice['invoice_no'] = $invoice_data + 1;
      }
      $add_invoice['customers'] = Customers::all();
      $add_invoice['date'] = date('Y-m-d');
      return view('backend.layouts.invoice.add-invoice',$add_invoice);
    }

    public function store(Request $request){
      if($request->category_id == null){
            return redirect()->back()->with('error','Sorry! you do not select any Product');
        }
      else{
            if ($request->paid_amount>$request->estimated_amount) {
              return redirect()->back()->with('error','Sorry! Paid Amount is maximum than total Price');
            }
            else{
                // dd('ok');
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d',strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::User()->id;
                DB::transaction(function() use($request,$invoice) {
                    if($invoice->save()){
                        $count_category = count($request->category_id);
                        for ($i=0; $i <$count_category; $i++) { 
                           $invoice_details = new InvoiceDetail();
                           $invoice_details->date = date('Y-m-d',strtotime($request->date));
                           $invoice_details->invoice_id = $invoice->id;
                           $invoice_details->category_id = $request->category_id[$i];
                           $invoice_details->product_id = $request->product_id[$i];
                           $invoice_details->selling_qty = $request->selling_qty[$i];
                           $invoice_details->unit_price = $request->unit_price[$i];
                           $invoice_details->selling_price = $request->selling_price[$i];
                           $invoice_details->status = '0';
                           $invoice_details->save();
                        }
                        if($request->customer_id == '0'){
                            $customer = new Customers();
                            $customer->name = $request->name;
                            $customer->mobile = $request->mobile_no;
                            $customer->address = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;
                        }else{
                            $customer_id = $request->customer_id;
                        }
                        $payment = new Payment();
                        $payment_details = new PaymentDetail();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        if($request->paid_status=='full_paid'){
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        }elseif($request->paid_status=='full_due'){
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                        }elseif($request->paid_status=='partial_paid'){
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount-$request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();
                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('Y-m-d',strtotime($request->date));
                        $payment_details->save();
                    }
                });
            }
        }

        return redirect()->route('invoices.view')->with('success','Invoice insert successfully');
    }

    public function delete(Request $request){
        $invoice = Invoice::find($request->id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();
        return redirect()->route('invoices.pending.view')->with('success','Invoice deleted successfully');
    }

    public function pendingList(){
    	 $view_invoice = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
      return view('backend.layouts.invoice.view-invoice-pending',compact('view_invoice'));
    }
    public function approved($id){
        $invoice = Invoice::with(['invoice_details'])->find($id);

        return view('backend.layouts.invoice.invoice-approve',compact('invoice'));
    }
    public function approveStore(Request $request,$id){
      foreach ($request->selling_qty as $key => $val) {
      $invoice_detalis = InvoiceDetail::where('id',$key)->first();
      $product = Products::where('id',$invoice_detalis->product_id)->first();
      if($product->quantity < $request->selling_qty[$key]){
          return redirect()->back()->with('error','Sorry! You Approve Maximum Value');
        }
      }
      $invoice = Invoice::find($id);
      $invoice->approved_by = Auth::User()->id;
      $invoice->status = '1';
      DB::transaction(function() use($request,$invoice,$id){
        foreach ($request->selling_qty as $key => $val) {
            $invoice_detalis = InvoiceDetail::where('id',$key)->first();
            $invoice_detalis->status = '1';
            $invoice_detalis->save();
            $product = Products::where('id',$invoice_detalis->product_id)->first();
            $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
            $product->save();
          }
          $invoice->save();
      });
      return redirect()->route('invoices.pending.view')->with('success','Invoice Successfully Approved');
    }
    public function printingList(){
      $view_invoice = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
      return view('backend.layouts.invoice.printing-list',compact('view_invoice'));
    }
     function invoicePrint($id) {
      $data['invoice'] = Invoice::with(['invoice_details'])->find($id);
      $pdf = PDF::loadView('backend.layouts.pdf.invoice-pdf', $data);
      $pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('document.pdf');
    }
    public function delyReport(){
     return view('backend.layouts.invoice.dely-report');
    }
    public function delyReportPdf(Request $request){
      $sdate = date('Y-m-d',strtotime($request->start_date));
      $edate = date('Y-m-d',strtotime($request->end_date));
      $data['alldata'] = Invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->get();
      $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
      $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
      $pdf = PDF::loadView('backend.layouts.pdf.dely-report-pdf', $data);
      $pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('document.pdf');
    }
}
