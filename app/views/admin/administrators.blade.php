@extends('layout.main')

@section('content')
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-2 col-md-8">
		          <h4 class="text-center">Administrators</h4>
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Welcome to <a href="{{ URL::route('admin') }}">Admin Page</a>, <br>
						Your current Access Level is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>
						<div>
							<div class="row">
						        <div class="col-sm-12 col-md-12">

						        	<table class="table">
								      <caption>Administrator Management Table <a class="btn btn-inverse" href="#">Add New Admin</a></caption>
								      <thead>
								        <tr>
								          <th>#</th>
								          <th>Level</th>
								          <th>Name</th>
								          <th>Email ID</th>
								          <th>RDBMS ID</th>
								          <th>Phone</th>
								          <th>Phone (Home)</th>
								          <th>Edit</th>
								        </tr>
								      </thead>
								      <tbody>
										@foreach ($users as $user)
								        <tr>
								          <th scope="row">{{$user->serial_number}}</th>
								          <td>{{$user->user_level}}</td>
								          <td>{{$user->user_name}}</td>
								          <td>{{$user->user_email}}</td>
				  				          <td>{{$user->user_id}}</td>
										  <td>{{$user->user_phone}}</td>
										  <td>{{$user->user_phonehome}}</td>
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



@stop

@section('jscontent')


@stop
