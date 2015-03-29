@extends('layout.main')

@section('content')
	@if(Auth::check())
		
		Hello. You are logged in as {{ Auth::user()->rollno }}    
		<br><br>
		<a href="{{ URL::route('account-sign-out') }}">Sign Out</a>
	
	@else
		
		Sorry, not signed in.


	@endif
@stop