<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Products;
use App\Model\Suppliers;
use App\Model\Categorys;
use App\Model\Units;
use Auth;
class ControllerProducts extends Controller
{
     public function view(){
    	$products = Products::all();
    	return view('backend.layouts.products.view-products', compact('products'));
    }

    public function add(){
    	$add_product['suppliers'] = Suppliers::all();
    	$add_product['categorys'] = Categorys::all();
    	$add_product['units'] = Units::all();
    	return view('backend.layouts.products.add-products', $add_product);
    }

    public function store(Request $request){
    	$store_product = new Products();
    	$store_product->supplier_id = $request->supplier_id;
    	$store_product->category_id = $request->category_id;
    	$store_product->name = $request->name;
    	$store_product->unit_id = $request->unit_id;
    	$store_product->quantity = '0';
    	$store_product->created_by = Auth::User()->id;
    	$store_product->save();
    	return redirect()->route('products.view')->with('success', 'Product Insert Successfully');
    }
    
    public function edit($id){
    	$data['editData'] = Products::find($id);
    	$data['suppliers'] = Suppliers::all();
    	$data['categorys'] = Categorys::all();
    	$data['units'] = Units::all();
    	return view('backend.layouts.products.edit-products',$data);
    }

     public function update(Request $request,$id){
    	$updateProduct = Products::find($id);
    	$updateProduct->supplier_id = $request->supplier_id;
    	$updateProduct->category_id = $request->category_id;
    	$updateProduct->name = $request->name;
    	$updateProduct->unit_id = $request->unit_id;
    	$updateProduct->updated_by = Auth::User()->id;
    	$updateProduct->save();
    	return redirect()->route('products.view')->with('success', 'Product Update Successfully');
    }

    public function delete(Request $request){
    	$productDelete = Products::find($request->id);
    	$productDelete->delete();
    	return redirect()->route('products.view')->with('success', 'Product Deleted Successfully');
    }
}
