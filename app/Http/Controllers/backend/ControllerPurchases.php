<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Products;
use App\Model\Suppliers;
use App\Model\Categorys;
use App\Model\Units;
use App\Model\Purchases;
use Auth;
use DB;
class ControllerPurchases extends Controller
{
    public function view(){
      $view_purchases = Purchases::orderBy('date','desc')->orderBy('id','desc')->get();
      return view('backend.layouts.purchases.view-purchase',compact('view_purchases'));
    }

    public function add(){
      $add_purchases['suppliers'] = Suppliers::all();
      $add_purchases['units'] = Units::all();
      $add_purchases['categories'] = Categorys::all();
      return view('backend.layouts.purchases.add-purchase',$add_purchases);
    }

    public function store(Request $request){
      if($request->category_id == null){
            return redirect()->back()->with('error','Sorry! you do not select any item');
        }else{
            $count_category = count($request->category_id);
            for ($i=0; $i <$count_category ; $i++) { 
                $purchase = new Purchases();
                $purchase->date = date('Y-m-d',strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];
                $purchase->created_by = Auth::user()->id;
                $purchase->status = '0';
                $purchase->save();
            }
        }

        return redirect()->route('purchases.view')->with('success','Purchase insert successfully');
    }

    public function delete(Request $request){
        $purchase = Purchases::find($request->id);
        $purchase->delete();
        return redirect()->route('purchases.view')->with('success','Purchases deleted successfully');
    }

    public function pendingList(){
    	$pending_purchases = Purchases::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
      	return view('backend.layouts.purchases.pending-purchase',compact('pending_purchases'));
    }
    public function approved($id){
        $purchase = Purchases::find($id);
        $product = Products::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            DB::table('purchases')
                    ->where('id', $id)
                    ->update(['status' => 1]);
        }
        return redirect()->route('purchases.pending.view')->with('success','Purchases approved successfully');
    }
}
