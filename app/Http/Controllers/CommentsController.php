<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use App\comment;
class CommentsController extends Controller
{
 public function store($id,Request $request){
   
	  $comment=new comment();
	  $comment->body=$request->body;
	  $comment->post_id=$id;
	  $comment->save();
	   return back();
   }
}
