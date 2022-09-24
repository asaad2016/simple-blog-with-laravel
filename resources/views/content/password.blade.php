<style>
	div.alert{
	    position: relative;
	    top: -50px;
	    
	    z-index: 100;
	    text-align: center;
    }
	div.action_view{
		padding: 20px;
		background-color: #fff;
		transition: all 2s ease-in-out;
		min-height: calc(100% - 40px);
		background: #40deba;
		backface-visibility: hidden;
		perspective: 300px;
		transform: translate3d(0,0,0);
		margin-bottom: 70px;


		}
	@media (max-width: 500px){
		div.action_view{
		
		background-color: #fff;
		 margin: 70px 10%;

		}
	}
	div.login-box{
		width: 300px;
		margin: 20px auto 0;
		padding: 20px;
		background-color: #fff;
		box-shadow: 0 0 50px #26789a;
		border-radius: 10px;
		min-height: 500px;
		min-width: 500px;
	}

	div.login-box form h1{
		width: 206px;
    	height: 51px;
    	background-color: #387c80;
    	margin: 10px auto;
    	text-align: center;
    	line-height: 1.5;
    	min-width: 450px;
	}
	div.login-box form input{
		border: 1px solid #f2f5f6;
		background-color: #f2f5f6;
		padding: 18px 15px 12px;
		display: block;
		box-sizing: border-box;
		border-radius: 5px;
		margin:20px auto;
		direction: ltr;
		min-width: 450px;



	}
	div.login-box form input[type="text"],div.login-box form input[type="password"]{
		padding-right: 35px;
		position: relative;
	}
	div.login-box form i.fa-user{
		    position: absolute;
		    top: 286px;
		    right: 97px;

	}
	div.login-box form i.fa-lock{
		    position: absolute;
		    top: 338px;
		    right: 97px;

	}
	div.login-box form input[type="submit"]{
		background-color: green;
		color: #fff;
		transition: all 2s ease-in-out;
		width: 90%;
		font-size: 18px

	}
	div.login-box form input[type="submit"]:hover{
		background-color: #9eb2bd;
		

	}
	div.login-box form input[type="submit"]:active{
		background-color: #9eb2bd;
		

	}
	div.login-box form input[type="text"] : focus,div.login-box form input[type="password"] : focus{
		border: 1px solid #f1f1f1;
		background-color: #f9f9fa;
	}
}
	div.login-box form input:-webkit-autofill:focus{
		border-color:#f9f9fa;
		border-bottom: 1px solid #f9f9fa;
		box-shadow: 0 0 0 9999px #f9f9fa;
		
	}

	.animate{
		animation-name: login;
		animation-duration: 2s;
		backface-visibility: hidden;
	}
	@keyframes login{
		0%{
			transform:scale(0) rotateY(360deg);

		}
		50%{
			transform:scale(1) rotateY(180deg);
		}
		100%{
			transform:scale(1) rotateY(0);
		}

	}
</style>
<div class="col-md-8 col-md-offset-2">
	<div class="action_view login">
		
	    <div class="login-box animate">
	    	<form  method="POST" action="{{ url('/confirmpassword') }}">
	    	   {{ csrf_field() }}
	    		<div class="border"></div>
	    		<h1> Forget Password Page </h1>
	    		<div class="input_wrapper_username">
	    			<input type="text" name="name" placeholder="Please Enter Your name" id="ucname" maxlength="50" required="required" >
	    			
	    		</div>
	    		<div class="input_wrapper_password">
	    			<input type="text" name="email" placeholder="Please Enter Your E-mail" id="ucpwd" required="required" >
	    			
	    		</div>
	    		<input type="submit" value="OK">
	    		
	    	</form>
	    </div>
	</div>
	@if($errors->all())
		<div class="alert alert-danger">
			@foreach($errors->all() as $error)
			
				{{ $error }}
		  	
			@endforeach
		</div>
	@endif
</div>
