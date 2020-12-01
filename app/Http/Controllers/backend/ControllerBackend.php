<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class ControllerBackend extends Controller
{
    public function view(){
    	$users = User::All();
    	return view('backend.layouts.users.user', compact('users'));
    }
    public function add(){
    	return view('backend.layouts.users.adduser');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'email' =>'required|unique:users,email',
        ]);
    	$insert_user = new User();
    	$insert_user->usertype = $request->usertype;
    	$insert_user->name = $request->name;
    	$insert_user->email = $request->email;
    	$insert_user->password = bcrypt($request->password);
    	$insert_user->save();
    	return redirect()->route('user.view')->with('success','User Insert Successful');
    }
    public function edit($id){
        $edit_user = User::findorfail($id);
        return view('backend.layouts.users.edituser',compact('edit_user'));
    }
    public function update(Request $request, $id){
        //$validatedData = $request->validate([
            //'email' =>'unique:users,email',
        //]);
        $updateuser = User::findorfail($id);
        $updateuser->usertype = $request->usertype;
        $updateuser->name = $request->name;
        $updateuser->email = $request->email;
        $updateuser->save();
        return redirect()->route('user.view')->with('success','User Update Successful');
    }
    public function delete(Request $request){
        $deleteuser = User::findorfail($request->id);
        if(file_exists('public/upload/users/'.$deleteuser->image) AND !empty($deleteuser->image)){
            unlink('public/upload/users/'.$deleteuser->image);
        }
        $deleteuser->delete();
        return redirect()->route('user.view')->with('success','User Delete Successful');
    }
}
