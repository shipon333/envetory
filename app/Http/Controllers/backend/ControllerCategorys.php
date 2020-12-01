<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Categorys;
class ControllerCategorys extends Controller
{
    public function view(){
    	$categorys = Categorys::All();
    	return view('backend.layouts.categorys.categorysview', compact('categorys'));
    }
    public function add(){
    	return view('backend.layouts.categorys.categorysadd');
    }
    public function store(Request $request){
    	$insert_categorys = new Categorys();
    	$insert_categorys->name = $request->name;
    	$insert_categorys->save();
    	return redirect()->route('categorys.view')->with('success','Category Insert Successful');
    }
    public function edit($id){
        $edit_categorys = Categorys::findorfail($id);
        return view('backend.layouts.categorys.editcategorys',compact('edit_categorys'));
    }
    public function update(Request $request, $id){
        //$validatedData = $request->validate([
            //'email' =>'unique:users,email',
        //]);
        $update_categorys = Categorys::findorfail($id);
        $update_categorys->name = $request->name;
        $update_categorys->save();
        return redirect()->route('categorys.view')->with('success','Category Update Successful');
    }
    public function delete(Request $request){
        $deletecategorys = Categorys::findorfail($request->id);
        $deletecategorys->delete();
        return redirect()->route('categorys.view')->with('success','Category Delete Successful');
    }
}
