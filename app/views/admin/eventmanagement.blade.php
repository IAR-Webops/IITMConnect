@extends('layout.main')

@section('content')
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-2 col-md-8">
		          <h4 class="text-center">Event Management</h4>        	
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Your current Access Level to <a href="{{ URL::route('admin') }}">Admin Page</a> is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>				
				  	<a href="#fakelink" class="btn btn-lg btn-inverse" data-toggle="modal" data-target="#esqModal">Create New Event</a>	


					<table class="table">
				      <caption>Event Management Table</caption>
				      <thead>
				        <tr>
				          <th>Event ID</th>
				          <th>Event Name</th>
				          <th>Event Date</th>
				          <th>Event Status</th>
				          <th>RSVP Status</th>
				          <th>View Event</th>
				          <th>Edit Event</th>
				          <th>View Registrations</th>
				        </tr>
				      </thead>
				      <tbody>
						@foreach ($events as $event)
				        <tr>
				          <th scope="row">{{$event->event_id}}</th>
				          <td>{{$event->event_name}}</td>
				          <td>{{$event->event_date}}</td>
				          <td>{{$event->event_status}}</td>
  				          <td>{{$event->event_rsvp_status}}</td>
						  <td>
						    <a class="btn btn-primary btn-large btn-block vieweventdetailsbtn" href="{{ URL::to('/') }}/events/{{$event->event_unique_name}}">View Event Details</a>
				          </td>
				          <td><a href="{{ URL::to('/') }}/admin/eventmanagement/{{$event->event_unique_name}}/edit" class="btn btn-danger btn-large btn-block">Edit</a></td>
				          <td><a href="{{ URL::to('/') }}/admin/eventmanagement/{{$event->event_unique_name}}/registeredusers" class="btn btn-primary btn-large btn-block">Registered Users</a></td>				          
				        </tr>
						@endforeach	

				      </tbody>
				    </table>

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
		<div class="modal fade" id="esqModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
			<form action="{{ URL::route('admin-event-management-post') }}" class="form-horizontal" role="form" method="post">

		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Create New Event</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="container-fluid">

				          	<!-- Field - Name -->
				            <div class="form-group">
				        	Enter the event details below to begin.
				        	
								<div class="col-sm-12">
									<label>Event Name :</label>
									<input type="text" class="form-control" id="event_name" name="event_name" placeholder="Event Name" value="" required>
					            </div>	
					            <div class="col-sm-12">
									<label>Event Unique Name :</label>
									<input type="text" class="form-control text-lowercase" id="event_unique_name" name="event_unique_name" placeholder="Will be used for URL" value="" required>
					            </div>
				            </div>
		        </div>		        
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="submit" class="btn btn-primary">Create Event</button>
		      </div>

		    	{{ Form::token() }}
			</form>
		    </div>
		  </div>
		</div>
		<!-- END - Modal -->	

@stop

@section('jscontent')
<script type="text/javascript">
	
	$('#event_name').each(function() {
	   var elem = $(this);

	   // Save current value of element
	   elem.data('oldVal', elem.val());

	   // Look for changes in the value
	   elem.bind("propertychange change click keyup input paste", function(event){
	      // If value has changed...
	      if (elem.data('oldVal') != elem.val()) {
	       // Updated stored value
	       elem.data('oldVal', elem.val());

	       // Do action
	       //console.log(elem.data('oldVal'));
	       document.getElementById("event_unique_name").value = elem.data('oldVal').replace(/ /g,'').toLowerCase();
	     }
	   });
	 });

</script>
	
@stop