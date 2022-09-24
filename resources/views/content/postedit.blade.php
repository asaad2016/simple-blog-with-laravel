@extends('master')
@section('content')
	@if(Auth::check()) 
	    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor') || Auth::user()->id == $post->userid) 
	      <form class="form-horizontal" role="form" method="POST" action="{{ url('/post/update/' . $post->id) }}"  enctype="multipart/form-data">
	      {{ csrf_field() }}   
	        <div class="form-group">
	          <label class="col-sm-2 control-label">Title</label>
	          <div class="col-sm-8 col-md-6">
	               <input  type="text" name="title" id="title"  class="form-control" value="{{ $post->title }}" required/>
	          </div>
	         </div>
	         <div class="form-group">
	            <label class="col-sm-2 control-label">Body</label>
	            <div class="col-sm-8 col-md-6">
	               <textarea name="body" id="body"  class="form-control"  required>{{ $post->body }}</textarea>          
	            </div>
	          </div>
	           <div class="form-group">
	            <label class="col-sm-2 control-label" for="url">Image</label>
	            <div class="col-sm-8 col-md-6">
	               <input  type="file" name="url" id="url"  class="form-control"  required/>         
	            </div>
	          </div>
	          <div class="form-group form-group-lg">
	            <div class="col-sm-10 col-sm-offset-2">
	                   <button  type="submit" value="save" class="btn btn-primary btn-lg">Edit Post</button> 
	            </div>

	          </div>
	        </form>
	    @endif
	 @endif



@endsection