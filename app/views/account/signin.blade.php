@extends('layout.main')

@section('content')

    @include('layout.login-top')    
	
    	<div class="container-fluid" id="loginpage">
	    	<div class="row">
	    		<div class="login col-md-12">
			        <div class="login-screen ">				    			
		    			<div class="col-sm-12 col-md-4 col-md-offset-4">
			    			<div class="login-form">	
				    			
					            <div class="text-center">
									<img height="150" src="{{ URL::asset('img/IIT_Madras_Logo_300.png') }}">
								</div>
								<h4 class="bg-color-text text-center">
									Welcome to #iitmconnect
								</h4>
								<hr style="color:black; border-style:inset;">
					            <div class="social-login">
									<a class="btn btn-block btn-lg btn-social btn-google-plus">
										<i class="fa fa-google-plus"></i> Sign in using Google Plus
									</a>
								</div>
								<div class="social-login">
									<a class="btn btn-block btn-lg btn-social btn-linkedin">
										<i class="fa fa-linkedin"></i> Sign in using Linkedin
									</a>
								</div>
								<div class="social-login">
									<a class="btn btn-block btn-lg btn-social btn-facebook" href="{{ URL::route('account-sign-in-facebook') }}">
										<i class="fa fa-facebook"></i> Sign in using Facebook
									</a>
								</div>

					        </div>        	
				        </div>
				    </div>
	    		</div>
	       	</div>
        </div>
        <!-- /.container -->            

    @include('layout.login-bottom')

@stop