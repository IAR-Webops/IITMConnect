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
				          <td><a href="#" class="btn btn-danger btn-large btn-block disabled">Edit</a></td>
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
			


@stop

@section('jscontent')

	
@stop