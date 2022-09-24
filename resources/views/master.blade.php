<!DOCTYPE html>

<html>
<head>
	<title>Blog</title>
	<!--link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"-->
	<link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::to('css/bootstrap.min.css') }}">
</head>
<body style="overflow-x: hidden;" id="app">
  <div class="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
       
      
            <li><a href="/about">About</a></li>
            <li><a href="{{ url('/stats') }}">Statics</a></li>
            <li><a href="{{ url('/posts') }}">Posts</a></li>
            @if(Auth::check()) 
              @if(Auth::user()->hasRole('admin')) 
                <li><a href="/admin">Admin</a></li>
              @endif
              <li><a href="/profile">Welcome {{ Auth::User()->name !='' ?  Auth::User()->name : 'man'}}</a></li>
              <li><a href="{{ url('/logout') }}">Logout</a></li>
              @else
                <li><a href="{{ url('/register') }}">Register</a></li>
                <li><a href="{{ url('/login') }}">Login</a></li>
            @endif
          </ul>
           
        </div>
      </div>
    </nav>

     <div class="container"  style="margin-top: 100px;">

       <div class="row">
     	    <div class="col-sm-8">
     		     @yield('content')

     	  </div>
        <div class="col-sm-4 blogsearchcat">
          <div class="well">
          <h4>Blog Search</h4>
            <form method="get" action="{{ url('/search') }}">
              <div class="form-group">
                <input type="text" class="form-control" name="title" />
                <span class="input-group-btn">
                      <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Search
                       <span class="glyphicon glyphicon-search"></span>
                      </button>
                </span>
              </div>
            </form>
          </div>
          <div class="well">        
            <ul class="list-unstyled">
              @foreach(\App\Category::all() as $cat)
                <li><a href="{{ url('/category/' . $cat->name) }}">{{ $cat->name }}</a></li>
              @endforeach
            </ul>
          </div>

        </div>
      </div>
    <!--div class="well">
    <div class="row">
    <div class="col-sm-6">
     <h4> wedget</h4>
       <p>this is no things</p>
</div>
</div>

    </div-->
    </div>


   <div style="clear: both;"></div>
    <footer class="text-center" style=" background-color: #d5c4a4;color: white; font-size: 23px;margin-bottom: 0;padding: 20px;position: relative;bottom: -122px;left: 0;">
        <P>
          copyright &copy; your website 2014
        </P>
     </footer>

  </div>

<script src="/js/jquery-3.1.0.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="{{url('/js/main.js')}}"></script>
<script type="text/javascript">
  
</script>
<script src="/js/vue.js"></script>
<script src="/js/js.js"></script>
</body>
</html>
