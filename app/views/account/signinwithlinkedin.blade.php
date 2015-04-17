@extends('layout.main')

@section('content')

    @include('layout.login-top')    
	
    	<div class="container-fluid" id="loginpage">
	    	<div class="row">
	    		<div class="login col-md-12">
			        <div class="login-screen ">				    			
		    			<div class="col-sm-12 col-md-4 col-md-offset-4">
		                    <form action="{{ URL::route('account-sign-in-linkedin-post') }}" class="" method="post">				    				
				    			<div class="login-form">	
					    			<p class="bg-color-text">Signed in via <span class="fui-linkedin primary-color-text"></span></p>
						            <div class="form-group">
							            	<input name="linkedin_id" class="form-control" style="display:none;" type="text" value="{{ $result['id'] }}" readonly="">
						            </div>
						            <div class="form-group">
						            	<div class="input-group">
							            	<span class="input-group-addon"><span class="fui-user primary-color-text"></span></span>
							            	<input name="linkedin_name" class="form-control" type="text" value="{{ $result['name'] }}" style="color:#34495e;" readonly="">
						            	</div>
						            </div>
						            <div class="form-group">
							            	<input name="linkedin_firstname" class="form-control" style="display:none;" type="text" value="{{ $result['firstName'] }}" readonly="">							            	
						            </div>
						            <div class="form-group">
							            	<input name="linkedin_lastname" class="form-control" style="display:none;" type="text" value="{{ $result['lastName'] }}" readonly="">							            	
						            </div>
						            
						            <div class="form-group">
						            	<div class="input-group">
							            	<span class="input-group-addon"><span class="fui-mail primary-color-text"></span></span>
							            	<input name="linkedin_email" class="form-control" type="text" value="{{ $result['emailAddress'] }}" style="color:#34495e;" readonly="">
						            	</div>
						            </div>
						            <div class="form-group">
						            	<div class="input-group">
							            	<span class="input-group-addon"><span class="fui-linkedin primary-color-text"></span></span>
							            	<input name="linkedin_link" class="form-control" type="text" value="{{ $result['siteStandardProfileRequest']['url'] }}" style="color:#34495e;" readonly="">
						            	</div>
						            </div>
						            <div class="form-group text-center">
						            	<img class="img-rounded" height="100" src="{{ $result['pictureUrl'] }}">
						            </div>
						            <div class="form-group">
							            	<input name="linkedin_picture" class="form-control" style="display:none;" type="text" value="{{ $result['pictureUrl'] }}" readonly="">							            	
						            </div>
						            <div class="form-group">
							            	<input name="linkedin_headline" class="form-control" style="display:none;" type="text" value="{{ $result['headline'] }}" readonly="">							            	
						            </div>

						            <div class="form-group">
							            	<input name="linkedin_accesstoken" class="form-control" style="display:none;" type="text" value="{{ $result['accesstoken'] }}" readonly="">
						            </div>
						            <p class="bg-color-text">We have detected that you are logging in for the first time. Please enter your roll number below to continue.</p>
						            <div class="form-group">
						            	<div class="input-group">
							            	<span class="input-group-addon"><span class="fui-credit-card primary-color-text"></span></span>
							            	<input name="rollno" class="form-control text-uppercase" type="text" placeholder="Enter you Roll number here" value="{{ $fetchrollnumber }}">
						            	</div>
						            </div>
						            <div class="form-group">
						            	<button class="btn btn-block btn-lg btn-primary">Continue</button>
						            </div>
	                                {{ Form::token() }}    

	                        </form>

					        </div>        	
				        </div>
				    </div>
	    		</div>
	       	</div>
        </div>
        <!-- /.container -->            

    @include('layout.login-bottom')

@stop