@extends('layout.main')

@section('content')
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-1 col-md-10">
		          <h4 class="text-center">Registered Users for {{$event->event_name}}</h4>        	
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Your current Access Level to <a href="{{ URL::route('admin') }}">Admin Page</a> is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>
						<p><a href="{{ URL::to('/') }}/admin/eventmanagement/{{$event->event_unique_name}}/registeredusers/excel" class="btn btn-primary btn-large">Export to Excel</a></p>					

					<table class="table">
				      <caption>Registered Users Table</caption>
				      <thead>
				        <tr>
				          <th>#</th>
				          <th>Roll No.</th>
				          <th>Name</th>
				          <th>Email ID</th>
				          <th>Phone</th>
				          <th>Phone (Home)</th>
				          <th>Graduating Year</th>				          
				          <th>University</th>
				          <th>Department</th>
				        </tr>
				      </thead>
				      <tbody>
						@foreach ($event_attendance_users as $event_attendance_user)
				        <tr>
				          <th scope="row">{{$event_attendance_user->user_registeration_number}}</th>
				          <td class="text-uppercase">{{$event_attendance_user->user_roll_number}}</td>
				          <td>{{$event_attendance_user->user_name}}</td>
				          <td>{{$event_attendance_user->user_email}}</td>
				          <td>{{$event_attendance_user->user_phone}}</td>
				          <td>{{$event_attendance_user->user_phonehome}}</td>
				          <td>{{$event_attendance_user->user_graduatingyear}}</td>				          
				          <td>{{$event_attendance_user->user_university}}</td>
				          <td>{{$event_attendance_user->user_department}}</td>

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