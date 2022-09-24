@extends('master')
@section('content')
  
    <h1 class="page-header page-header-single text-center"> {{ $post->title }}
    </h1>
    <div class="main-post-single">
    <div class="content-post-single">
     	<p class="lead">
        by:<a href="{{ url('/profile/' . Auth::user()->id ) }}"> {{ Auth::user()->name }}</a>
     	</p>
     	
     	<p>
        <span class="glyphicon glyphicon-time">posted on {{ $post->created_at }}
        </span>
        <strong> Category :
          <a href="{{ url('/category/' . $post->category->name) }}" >
            {{ $post->category->name }}
          </a> 
       </strong>
       </p>
     	 <p>
        <?php
        $likesbutton="btn-default";
        $dislikesbutton="btn-default";
        $likecount=0;
        $dislikecount=0;
        foreach ($post->likes as $like) {
          if($like->likes == 1){
            $likecount++;
          }
          if($like->likes == 0){
            $dislikecount++;
          }
          if($like->likes == 1 && $like->user_id == Auth::user()->id){
           $likesbutton="btn-success";
          }
          if($like->likes == 0 && $like->user_id == Auth::user()->id){
            $dislikesbutton="btn-danger";
            }
          }

          ?>
          <a href="{{ url('/posts/like/' . $post->id) }}" class="like btn <?php echo $likesbutton; ?>" data-like="{{ $likesbutton }}" data-post="{{ $post->id }}">Like <span><?php echo $likecount; ?></span></a>
           <a href="{{ url('/posts/dislike/' . $post->id) }}" class="like btn <?php echo $dislikesbutton; ?>" data-like="{{ $dislikesbutton }}" data-post="{{ $post->id }}">DisLike <span><?php echo $dislikecount; ?></span></a>
           @if(Auth::check()) 
              @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor') || Auth::user()->id == $post->userid) 
                <a href="{{ url('/post/edit/' . $post->id) }}" class="btn btn-success">Edit</a>
                <a href="{{ url('/post/delete/' . $post->id) }}" class="btn btn-danger">Delete</a>
              @endif
            @endif
         </p>
         <p>
          <img src="{{ url('/upload/'.$post->url) }}" style="max-width: 50%;background-color: #e2e2e2;padding: 10px;border: 1px solid #eee;">
        </p>
       	<hr>
       	<P class="lead">
          {{ $post->body }}       
       	</P> 
      </div>
      <div class="comment-post">
        @if($comment1 == 1) 
        <p>
          @foreach($post->comments() as $comment)
            <p class="comment-body">
              {{ $comment->body }}
            </p>
          @endforeach
        </p>
      
        <div class="well">
      
          <h4>leave comment</h4>
          <form role="form" method="post" action="{{ url('/posts/'. $post->id . '/store') }}">
            {{ csrf_field() }}   
            <div class="form-group">
              <textarea name="body"  class="form-control" placeholder="comment" rows="3" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Comment</button>
          </form>
        
       

        </div>  
        @else
          <div class="alert alert-danger text-center h2">Comment Are Disable
          </div>
       @endif        
    </div>
    <div class="error">
      @foreach($errors->all() as $error)
        {{ $error }}
      @endforeach
    </div>
  </div>

@endsection
