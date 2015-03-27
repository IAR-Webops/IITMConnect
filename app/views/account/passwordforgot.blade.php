@extends('layout.main')

@section('content')
<!--
	<form action="{{ URL::route('account-forgot-password-post') }}" method="post">
		<div class="field">
			Email: <input type="text" name="email" value="{{ Input::old('email') }}"> 
			@if($errors->has('email'))
				{{ $errors->first('email')}}
			@endif
		</div>
		
		<input type="submit" value="Recover">
			{{ Form::token() }}
	</form>
-->

    @include('layout.login-top') 
    
              

    @include('layout.login-bottom')

@stop