@extends('layout.main')

@section('content')

	<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-1 col-md-10">
		          <h4 class="text-center">Registered Users for {{$affinity_program->name}}</h4>        	
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Your current Access Level to <a href="{{ URL::route('admin') }}">Admin Page</a> is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>

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
				          <th>University / Company</th>
				          <th>University / Company Department</th>				          
				          <th>Location</th>
				        </tr>
				      </thead>
				      <tbody>
						@foreach ($affinity_programs_registrations as $affinity_programs_registrations_user)
				        <tr>
				          <th scope="row">{{$affinity_programs_registrations_user->user_registeration_number}}</th>
				          <td class="text-uppercase">{{$affinity_programs_registrations_user->user_roll_number}}</td>
				          <td>{{$affinity_programs_registrations_user->user_name}}</td>
				          <td>{{$affinity_programs_registrations_user->user_email}}</td>
				          <td>{{$affinity_programs_registrations_user->user_phone}}</td>
				          <td>{{$affinity_programs_registrations_user->user_phonehome}}</td>
				          <td>{{$affinity_programs_registrations_user->user_graduatingyear}}</td>				          
				          <td>{{$affinity_programs_registrations_user->user_future_field1}}</td>
				          <td>{{$affinity_programs_registrations_user->user_future_field2}}</td>				          
				          <td>{{$affinity_programs_registrations_user->user_future_field3}}</td>

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