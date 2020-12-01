<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Units;
class ControllerUnits extends Controller
{
   public function view(){
    	$units = Units::All();
    	return view('backend.layouts.units.unitsview', compact('units'));
    }
    public function add(){
    	return view('backend.layouts.units.unitsadd');
    }
    public function store(Request $request){
    	$insert_units = new Units();
    	$insert_units->name = $request->name;
    	$insert_units->save();
    	return redirect()->route('units.view')->with('success','Unit Insert Successful');
    }
    public function edit($id){
        $edit_units = Units::findorfail($id);
        return view('backend.layouts.units.editunits',compact('edit_units'));
    }
    public function update(Request $request, $id){
        //$validatedData = $request->validate([
            //'email' =>'unique:users,email',
        //]);
        $update_units = Units::findorfail($id);
        $update_units->name = $request->name;
        $update_units->save();
        return redirect()->route('units.view')->with('success','Unit Update Successful');
    }
    public function delete(Request $request){
        $deleteunit = Units::findorfail($request->id);
        $deleteunit->delete();
        return redirect()->route('units.view')->with('success','Unit Delete Successful');
    }
}
