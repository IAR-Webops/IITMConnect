@extends('layout.main')

@section('content')
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-2 col-md-8">
		          <h4 class="text-center">User Management</h4>        	
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Your current Access Level to <a href="{{ URL::route('admin') }}">Admin Page</a> is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>					

					<table class="table">
				      <caption>User Management Table</caption>
				      <thead>
				        <tr>
				          <th>#</th>
				          <th>Roll Number</th>
				          <th>Name</th>
				          <th>Email ID</th>
				          <th>RDBMS ID</th>				          
				          <th>Phone</th>
				          <th>Phone (Home)</th>
				          <th>Graduating Year</th>
				        </tr>
				      </thead>
				      <tbody>
						@foreach ($users as $user)
				        <tr>
				          <th scope="row">{{$user->serial_number}}</th>
				          <td>{{$user->rollno}}</td>
				          <td>{{$user->user_name}}</td>
				          <td>{{$user->user_email}}</td>
  				          <td>{{$user->id}}</td>
						  <td>{{$user->user_phone}}</td>
						  <td>{{$user->user_phonehome}}</td>
						  <td>{{$user->user_graduatingyear}}</td>
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