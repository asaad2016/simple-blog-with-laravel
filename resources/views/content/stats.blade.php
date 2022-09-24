@extends('master')
@section('content')
<h1 class="page-header" style="margin-top:70px;">Statics Page  
</h1>
<table class="table table-hover">
	<tr>
		<td>
			Users
		</td>
		<td>
			{{$arr['user']}}
		</td>
	</tr>
	<tr>
		<td>
			Posts
		</td>
		<td>
			{{$arr['post']}}
		</td>
	</tr>
	<tr>
		<td>
			Comments
		</td>
		<td>
			{{$arr['comment']}}
		</td>
	</tr>
	</tr>
		<tr>
		<td>
			name Of Max Comment And Like
		</td>
		<td>
			{{$arr['name']}}
		</td>
	</tr>
	<tr>
		<td>
			Count Of Like
		</td>
		<td>
			{{$arr['likecount']}}
		</td>
	</tr>
		<tr>
		<td>
			Count Of Comment
		</td>
		<td>
			{{$arr['likecomment']}}
		</td>
	</tr>
	


</table>


@endsection