<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Suppliers;
class ControllerSuppliers extends Controller
{
    public function view(){
    	$suppliers = Suppliers::All();
    	return view('backend.layouts.suppliers.suppliersview', compact('suppliers'));
    }
    public function add(){
    	return view('backend.layouts.suppliers.suppliersadd');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'email' =>'required|unique:users,email',
        ]);
    	$insert_supplier = new Suppliers();
    	$insert_supplier->name = $request->name;
    	$insert_supplier->mobile = $request->mobile;
    	$insert_supplier->email = $request->email;
    	$insert_supplier->address = $request->address;
    	$insert_supplier->save();
    	return redirect()->route('suppliers.view')->with('success','Supplier Insert Successful');
    }
    public function edit($id){
        $edit_supplier = Suppliers::findorfail($id);
        return view('backend.layouts.suppliers.editsuppliers',compact('edit_supplier'));
    }
    public function update(Request $request, $id){
        //$validatedData = $request->validate([
            //'email' =>'unique:users,email',
        //]);
        $update_supplier = Suppliers::findorfail($id);
        $update_supplier->name = $request->name;
        $update_supplier->mobile = $request->mobile;
        $update_supplier->email = $request->email;
        $update_supplier->address = $request->address;
        $update_supplier->save();
        return redirect()->route('suppliers.view')->with('success','Supplier Update Successful');
    }
    public function delete(Request $request){
        $deletesupplier = Suppliers::findorfail($request->id);
        $deletesupplier->delete();
        return redirect()->route('suppliers.view')->with('success','Supplier Delete Successful');
    }
}
