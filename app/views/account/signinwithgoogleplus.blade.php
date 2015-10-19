@extends('layout.main')

@section('content')

    @include('layout.login-top')    
	
    	<div class="container-fluid" id="loginpage">
	    	<div class="row">
	    		<div class="login col-md-12">
			        <div class="login-screen ">				    			
		    			<div class="col-sm-12 col-md-4 col-md-offset-4">
		                    <form action="{{ URL::route('account-sign-in-googleplus-post') }}" class="" method="post">				    				
				    			<div class="login-form">	
					    			<p class="bg-color-text">Signed in via <span class="fui-google-plus primary-color-text"></span></p>
						            <div class="form-group">
							            	<input name="googleplus_id" class="form-control" style="display:none;" type="text" value="{{ $result['id'] }}" readonly="">
						            </div>
						            <div class="form-group">
						            	<div class="input-group">
							            	<span class="input-group-addon"><span class="fui-user primary-color-text"></span></span>
							            	<input name="googleplus_name" class="form-control" type="text" value="{{ $result['name'] }}" style="color:#34495e;" readonly="">
						            	</div>
						            </div>
						            <div class="form-group">
							            	<input name="googleplus_firstname" class="form-control" style="display:none;" type="text" value="{{ $result['given_name'] }}" readonly="">
						            </div>
						            <div class="form-group">
							            	<input name="googleplus_lastname" class="form-control" style="display:none;" type="text" value="{{ $result['family_name'] }}" readonly="">
						            </div>
						            <div class="form-group">
						            	<div class="input-group">
							            	<span class="input-group-addon"><span class="fui-mail primary-color-text"></span></span>
							            	<input name="googleplus_email" class="form-control" type="text" value="{{ $result['email'] }}" style="color:#34495e;" readonly="">
						            	</div>
						            </div>
						            
						            @if(empty($result['link']))
						            <div class="form-group primary-color-text" >
							            <div class="input-group">
							            	<span class="input-group-addon"><span class="fui-google-plus primary-color-text"></span></span>
							            	<input name="googleplus_link" class="form-control" type="text" placeholder="Link to your Googleplus Profile / Website" value="" style="color:#34495e;" required>
							            </div>
						            </div>
						            @else
						            <div class="form-group">
						            	<div class="input-group">
							            	<span class="input-group-addon"><span class="fui-google-plus primary-color-text"></span></span>
							            	<input name="googleplus_link" class="form-control" type="text" placeholder="Link to your Googleplus Profile / Website" value="{{ $result['link'] }}" style="color:#34495e;" readonly="">
						            	</div>
						            </div>
						            @endif
						            <div class="form-group text-center">
						            	<img class="img-rounded" height="100" src="{{ $result['picture'] }}">
						            </div>
						            <div class="form-group">
							            	<input name="googleplus_picture" class="form-control" style="display:none;" type="text" value="{{ $result['picture'] }}" readonly="">							            	
						            </div>
						            
						            
						            @if(empty($result['gender']))
						            <div class="form-group primary-color-text" >
						            Please choose your Gender
						            	<label class="radio" for="radio4a">
							                <input type="radio" name="googleplus_gender" data-toggle="radio" value="male" id="radio4a" required checked>
							                 Male
							            </label>
							            <label class="radio" for="radio4b">
							                <input type="radio" name="googleplus_gender" data-toggle="radio" value="female" id="radio4b" required>
							                 Female
							            </label>
						            </div>
						            @else
						            <div class="form-group">
							            	<input name="googleplus_gender" class="form-control" style="display:none;" type="text" value="{{ $result['gender'] }}" readonly="">							            	
						            </div>
						            @endif

						            <div class="form-group">
							            	<input name="googleplus_accesstoken" class="form-control" style="display:none;" type="text" value="{{ $result['accesstoken'] }}" readonly="">
						            </div>
						            <p class="bg-color-text">We have detected that you are logging in for the first time. Please enter your roll number below to continue.</p>
						            
					    			<div class="form-group">            
							          	<div class="primary-color-text">
							          	  <label class="radio" for="rollradio4alum">
							                <input type="radio" name="optionsRadiosRolls" data-toggle="radio" value="Alumni" id="rollradio4alum" checked="">
							                 I remember my Roll Number.
							              </label>
							              <div class="form-group col-sm-12">
								            	<div class="input-group col-sm-10 col-sm-offset-1">
									            	<span class="input-group-addon"><span class="fui-credit-card primary-color-text"></span></span>
									            	<input name="rollno" id="rollno" class="form-control text-uppercase" type="text" placeholder="Enter you Roll number here" value="{{ $fetchrollnumber }}">
								            	</div>
								          </div>
					    				  <p class="bg-color-text text-center">OR</p>

							              <label class="radio" for="rollradio4forgotalum">
							                <input type="radio" name="optionsRadiosRolls" data-toggle="radio" value="Forgot Alumni" id="rollradio4forgotalum" >
							                 I can't remember my Roll Number? I will add it later.
							              </label>
							              <label class="radio" for="rollradio4nonalum">
							                <input type="radio" name="optionsRadiosRolls" data-toggle="radio" value="Non Alumni" id="rollradio4nonalum" >
							                 I am not an Alumni? Create a Non-Alumni/Guest Account for me.
							              </label>
							              
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

@section('jsmainbodycontent')
	<script type="text/javascript">
	//alert('Test');

		$(function(){
		    $("#rollradio4alum, #rollradio4forgotalum, #rollradio4nonalum").change(function(){
		        $("#rollno").val("").attr("readonly",true);
		        if($("#rollradio4alum").is(":checked")){
		            $("#rollno").removeAttr("readonly");
		            $("#rollno").focus();
		        }
		        else if($("#rollradio4forgotalum").is(":checked")){
		        	var randomroll = makeid();
		            $("#rollno").val("FRN-"+randomroll);		            		            		            
		        }
		        else if($("#rollradio4nonalum").is(":checked")){
		        	var randomroll = makeid();
		            $("#rollno").val("NAN-"+randomroll);		            		            		            
		        }
		    });
		});

	</script>
	<script type="text/javascript">
		function makeid()
			{
			    var text = "";
			    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

			    for( var i=0; i < 8; i++ )
			        text += possible.charAt(Math.floor(Math.random() * possible.length));

			    return text;
			}

	</script>
@stop