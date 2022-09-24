<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use Illuminate\Support\Facades\Auth;
use App\roles;
use App\User;
use App\comment;
use App\likes;
use DB;
use App\setting;
class PagesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function posts(){   
   	$posts=post::paginate(3);   
   	return view('content.posts',compact('posts'));
  }
   public function post(post $post){
     $comment1=DB::table("setting")->where('name','comment')->value('value');
      $posts=post::all();
   	return view('content.post',compact('post','comment1','posts'));
   }
   public function getpost($id){
    //return post::where("id",$id)->get();
    return $id;
   }
   public function store(Request $request){
   //post::create(request()->all()); this anthor function to add element in database
     $this->validate(request(),[
        'title'=>'required',
        'body'=>'required',
        'url'=>'image|mimes:jpg,png,gif,jpeg|max:2048'

      ]);
      $image_name=time() . '.' . $request->url->getClientOriginalExtension();
    	$post=new post;
    	$post->title=request('title');
    	$post->body=request('body');
      $post->userid=Auth::user()->id;
   
  
      $post->url=$image_name;
      $post->save();
      $request->url->move(public_path('upload'),$image_name);
     

     return redirect('/posts');
   }
   public function category($name){
      $cat=DB::table('Categories')->where('name',$name)->value('id');
      $posts=DB::table('posts')->where('category_id',$cat)->paginate(3);
      return view('content.category',compact('posts',"name"));
   }
   public function search(Request $request){
      $title=$request->title;
      $posts=DB::table('posts')->where('title','like','%' . $title . '%')->paginate(3);
    
      return view('content.search',compact('posts'));
   }
   public function admin(){
     $admin=User::all();
     $comment=DB::table("setting")->where('name','comment')->value('value');
     $register=DB::table("setting")->where('name','register')->value('value');
     return view('content.admin',compact('admin','comment','register'));
   }
  public function addrole(Request $request){
    $user=User::where('email',$request['email'])->first();
    $user->roles()->detach();
    if($request['admin']){
      $user->roles()->attach(roles::where('name','admin')->first());
    }
     if($request['editor']){
      $user->roles()->attach(roles::where('name','editor')->first());
    }
     if($request['user']){
      $user->roles()->attach(roles::where('name','user')->first());
    }
    return redirect()->back();
   }
  public function accessdenid(){
    return view('content.accessdenid');
  }
  public function setting(Request $request){
    
    if($request->commentsetting){
      
      DB::table("setting")->where('name','comment')->update(['value' => 1]);

    }else{
      DB::table("setting")->where('name','comment')->update(['value' => 0]);
    }
    if($request->registersettings){
      
      DB::table("setting")->where('name','register')->update(['value' => 1]);

    }else{
      DB::table("setting")->where('name','register')->update(['value' => 0]);
    }
    return redirect()->back();

   }
  public function like($id){
    
   $post_id=$id;
   $like= DB::table("likes")->where('post_id',$post_id)->where('user_id',Auth::user()->id)->first();
    if(!$like){
      $new_like=new likes();
      $new_like->user_id=Auth::user()->id;
      $new_like->post_id=$post_id;

      $new_like->likes=1;
      $new_like->save();
    }elseif($like->likes == 1){
       DB::table("likes")->where('post_id',$post_id)->where('user_id',Auth::user()->id)->delete();
    }
     elseif($like->likes == 0){
       DB::table("likes")->where('post_id',$post_id)->where('user_id',Auth::user()->id)->update(["likes" => 1]);
    }
    return redirect()->back();
  }
  public function dislike($id){
    //$like_s=$request->likes_s;
    $post_id=$id;
 
   $like= DB::table("likes")->where('post_id',$post_id)->where('user_id',Auth::user()->id)->first();
    if(!$like){
      $new_like=new likes();
      $new_like->user_id=Auth::user()->id;
      $new_like->post_id=$post_id;
      $new_like->likes=0;
      $new_like->save();
    }
    elseif($like->likes == 0){
       DB::table("likes")->where('post_id',$post_id)->where('user_id',Auth::user()->id)->delete();
    }
     elseif($like->likes == 1){
       DB::table("likes")->where('post_id',$post_id)->where('user_id',Auth::user()->id)->update(["likes" => 0]);
    }
   
    return redirect()->back();
  }
 public function stats(){
    $user=User::count();
    $comment=comment::count();
    $post=post::count();
    //user1
    $likes_count=User::withCount("likes")->orderBy("likes_count","desc")->first();

    $comment_count_1=comment::where("user_id",$likes_count->id)->count();
    $countlikescomment= $likes_count->likes_count + $comment_count_1;
     //user2
    $comment_count=User::withCount("comments")->orderBy("comments_count","desc")->first();
    $likes_count_1=likes::where("user_id",$comment_count->id)->count();
     $countcommentlike= $comment_count->comments_count + $likes_count_1;
     if($countlikescomment >  $countcommentlike){
      $likecommentcount=$likes_count->likes_count;
      $name=$likes_count->name;
      $likecomment=$comment_count_1;
     }
     else{
      $likecommentcount=$likes_count_1;
      $name=$comment_count->name;
      $likecomment=$comment_count->comments_count;
     }
    $arr=[
      "user" => $user,
      "comment" => $comment,
      "post" => $post,
      'likecount'=>$likecommentcount,
      'name'=>$name,
      'likecomment'=>$likecomment
    ];
    return view('content.stats',compact("arr"));

 }
  public function profile(Request $request){

    $user=Auth::user();
    return view('content.profile',compact("user"));
  }
  function notfountpage(){
    return view('content.page404');
  }
  public function edit($id,post $post){
    $post=$post->find($id);
    if(Auth::check()){ 
      if(!Auth::user()->hasRole('admin') || !Auth::user()->hasRole('editor') || !Auth::user()->id == $post->userid){
          return redirect("/posts/" . $id);
      }
    } 
   return view('content.postedit',compact('post'));
   }
  public function update($id,post $post,Request $request){
    $post=$post->find($id);
    if(Auth::check()){ 
      if(!Auth::user()->hasRole('admin') || !Auth::user()->hasRole('editor') || !Auth::user()->id == $post->userid){
          return redirect("/posts/" . $id);
      }
    } 
    $post->fill($request->all())->save();
    return redirect("/posts/" . $id);
   }
  public function delete($id,post $post){
    $post=$post->find($id);
    if(Auth::check()){ 
      if(!Auth::user()->hasRole('admin') || !Auth::user()->hasRole('editor') || !Auth::user()->id == $post->userid){
          return redirect("/posts/" . $id);
      }
    } 
    $post->delete();
    return redirect("/posts");
   }
}
