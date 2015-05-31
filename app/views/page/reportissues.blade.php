@extends('layout.main')

@section('content')

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">Report Issues</h4>        	
		          <hr>		       
					<p><strong><a href="https://github.com/IAR-Webops/IITMConnect" target="_blank"> #iitmconnect</a></strong> 
					Project is currently hosted on Github under the 
					<a href="https://github.com/IAR-Webops" target="_blank">IAR Webops</a> Organization.</p>
					<div class="text-center">
						<iframe src="https://ghbtns.com/github-btn.html?user=IAR-Webops&repo=IITMConnect&type=star&count=true&size=large" frameborder="0" scrolling="0" width="160px" height="30px"></iframe>
					</div>
					<p>If you find any issues/bugs with this app kindly report them under the 
					<a href="https://github.com/IAR-Webops/IITMConnect/issues" target="_blank"><strong>Issues</strong> (Click Here) </a>
					section of the iitmconnect repository. Please include a screenshot of the issue that 
					you faced along with list of steps that guide us in recreating that issue.</p>
					<div class="text-center">
						<a href="https://github.com/yashmurty" target="_alt">
						<img src="{{ URL::asset('img/github-search.jpg') }}" height="200" class="text-center">
						</a>						
					</div>
					<p>
						If you discover a <strong>Security Vulnerability</strong> within #iitmconnect, 
						please disclose the information responsibly by sending an email to Yash Murty at
			        	<strong><a href="mailto:yashmurty@gmail.com?Subject=Urgent%20Security%20Vulnerability%20iitmconnect" target="_alt">
			        	yashmurty@gmail.com</a></strong> and not by creating a github issue.
			        	All security vulnerabilities will be promptly addressed.
			        </p>
				</div>
			</div>
		</div>

		


@stop
