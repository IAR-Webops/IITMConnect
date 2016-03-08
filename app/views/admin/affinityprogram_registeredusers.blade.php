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
						Coming Soon.

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