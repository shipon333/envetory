<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Products;
use App\Model\Suppliers;
use App\Model\Categorys;
use App\Model\Units;
use Auth;
use PDF;
class ControllerStocks extends Controller
{
    public function view(){
    	$products = Products::orderBy('supplier_id','desc')->orderBy('category_id','desc')->get();
    	return view('backend.layouts.stock.view-stock', compact('products'));
    }
    public function stockReport(){
    	$data['products'] = Products::orderBy('supplier_id','desc')->orderBy('category_id','desc')->get();
	    $pdf = PDF::loadView('backend.layouts.pdf.stock-report-pdf', $data);
	      $pdf->SetProtection(['copy', 'print'], '', 'pass');
	      return $pdf->stream('document.pdf');
    }
    public function stockSupplier(){
    	$data['suppliers'] = Suppliers::All();
    	$data['categorys'] = Categorys::All();
    	$data['products'] = Products::all();
    	return view('backend.layouts.stock.supplier-stock',$data);
    }
    public function stockSupplierPdf(Request $request){
    	$data['products'] = Products::orderBy('supplier_id','desc')->orderBy('category_id','desc')->where('supplier_id',$request->supplier_id)->get();
	    $pdf = PDF::loadView('backend.layouts.pdf.supplier-stock-report-pdf', $data);
	      $pdf->SetProtection(['copy', 'print'], '', 'pass');
	      return $pdf->stream('document.pdf');
    }
    public function stockProductPdf(Request $request){
    	$data['products'] = Products::where('category_id',$request->category_id)->where('id',$request->product_id)->first();
	    $pdf = PDF::loadView('backend.layouts.pdf.product-stock-report-pdf', $data);
	      $pdf->SetProtection(['copy', 'print'], '', 'pass');
	      return $pdf->stream('document.pdf');
    }
}
