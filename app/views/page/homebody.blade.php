@extends('page.home')

@section('mainbodycontent')

	<p>Hello {{ $basic_info->firstname }},</p>	
	<p>Welcome to <strong>#iitmconnect</strong></p>
	<p>The purpose of this app is to help you to stay in touch with insti forever. <br>
	Please fill in your details by choosing the forms from the menu on the left.</p> 
	<p>We would really appriciate if you spread a word about this to your friends too.</p>
	<p>With warm regards,<br>
	I&AR Team</p>

	<p><strong>PS:</strong> If you face any issues, visit the About Us section to get more details on how to report an Issue.</p>

@stop