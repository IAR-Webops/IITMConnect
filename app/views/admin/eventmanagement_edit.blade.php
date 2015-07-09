@extends('layout.main')

@section('content')
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">Edit {{$event->event_name}}</h4>        	
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Your current Access Level to <a href="{{ URL::route('admin') }}">Admin Page</a> is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>

						<form action="{{ URL::to('/') }}/admin/eventmanagement/{{$event->event_unique_name}}/edit" class="form-horizontal" role="form" method="post">
				          	<!-- Field - Event Name -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Name :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_name" placeholder="Event Name *" value="{{ $event->event_name }}" required>
				              </div>				              
				            </div>
				          	<!-- Field - Roll Number -->
				            <div class="form-group">
				            	<div class="col-sm-12 col-md-4 text-right">				            
					            	<label class="text-right">Event Unique Name :</label>
					            </div>
				            	<div class="col-sm-12 col-md-8">
				              		<div class="input-group">
						              <span class="input-group-addon"><span class="fui-credit-card"></span></span>
						              <input type="text" class="form-control" placeholder="event_unique_name" value="{{ $event->event_unique_name }}" disabled="">
						            </div>
					            </div>
				            </div>

				            <!-- Field - Event Details Short -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Detail Short :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <textarea type="text" class="form-control" name="event_details_short" placeholder="Event Details Short" required>{{ $event->event_details_short }}</textarea>
				              </div>				              
				            </div>
				            <!-- Field - Event Details Long -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Detail Long :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <textarea type="text" class="form-control" name="event_details" placeholder="Event Details Short" required>{{ $event->event_details }}</textarea>
				              </div>				              
				            </div>

				            <hr>
            
				          	<!-- Field - Submit -->
				          	<div class="form-group">
				          		<div class="col-sm-12 col-md-6">
				          			<input class="btn btn-block btn-lg btn-primary" type="submit" value="Save">
				          		</div>
				          		<div class="col-sm-12 col-md-6">
							        <a class="btn btn-block btn-lg btn-danger" href="{{ URL::route('admin-event-management') }}">Cancel</a>          			
				          		</div>
				          		{{ Form::token() }}
				          	</div>

				        </form>
					

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