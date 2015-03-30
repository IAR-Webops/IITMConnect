@extends('layout.main')

@section('content')
	@if(Auth::check())
		
		Hello. You are logged in as {{ Auth::user()->rollno }}    
	
	@else
		
		Sorry, not signed in.


	@endif
@stop