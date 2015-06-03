@extends('layout.main')

@section('content')

    @include('layout.login-top')    
	
    	<div class="container-fluid" id="loginpage">
	    	<div class="row">
	    		<div class="login col-md-12">
			        <div class="login-screen ">				    			
		    			<div class="col-sm-12 col-md-4 col-md-offset-4">
		                    <form action="{{ URL::route('account-sign-in-facebook-post') }}" class="" method="post">				    				
				    			<div class="login-form">	
					    			<p class="bg-color-text">Signed in via <span class="fui-facebook primary-color-text"></span></p>
						            <div class="form-group">
							            	<input name="facebook_id" class="form-control" style="display:none;" type="text" value="{{ $result['id'] }}" readonly="">
						            </div>
						            <div class="form-group">
						            	<div class="input-group">
							            	<span class="input-group-addon"><span class="fui-user primary-color-text"></span></span>
							            	<input name="facebook_name" class="form-control" type="text" value="{{ $result['name'] }}" style="color:#34495e;" readonly="">
						            	</div>
						            </div>
						            <div class="form-group">
							            	<input name="facebook_firstname" class="form-control" style="display:none;" type="text" value="{{ $result['first_name'] }}" readonly="">
						            </div>
						            <div class="form-group">
							            	<input name="facebook_lastname" class="form-control" style="display:none;" type="text" value="{{ $result['last_name'] }}" readonly="">
						            </div>
						            <div class="form-group">
							            	<input name="facebook_gender" class="form-control" style="display:none;" type="text" value="{{ $result['gender'] }}" readonly="">
						            </div>
						            <div class="form-group">
							            	<input name="facebook_picture" class="form-control" style="display:none;" type="text" value="{{ $result['picture']['data']['url'] }}" readonly="">
						            </div>						            
						            <div class="form-group">
						            	<div class="input-group">
							            	<span class="input-group-addon"><span class="fui-mail primary-color-text"></span></span>
							            	<input name="facebook_email" class="form-control" type="text" value="{{ $result['email'] }}" style="color:#34495e;" readonly="">
						            	</div>
						            </div>
						            <div class="form-group">
							            	<input name="facebook_accesstoken" class="form-control" style="display:none;" type="text" value="{{ $result['accesstoken'] }}" readonly="">
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