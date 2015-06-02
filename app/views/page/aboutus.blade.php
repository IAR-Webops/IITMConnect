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
					<!-- Linkedin & Facebook Like Share Button -->
					<div class="text-center">
						<div>
						<p>
							<a href="https://www.linkedin.com/groups/IIT-Madras-Alumni-1747/about" target="_alt">
			                	<img src="{{ URL::asset('img/linkedin_join_group.png') }}" style="margin:0 10px 10px 0;">
				            </a>
						</p>
						</div>
						<div class="fb-page" data-href="https://www.facebook.com/iar.iitmadras/" data-width="500" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
			                <div class="fb-xfbml-parse-ignore">
			                <blockquote cite="https://www.facebook.com/iar.iitmadras/">
			                <a href="https://www.facebook.com/iar.iitmadras/">International and Alumni Relations, IIT Madras</a>
			                </blockquote>
			                </div>
			            </div>

			            <!--
						<p>Built with <span class="fui-heart"></span> by Yash Murty
						<iframe style="margin-top:15px;" src="https://ghbtns.com/github-btn.html?user=mdo&type=follow&count=true&size=large" frameborder="0" scrolling="0" width="220px" height="30px"></iframe>
						</p>
						-->
	
					</div>
				</div>
			</div>
			
		</div>

		


@stop
