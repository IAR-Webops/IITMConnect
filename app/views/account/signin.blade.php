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
									<a class="btn btn-block btn-lg btn-social btn-google-plus" href="{{ URL::route('account-sign-in-googleplus') }}">
										<i class="fa fa-google-plus"></i> Sign in using Google Plus
									</a>
								</div>
								<div class="social-login">
									<a class="btn btn-block btn-lg btn-social btn-linkedin" href="{{ URL::route('account-sign-in-linkedin') }}">
										<i class="fa fa-linkedin"></i> Sign in using Linkedin
									</a>
								</div>
								<div class="social-login">
									<a class="btn btn-block btn-lg btn-social btn-facebook" href="{{ URL::route('account-sign-in-facebook') }}">
										<i class="fa fa-facebook"></i> Sign in using Facebook
									</a>
								</div>
								<hr style="color:black; border-style:inset;">							

								<div class="row bg-color-text">									
									<div class="col-sm-12 text-center">
									<h4>
										<a href="{{ URL::route('about-us') }}" target="_alt">
											<span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="About Us"></span>
										</a>
										|
										<a href="{{ URL::route('privacy-policy') }}" target="_alt">
											<span class="glyphicon glyphicon-briefcase" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Privacy Policy"></span>
										</a>
										|
										<a href="{{ URL::route('report-issues') }}" target="_alt">
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Report Issue"></span>
										</a>
									</h4>

									</div>
								</div>
								<p class="bg-color-text text-center">Kindly disable Ad Blockers if you face Sign In Issues</p>

					        </div>        	
				        </div>
				    </div>
	    		</div>
	       	</div>
        </div>
        <!-- /.container -->      

   

    @include('layout.login-bottom')

@stop

@section('jscontent')
	
@stop