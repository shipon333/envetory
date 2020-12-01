<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
class ControllerProfiels extends Controller
{
     public function view(){
    	$id = Auth::User()->id;
	   	$profiels = User::find($id);
    	return view('backend.layouts.users.profiels', compact('profiels'));
    }
    public function edit(){
        $id = Auth::User()->id;
	   	$editprofiles = User::find($id);
	   	return view('backend.layouts.users.editprofile', compact('editprofiles'));
    }
    public function update(Request $request){
        $validatedData = $request->validate([
            'image' => ' mimes:jpeg,jpg,png,PNG | max:1000',
         ]);
   		$update_profile = User::find(Auth::User()->id);
   		$update_profile->name = $request->name;
   		$update_profile->email = $request->email;
   		$update_profile->mobile = $request->mobile;
   		$update_profile->address = $request->address;
   		$update_profile->gender = $request->gender;
   		
   		if ($request->file('image')){
   			$file = $request->file('image');
   			@unlink(public_path('upload/users/'.$update_profile->image));
   			$filename = date('YmdHi').$file->getClientOriginalName();
   			$file->move(public_path('upload/users'),$filename);
   			$update_profile['image']=$filename;
   		}
		    $update_profile->save();
   		return redirect()->route('profiles.view')->with('success','Profile Update Successful');
    }
    public function changePassword(){
      return view('backend.layouts.users.change_password');
   }
   public function updatePassword(Request $request){
      if (Auth::attempt(['id'=>Auth::user()->id, 'password'=>$request->old_password])) {
         $user = User::find(Auth::User()->id);
         $user->password = bcrypt($request->new_password);
         $user->save();
          return redirect()->route('profiles.view')->with('success','Password Update successful');
      }
      else{
            return redirect()->back()->with('error','Sorry Old Password dos not match!');
      }
   }
}
