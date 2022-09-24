@extends('master')
@section('content')
     <h1 class="page-header text-center">{{ $name }}</h1>
     @foreach($posts as $post)
     <div class="main-post">
       <h2 class="h1 post-head">
         <a href="{{ url('/posts/'.$post->id)  }}">
            {{ $post->title }}
         </a>
       </h2>
       <div class="content-post">
         <p class="lead">
            by:<a href="{{ url('/profile/' . Auth::user()->id ) }}"> {{ Auth::user()->name }}</a>
         </p>
         
         <p>
            <span class="glyphicon  glyphicon-time">posted on
            {{ $post->created_at }}

              </span>
         </p>
         <p>
            <img src="{{ url('/upload/'.$post->url) }}" style="max-width: 50%;background-color: #e2e2e2;padding: 10px;border: 1px solid #eee;">
         </p>  
       <hr>
         <P class="lead">
         {{ $post->body }}


         </P>
         <a href="{{ url('/posts/'.$post->id)  }}" class="btn btn-info">ReadMore<span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
     </div>
     <hr>

     @endforeach
    <div class="text-center poistionpost">
      {{ $posts->links() }}
  </div>
@stop