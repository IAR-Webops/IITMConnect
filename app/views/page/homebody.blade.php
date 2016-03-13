@extends('page.home')

@section('mainbodycontent')

	<p>Hello {{ $basic_info->firstname }},</p>	
	<p>Welcome to <strong>#iitmconnect</strong></p>
	<p>The purpose of this app is to help you to stay in touch with insti forever. <br>
	Please fill in your details by choosing the forms from the menu on the left.</p> 
	<p>We would really appreciate if you spread a word about this to your friends too.</p>
	<p>With warm regards,<br>
	I&AR Team</p>

	<p><strong>PS:</strong> Facing issues? <a href="{{ URL::route('report-issues') }}">Report here</a></p>

@stop