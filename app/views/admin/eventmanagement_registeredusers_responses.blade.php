@extends('layout.main')

@section('content')
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-1 col-md-10">
		          <h4 class="text-center">Registered Users Responses for {{$event->event_name}}</h4>        	
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Your current Access Level to <a href="{{ URL::route('admin') }}">Admin Page</a> is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>

					<table class="table">
				      <caption>Registered Users Response Table</caption>
				      <thead>
				        <tr>
				          <th>#</th>
				          <th>Roll No.</th>
				          <th>Name</th>
				          <th>Email ID</th>
				          <th>Phone</th>
				          <th>Phone (Home)</th>
				          <th>Graduating Year</th>				          
				          <th>University / Company</th>
				          <th>University / Company Department</th>				          
				          <th>Location</th>
			              @foreach ($events_specific_questions as $events_specific_question)
			              <th>{{ $events_specific_question->question_value }}</th>
				          @endforeach
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
				          <td>{{$event_attendance_user->user_future_field1}}</td>
				          <td>{{$event_attendance_user->user_future_field2}}</td>				          
				          <td>{{$event_attendance_user->user_future_field3}}</td>
				          @foreach ($event_attendance_user->events_specific_questions_answers as $events_specific_questions_answer)
			              <td>{{ $events_specific_questions_answer->answer_value }}</td>
				          @endforeach
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