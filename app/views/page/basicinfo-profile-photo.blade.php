@extends('page.home')

@section('mainbodycontent')

		<div class="col-sm-12 col-md-11">
          <h4>Profile Photo</h4>
          <hr>
          <!-- Profile Photo  -->
          @if(empty($basic_info->profile_image))
          <img style="max-height:250px; max-width:250px" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
          @else
          <img style="max-height:250px; max-width:250px" src="{{ $basic_info->profile_image }}">
          @endif

          <br>
          <br>
          <a style="width:250px;" href="{{ URL::route('basic-info-profile-photo') }}" class="btn btn-inverse">Upload New Photo</a>


@stop

@section('jsmainbodycontent')

@stop
