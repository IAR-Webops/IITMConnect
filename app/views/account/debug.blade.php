@extends('layout.main')

@section('content')

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">Debug</h4>        	
		          <hr>		       
		          <p><strong>Oops!</strong> Looks like something went wrong. Please take a screenshot of this page and mail it to 
		          <strong><a href="mailto:yashmurty@gmail.com?Subject=Error%20iitmconnect" target="_alt">yashmurty@gmail.com</a></strong> <br>
		          You can also report this issue on <a href="https://github.com/IAR-Webops/IITMConnect/issues">Github</a> for
		          easier tracking of the bug.
		          </p>
				  <p>Go back to <a href="{{ URL::route('home') }}"><strong>Home Page</strong></a></p>
					
			        @if(Session::has('errororigin'))
			        	<strong>{{ Session::get('errororigin') }}</strong>
					@endif
				  <hr>
				  <!-- Google Plus Errors -->
				  <p><strong>Google Plus Errors :</strong></p>
		            @if($errors->has('googleplus_id'))
						{{ $errors->first('googleplus_id')}} <br>					
						You Entered : {{ Input::old('googleplus_id') }} <br>
					@endif
					@if($errors->has('googleplus_name'))
						{{ $errors->first('googleplus_name')}} <br>					
						You Entered : {{ Input::old('googleplus_name') }} <br>
					@endif
					@if($errors->has('googleplus_firstname'))
						{{ $errors->first('googleplus_firstname')}} <br>					
						You Entered : {{ Input::old('googleplus_firstname') }} <br>
					@endif
					@if($errors->has('googleplus_lastname'))
						{{ $errors->first('googleplus_lastname')}} <br>					
						You Entered : {{ Input::old('googleplus_lastname') }} <br>
					@endif
					@if($errors->has('googleplus_email'))
						{{ $errors->first('googleplus_email')}} <br>					
						You Entered : {{ Input::old('googleplus_email') }} <br>
					@endif
					@if($errors->has('googleplus_link'))
						{{ $errors->first('googleplus_link')}} <br>					
						You Entered : {{ Input::old('googleplus_link') }} <br>
					@endif
					@if($errors->has('googleplus_picture'))
						{{ $errors->first('googleplus_picture')}} <br>					
						You Entered : {{ Input::old('googleplus_picture') }} <br>
					@endif
					@if($errors->has('googleplus_gender'))
						{{ $errors->first('googleplus_gender')}} <br>					
						You Entered : {{ Input::old('googleplus_gender') }} <br>
					@endif
					@if($errors->has('googleplus_accesstoken'))
						{{ $errors->first('googleplus_accesstoken')}} <br>					
						You Entered : {{ Input::old('googleplus_accesstoken') }} <br>
					@endif
					@if($errors->has('rollno'))
						{{ $errors->first('rollno')}} <br>					
						You Entered : {{ Input::old('rollno') }} <br>
					@endif
					
				  <hr>
				  <p><strong>Linkedin Errors :</strong></p>
				    @if($errors->has('linkedin_id'))
						{{ $errors->first('linkedin_id')}} <br>					
						You Entered : {{ Input::old('linkedin_id') }} <br>
					@endif
					@if($errors->has('linkedin_name'))
						{{ $errors->first('linkedin_name')}} <br>					
						You Entered : {{ Input::old('linkedin_name') }} <br>
					@endif
					@if($errors->has('linkedin_firstname'))
						{{ $errors->first('linkedin_firstname')}} <br>					
						You Entered : {{ Input::old('linkedin_firstname') }} <br>
					@endif
					@if($errors->has('linkedin_lastname'))
						{{ $errors->first('linkedin_lastname')}} <br>					
						You Entered : {{ Input::old('linkedin_lastname') }} <br>
					@endif
					@if($errors->has('linkedin_email'))
						{{ $errors->first('linkedin_email')}} <br>					
						You Entered : {{ Input::old('linkedin_email') }} <br>
					@endif
					@if($errors->has('linkedin_link'))
						{{ $errors->first('linkedin_link')}} <br>					
						You Entered : {{ Input::old('linkedin_link') }} <br>
					@endif
					@if($errors->has('linkedin_picture'))
						{{ $errors->first('linkedin_picture')}} <br>					
						You Entered : {{ Input::old('linkedin_picture') }} <br>
					@endif
					@if($errors->has('linkedin_headline'))
						{{ $errors->first('linkedin_headline')}} <br>					
						You Entered : {{ Input::old('linkedin_headline') }} <br>
					@endif
					@if($errors->has('linkedin_accesstoken'))
						{{ $errors->first('linkedin_accesstoken')}} <br>					
						You Entered : {{ Input::old('linkedin_accesstoken') }} <br>
					@endif
					@if($errors->has('rollno'))
						{{ $errors->first('rollno')}} <br>					
						You Entered : {{ Input::old('rollno') }} <br>
					@endif

				  <hr>					
				  <p><strong>Facebook Errors :</strong></p>
				    @if($errors->has('facebook_id'))
						{{ $errors->first('facebook_id')}} <br>					
						You Entered : {{ Input::old('facebook_id') }} <br>
					@endif
					@if($errors->has('facebook_name'))
						{{ $errors->first('facebook_name')}} <br>					
						You Entered : {{ Input::old('facebook_name') }} <br>
					@endif
					@if($errors->has('facebook_firstname'))
						{{ $errors->first('facebook_firstname')}} <br>					
						You Entered : {{ Input::old('facebook_firstname') }} <br>
					@endif
					@if($errors->has('facebook_lastname'))
						{{ $errors->first('facebook_lastname')}} <br>					
						You Entered : {{ Input::old('facebook_lastname') }} <br>
					@endif
					@if($errors->has('facebook_gender'))
						{{ $errors->first('facebook_gender')}} <br>					
						You Entered : {{ Input::old('facebook_gender') }} <br>
					@endif
					@if($errors->has('facebook_email'))
						{{ $errors->first('facebook_email')}} <br>					
						You Entered : {{ Input::old('facebook_email') }} <br>
					@endif
					@if($errors->has('facebook_picture'))
						{{ $errors->first('facebook_picture')}} <br>					
						You Entered : {{ Input::old('facebook_picture') }} <br>
					@endif
					@if($errors->has('facebook_accesstoken'))
						{{ $errors->first('facebook_accesstoken')}} <br>					
						You Entered : {{ Input::old('facebook_accesstoken') }} <br>
					@endif
					@if($errors->has('rollno'))
						{{ $errors->first('rollno')}} <br>					
						You Entered : {{ Input::old('rollno') }} <br>
					@endif
				  <hr>

				</div>
			</div>
		</div>
		


@stop
