@extends('layout.main')

@section('content')

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">About Us</h4>        	
		          <hr>		       
					<p><a href="{{ URL::route('home') }}"><strong>#iitmconnect</strong></a> is the first project that has been taken up by
					the I&AR Web Operations Team.</p>
					<p>The purpose of this project is to help you stay in touch with insti forever.</p>
					<p>Users registered since April 21, 2015 on <strong>#iitmconnect</strong> : {{$usercount}} </p>
					<!-- Facebook Like Share Button -->
					<div class="text-center">
						<div class="fb-page" data-href="https://www.facebook.com/iar.iitmadras/" data-width="500" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
			                <div class="fb-xfbml-parse-ignore">
			                <blockquote cite="https://www.facebook.com/iar.iitmadras/">
			                <a href="https://www.facebook.com/iar.iitmadras/">International and Alumni Relations, IIT Madras</a>
			                </blockquote>
			                </div>
			            </div>	
					</div>
				</div>
			</div>
			<br>
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
					<a href="https://github.com/IAR-Webops/IITMConnect/issues" target="_blank">Issues</a>
					section of the iitmconnect repository. Please include a screenshot of the issue that 
					you faced along with list of steps that guide us in recreating that issue.</p>
					<div class="text-center">
						<a href="https://github.com/yashmurty" target="_alt">
						<img src="{{ URL::asset('img/github-search.jpg') }}" height="200" class="text-center">
						</a>
						<!--
						<p>Built with <span class="fui-heart"></span> by 
						<iframe style="margin-top:15px;" src="https://ghbtns.com/github-btn.html?user=mdo&type=follow&count=true&size=large" frameborder="0" scrolling="0" width="220px" height="30px"></iframe>
						</p>
						-->
						
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
