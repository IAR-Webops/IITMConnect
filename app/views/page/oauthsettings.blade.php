@extends('layout.main')

@section('content')
	@if(Auth::check())

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">Oauth Settings</h4>        	
		          <hr>		       
					<p><strong>#iitmconnect</strong> is the first project that has been taken up by
					the I&AR Web Operations Team.</p>
					<p>The purpose of this project is to help you stay in touch with insti forever.</p>
				</div>
			</div>
			
		</div>

@else
		
		Sorry, not signed in.


	@endif
@stop
