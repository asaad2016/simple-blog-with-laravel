<?php

namespace App\Http\Controllers;
use App\User;

use Auth;
use Illuminate\Http\Request;
use DB;
class SessionController extends Controller
{
  private $usernameinput;
  
   public function create(){ 
  
     return view("content.login");

   }
   public function store(Request $request){
     $this->validate(request(),[
      'email' => 'required',
      'password' => 'required'

      ]);
    $email=$request->email;
    $password=$request->password;
     if (!Auth::attempt(['email' => $email, 'password' => $password])){

       return back()->withErrors(['message' => 'Email or Password Not Valid']);
 	 }   
    return redirect('/posts');
    
   }
  public function destory(){   
 	  auth()->logout();
    return redirect("/login");
   }
  public function password(){
   
    return view("content.password");  
   }
  public function cpassword(){
   
    return view("content.password");  
   }
  public function confirmpassword(Request $request){
      $confirm=DB::table("users")->where("name",$request->name)->where("email",$request->email)->count();
      $request->session()->put("usernameinput",$request->name);
     
      if($confirm > 0){
        
        return redirect("/newpassword");
      }
      else{
         return redirect()->back();
      }
   }
   public function updatepassword(){
      return view("content.newpassword");
      
   }
    public function createpassword(Request $request,User $user){
        $this->validate($request,[
            'password' => 'required|min:3',
          ]);
       
        $password=$request->password;
        $username=  $request->session()->get("usernameinput");
        $userupdate=$user->where("name",$username)->first();
       
        $userupdate->fill(['password'=> bcrypt($request->password)])->save();
     return redirect('/posts');
   }
}
