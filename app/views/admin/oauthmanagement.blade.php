@extends('layout.main')

@section('content')
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-2 col-md-8">
		          <h4 class="text-center">Oauth Management</h4>        	
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Welcome to <a href="{{ URL::route('admin') }}">Admin Page</a>, <br>
						Your current Access Level is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>						
						<div>
							<div class="row">						       
						        <div class="col-sm-12 col-md-12">
				  				<a href="#fakelink" class="btn btn-lg btn-inverse" data-toggle="modal" data-target="#newOauthModal">Create New App</a>	
						        	
						        	<table class="table">
								      <caption>Oauth Developers Management Table</caption>
								      <thead>
								        <tr>
								          <th>#</th>
								          <th>Developer Name</th>
								          <th>Dev ID</th>
								          <th>Developer Email</th>
								          <th>App Name</th>
								          <th>App ID</th>
								          <th>App Secret</th>
								          <th>Redirect URI</th>				          
								          <th>Edit</th>
								        </tr>
								      </thead>
								      <tbody>
										@foreach ($oauth_clients as $key => $oauth_client)
								        <tr>
								          <th scope="row">{{ $key + 1 }}</th>
								          <td>{{$oauth_client->developer_name}}</td>
								          <td>{{$oauth_client->developer_id}}</td>
								          <td>{{$oauth_client->developer_email}}</td>
								          <td>{{$oauth_client->name}}</td>
								          <td>{{$oauth_client->id}}</td>
								          <td>{{$oauth_client->secret}}</td>
				  				          <td>{{$oauth_client->redirect_uri}}</td>
										  <td><a href="#" class="btn btn-danger" disabled>Remove</a></td>
								        </tr>
										@endforeach

								      </tbody>
								    </table>

						        </div>
						    </div>						    
						</div>						
					@elseif($admin_user_check == "False")
						<p>
						Sorry, You cannot access this page because your Access Level is not Admin. <br>
						If you are an Admin and are still seeing this message then contact the 
						Webops Team ASAP.
						</p>
					@else
						<p>There was an Internal Error. Contact the Webops Team with a screenshot of this ASAP.</p>
					@endif
				</div>
			</div>
		</div>
			

		<!-- Modal -->
		<div class="modal fade" id="newOauthModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
			<form action="{{ URL::route('admin-oauth-management-post') }}" class="form-horizontal" role="form" method="post">

		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Create New Oauth App</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="container-fluid">

				          	<!-- Field - Name -->
				            <div class="form-group">
				        	Enter the event details below to begin.
				        	
								<div class="col-sm-12">
									<label>App Name :</label>
									<input type="text" class="form-control" id="app_name" name="app_name" placeholder="App Name" value="" required>
					            </div>	
					            <div class="col-sm-12">
									<label>Redirect URI :</label>
									<input type="text" class="form-control text-lowercase" id="redirect_uri" name="redirect_uri" placeholder="Will be used for Redirect" value="" required>
					            </div>
				            </div>

				            <input type="hidden" name="developer_id" value="admin-oauth">
				            <input type="hidden" name="developer_name" value="Oauth Management">
				            <input type="hidden" name="developer_email" value="yashmurty@gmail.com">

		        </div>		        
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="submit" class="btn btn-primary">Create App</button>
		      </div>

			</form>
		    </div>
		  </div>
		</div>
		<!-- END - Modal -->	



@stop

@section('jscontent')

	
@stop