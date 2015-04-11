@extends('layout.main')

@section('content')
	@if(Auth::check())

		<div class="container-fluid">
			<div class="row">
				<!-- START - Navigation Left -->
					@include('layout.navigation-left')
				<!-- END - Navigation Left -->

				<!-- START - Main Body -->
			  		<div class="col-sm-12 col-md-8 col-lg-9">
						@yield('mainbodycontent')
			  		</div>
				<!-- END - Main Body -->

			</div>  
		</div>
		
	@else
		
		Sorry, not signed in.


	@endif
@stop

@section('jscontent')
	
@stop