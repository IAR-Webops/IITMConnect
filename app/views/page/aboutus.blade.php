@extends('layout.main')

@section('content')
	@if(Auth::check())

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">About Us</h4>        	
		          <hr>		       
					<p><strong>#iitmconnect</strong> is the first project that has been taken up by
					the I&AR Web Operations Team.</p>
					<p>The purpose of this project is to help you stay in touch with insti forever.</p>
					<p>Users registered since April 21, 2015 on <strong>#iitmconnect</strong> : {{$usercount}} </p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">Report Issues</h4>        	
		          <hr>		       
					<p><strong><a href="https://github.com/IAR-Webops/IITMConnect" target="_blank"> #iitmconnect</a></strong> 
					Project is currently hosted on Github under the 
					<a href="https://github.com/IAR-Webops" target="_blank">IAR Webops</a> Organization.</p>
					<div class="text-center">
						<img src="{{ URL::asset('img/github-search.jpg') }}" height="200" class="text-center">
					</div>
					<p>If you find any issues/bugs with this app kindly report them under the 
					<a href="https://github.com/IAR-Webops/IITMConnect/issues" target="_blank">Issues</a>
					section of the iitmconnect repository. Please include a screenshot of the issue that 
					you faced along with list of steps that guide us in recreating that issue.</p>
				</div>
			</div>
		</div>

@else
		
		Sorry, not signed in.


	@endif
@stop
