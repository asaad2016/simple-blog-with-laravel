@extends('master')
@section('content')
  <h1 class="page-header">المقالات </h1>
  @foreach($posts as $post)
    <div class="main-post">
      <h2 class="h1 post-head">
        <a href="{{ url('/posts/'.$post->id)  }}">

          {{ $post->title }}
        </a>
      </h2>
      <div class="content-post">
        <p class="lead">
          بواسطة:<a href="{{ url('/profile/' . Auth::user()->id ) }}"> {{ Auth::user()->name }}</a>
        </p>
       
        <p>
          <span class="glyphicon  glyphicon-time">Posted on
             {{ $post->created_at }}

          </span>
       </p>
            
       <hr>
       <P class="lead">
          {{  mb_substr($post->body,0,80) }}
       </P>
       
        <a href="{{ url('/posts/'.$post->id)  }}" class="btn btn-info">ReadMore<span class="glyphicon glyphicon-chevron-right"></span></a>
      </div>
     
    </div>
    <hr>
  @endforeach
  <hr>
  @if(Auth::check()) 
    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor')) 
      <form class="form-horizontal" role="form" method="POST" action="{{ url('/posts/store') }}"  enctype="multipart/form-data">
      {{ csrf_field() }}   
        <div class="form-group">
          <label class="col-sm-2 control-label">Title</label>
          <div class="col-sm-8 col-md-6">
               <input  type="text" name="title" id="title"  class="form-control"  />
          </div>
         </div>
         <div class="form-group">
            <label class="col-sm-2 control-label">Body</label>
            <div class="col-sm-8 col-md-6">
               <textarea name="body" id="body"  class="form-control"  ></textarea>          
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label" for="url">Image</label>
            <div class="col-sm-8 col-md-6">
               <input  type="file" name="url" id="url"  class="form-control"  />         
            </div>
          </div>
          <div class="form-group form-group-lg">
            <div class="col-sm-10 col-sm-offset-2">
                   <button  type="submit" value="save" class="btn btn-primary btn-lg">Add Post</button> 
            </div>

          </div>
        </form>
    @endif
  @endif
  @if(count($errors))
  <div class="alert alert-danger">
  <ul class="list-unstyled">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  <div class="text-center poistionpost">
    {{ $posts->links() }}
  </div>
   
@stop