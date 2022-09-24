@extends('master')
@section('content')
  @if(count($posts) > 0)
     <h1 class="page-header">Search Page </h1>
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
            
         <hr>
         <P class="lead">
         {{ $post->body }}


         </P>
         
         <a href="{{ url('/posts/'.$post->id)  }}" class="btn btn-info">ReadMore<span class="glyphicon glyphicon-chevron-right"></span></a>
       </div>
     </div>
     <hr>

     @endforeach
      <hr>
   
      <div class="text-center">
        {{ $posts->links() }}
      </div>
  @else
   <div class="alert alert-danger" v-show="!showpost">Sorry There Are No Posts {{ $title }}</div>
 @endif

@endsection
