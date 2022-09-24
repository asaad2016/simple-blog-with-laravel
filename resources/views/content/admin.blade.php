@extends('master')
@section('content')
  <h1 class="page-header" style="margin-top:30px;">
		Login Page
  </h1>
  <table class="maintable text-center table table-bordered">
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>E-mail</td>
		<td>Admin</td>
		<td>Editor</td>
	    <td>User</td>
	    <td>control</td>	
	</tr>
	@foreach ($admin as $role)
		<form method="post" action="{{ url('/add-role') }}">
			{{ csrf_field() }} 

			<tr>
				
			 	<td>{{ $role->id }}</td>
				<td>{{ $role->name }}</td>
				<td>{{ $role->email }}</td>
				<input type="hidden" name="email" value="{{ $role->email }}">
				<td>
					<input type="checkbox" name="admin" onchange="this.form.submit()" {{ $role->hasRole('admin') ? 'checked' : ' ' }}>
				</td>
				<td>
					<input type="checkbox" name="editor" onchange="this.form.submit()" {{ $role->hasRole('editor') ? 'checked' : ' ' }}>
				</td>
				<td>
					<input type="checkbox" name="user" onchange="this.form.submit()" {{ $role->hasRole('user') ? 'checked' : ' ' }}>
				</td>
			</tr>
		</form>

    	@endforeach	
    </table>
    <?php
    $commentchk='';
    $regchk='';
    if($comment == 1)
    	$commentchk='checked';
    else
    	$commentchk='';
    if($register == 1)
    	$regchk='checked';
    else
    	$regchk='';
    ?>
    <form method="post" action="{{ url('/setting') }}">
    {{ csrf_field() }} 
    	<h2>Comment setting</h2>
    	<input type="checkbox"   name="commentsetting" onchange="this.form.submit()" {{ $commentchk }}>
    	<h2>Register setting</h2>
    	<input type="checkbox" name="registersettings" onchange="this.form.submit()" {{ $regchk }} >
    </form>
@endsection