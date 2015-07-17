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
				            <!-- Field - Event Picture -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Picture URL :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_picture" placeholder="Event Picture URL" value="{{ $event->	event_picture }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Data -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Date :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_date" placeholder="Event Date" value="{{ $event->event_date }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Time -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Time :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_time" placeholder="Event Time" value="{{ $event->event_time }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Place -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Place :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_place" placeholder="Event Place" value="{{ $event->event_place }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Facebook Link -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Facebook Link :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_fb_event_link" placeholder="Event Facebook Link" value="{{ $event->event_fb_event_link }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Organizer -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Organizer :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_organizer" placeholder="Event Organizer" value="{{ $event->event_organizer }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Status -->	
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Status :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				              	<div class="bootstrap-switch-square">
				                  <input type="checkbox" data-toggle="switch" name="event_status" id="event_status" value="Open" />
				                </div>
				              </div>				              
				            </div>	
				            <!-- Field - Event RSVP Status -->	
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event RSVP Status :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				              	<div class="bootstrap-switch-square">
				                  <input type="checkbox" data-toggle="switch" name="event_rsvp_status" id="event_rsvp_status" value="Open" />
				                </div>
				              </div>				              
				            </div>
				            <!-- Field - Event Specific Questions -->	
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event has Specific Questions :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				              	<div class="bootstrap-switch-square">
				                  <input type="checkbox" data-toggle="switch" name="event_has_questions" id="event_has_questions" data-on-text="<span class='fui-check'></span>" data-off-text="<span class='fui-cross'></span>" value="Yes" />
				                </div>
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
<script type="text/javascript">
	if ("{{ $event->event_status }}" == "Open") {
			$('#event_status').attr('checked', true);
	} else{
			$('#event_status').attr('checked', false);
	};
	if ("{{ $event->event_rsvp_status }}" == "Open") {
			$('#event_rsvp_status').attr('checked', true);
	} else{
			$('#event_rsvp_status').attr('checked', false);
	};
	if ("{{ $event->event_has_questions }}" == "Yes") {
			$('#event_has_questions').attr('checked', true);
	} else{
			$('#event_has_questions').attr('checked', false);
	};


</script>
@stop