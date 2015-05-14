@extends('layout.main')

@section('content')
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-2 col-md-8">
		          <h4 class="text-center">Admin</h4>        	
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Welcome to <a href="{{ URL::route('admin') }}">Admin Page</a>, <br>
						Your current Access Level is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>						
						<div>
							<div class="row">						       
						        <div class="col-sm-12 col-md-4">
						          <div class="tile">
						            <img src="img/icons/svg/book.svg" alt="Infinity-Loop" class="tile-image">
						            <h3 class="tile-title">User Management</h3>
						            <p>View all Users registered on #iitmconnect</p>
						            <a class="btn btn-primary btn-large btn-block" href="{{ URL::route('admin-user-management') }}">View Details</a>
						          </div>
						        </div>

						        <div class="col-sm-12 col-md-4">
						          <div class="tile">
						            <img src="img/icons/svg/gift-box.svg" alt="Event Management" class="tile-image">
						            <h3 class="tile-title">Event Management</h3>
						            <p>View Users currently registered for events</p>
						            <a class="btn btn-primary btn-large btn-block" href="{{ URL::route('admin-event-management') }}">View Details</a>
						          </div>
						        </div>

						        <div class="col-sm-12 col-md-4">
						          <div class="tile">
						            <img src="img/icons/svg/paper-bag.svg" alt="Mail Management" class="tile-image">
						            <h3 class="tile-title">Mail Management</h3>
						            <p>Send emails to users registered on #iitmconnect</p>
						            <a class="btn btn-primary btn-large btn-block disabled" href="#">View Details</a>
						          </div>

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
			


@stop

@section('jscontent')

	
@stop