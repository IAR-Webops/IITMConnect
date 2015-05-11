@extends('layout.main')

@section('content')
	@if(Auth::check())

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">Oauth Settings</h4>        	
		          <hr>		       				
		          <p>Your Primary email id is : <strong> {{ $user_email_info->user_email }} </strong></p>
		          @if($admin_user_check == "True")
						<p>						
						Your current Access Level for <a href="{{ URL::route('admin') }}">Admin Page</a> is : 
						<strong>{{ $admin_user->user_level }}</strong> <br>
						</p>						
				  @endif
					<table class="table">
				      <caption>Social Oauth Account Settings</caption>
				      <thead>
				        <tr>
				          <th>Oauth Client</th>
				          <th>Emaid ID</th>
				          <th>Delete</th>
				        </tr>
				      </thead>
				      <tbody>
						<tr id="oauth_row_id_1">
				          <th scope="row">Google Plus</th>				          
				          @if($oauth_check['googleplus'] == "True")
							<td>
								{{ $googleplus_info->googleplus_email }}
				          	</td>
				          	<td><a onclick="deleteoauth('googleplus')" id="removegoogleplus" class="btn btn-sm btn-danger">Remove</a></td>
						  @else
							<td>							
								<a class="btn btn-block btn-sm btn-social btn-google-plus" href="{{ URL::route('account-add-googleplus') }}">
									<i class="fa fa-google-plus"></i> Sign in using Google Plus
								</a>													
				          	</td>
				          	<td><a onclick="deleteoauth('googleplus')" id="removegoogleplus" class="btn btn-sm btn-danger disabled">Remove</a></td>
						  @endif
				        </tr>
				        <tr id="oauth_row_id_2">
				          <th scope="row">Linkedin</th>
				          @if($oauth_check['linkedin'] == "True")
							<td>
								{{ $linkedin_info->linkedin_email }}
				          	</td>
				          	<td><a onclick="deleteoauth('linkedin')" id="removelinkedin" class="btn btn-sm btn-danger">Remove</a></td>
						  @else
							<td>
								<a class="btn btn-block btn-sm btn-social btn-linkedin" href="{{ URL::route('account-add-linkedin') }}">
									<i class="fa fa-linkedin"></i> Sign in using Linkedin
								</a>						
				          	</td>
				          	<td><a onclick="deleteoauth('linkedin')" id="removelinkedin" class="btn btn-sm btn-danger disabled">Remove</a></td>
						  @endif  
				        </tr>
				        <tr id="oauth_row_id_3">
				          <th scope="row">Facebook</th>
				          @if($oauth_check['facebook'] == "True")
							<td>
								{{ $facebook_info->facebook_email }}
				          	</td>
				          	<td><a onclick="deleteoauth('facebook')" id="removefacebook" class="btn btn-sm btn-danger">Remove</a></td>
						  @else
							<td>
								<a class="btn btn-block btn-sm btn-social btn-facebook" href="{{ URL::route('account-add-facebook') }}">
									<i class="fa fa-facebook"></i> Sign in using Facebook
								</a>				
				          	</td>
				          	<td><a onclick="deleteoauth('facebook')" id="removefacebook" class="btn btn-sm btn-danger disabled">Remove</a></td>
						  @endif
				        </tr>
						
								      
				      </tbody>
				    </table>

				</div>
			</div>
			
		</div>

@else
		
		Sorry, not signed in.


	@endif
@stop

@section('jscontent')
	<script type="text/javascript">
		function deleteoauth(oauthclient){

			$.ajax({
			    url: "{{ URL::route('oauth-settings-delete') }}",
			    type: 'DELETE',
			    data: "oauthclient="+oauthclient,
			    success: function(result) {
			        // Do something with the result
					$.notify(result ,"error");	   
					$("#remove"+oauthclient).addClass('disabled');     
					window.location.reload(true);
					//$("#por_row_id_"+oauthclient).fadeOut();
					//$.notify("Under Construction " + id ,"error");	        
			    },
			    error: function(xhr, status, error) {
				  //var err = eval("(" + xhr.responseText + ")");
				  //alert(err.Message);
				  //alert(xhr.responseText);
					$.notify("Unable to remove Oauth. Contact Webops Team" ,"error");	        

				}
			});
		}
	</script>

@stop