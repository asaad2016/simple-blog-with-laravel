@extends('master')
@section('content')
@if(count($user) > 0)
    <h1 class="text-center">My Profile</h1>
    <div class="information block">
        <div class="container">
            <div class="col-sm-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                         Information
                    </div>

                    <div class="panel-body">
                        <ul class="list-unstyled">
                        	<li>
                                <i class="fa fa-unlock-alt fa-fw"></i>
                                <span>Name</span>: {{ $user->name !='' ? $user->name : 'no data'}}
                            </li>
                            <li>

                             <i class="fa fa-user fa-fw"></i>
                             <span>E-mail</span>:  {{ $user->email }}
                             </li>
                             
                             <li>
                                  <i class="fa fa-calendar fa-fw"></i>
                                  <span>Register Date</span>: {{ $user->created_at }}
                            </li>

                         </ul>

                     </div>
                </div>

            </div>
        </div>
    </div>
@else
    <div class='alert alert-info'>No Information For You</div>";

@endif
@endsection