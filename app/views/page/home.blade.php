@extends('layout.main')

@section('content')
	@if(Auth::check())
		
		Hello. You are logged in          
	
	@else
		
		Sorry, not signed in.


	@endif
@stop