@extends('layout.main')

@section('content')
	@if(Auth::check())

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">Oauth Settings</h4>        	
		          <hr>		       				
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
				          	<td><a onclick="deletepor(1)" class="btn btn-sm btn-danger">Remove</a></td>
						  @else
							<td>							
								<a class="btn btn-social btn-google-plus" href="{{ URL::route('account-sign-in-googleplus') }}">
									<i class="fa fa-google-plus"></i> Sign in using Google Plus
								</a>													
				          	</td>
				          	<td><a onclick="deletepor(1)" class="btn btn-sm btn-danger disabled">Remove</a></td>
						  @endif
				        </tr>
				        <tr id="oauth_row_id_2">
				          <th scope="row">Linkedin</th>
				          @if($oauth_check['linkedin'] == "True")
							<td>
								{{ $linkedin_info->linkedin_email }}
				          	</td>
				          	<td><a onclick="deletepor(1)" class="btn btn-sm btn-danger">Remove</a></td>
						  @else
							<td>
								<a class="btn btn-social btn-linkedin" href="{{ URL::route('account-sign-in-linkedin') }}">
									<i class="fa fa-linkedin"></i> Sign in using Linkedin
								</a>						
				          	</td>
				          	<td><a onclick="deletepor(1)" class="btn btn-sm btn-danger disabled">Remove</a></td>
						  @endif  
				        </tr>
				        <tr id="oauth_row_id_3">
				          <th scope="row">Facebook</th>
				          @if($oauth_check['facebook'] == "True")
							<td>
								{{ $facebook_info->facebook_email }}
				          	</td>
				          	<td><a onclick="deletepor(1)" class="btn btn-sm btn-danger">Remove</a></td>
						  @else
							<td>
								<a class="btn btn-social btn-facebook" href="{{ URL::route('account-sign-in-facebook') }}">
									<i class="fa fa-facebook"></i> Sign in using Facebook
								</a>				
				          	</td>
				          	<td><a onclick="deletepor(1)" class="btn btn-sm btn-danger disabled">Remove</a></td>
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
