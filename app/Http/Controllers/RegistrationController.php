<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\roles;
use DB;

class RegistrationController extends Controller
{
	public function create(){
    $register=DB::table("setting")->where('name','register')->value('value');
    return view("content.register",compact('register'));

  
  }
  public function store(Request $request){
  	$user=new User;
  	$user->name=$request->name;
  	$user->email=$request->email;
  	$user->password=bcrypt($request->password);
   
  
   
   $user->save();
   $user->roles()->attach(roles::where("name","user")->first());
 	 auth()->login($user);
   
   return redirect("/posts");
  }
}
