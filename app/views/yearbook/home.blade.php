	@extends('page.home-without-leftnav')

@section('mainbodycontent')

	@if($basic_info_check == "True")

		<div class="col-sm-12 col-md-10 col-md-offset-1">
			<h4>Yearbook Home</h4>
			<hr>
			<p class="text-center">
			  Graduating Year : <strong>{{ $basic_info->graduatingyear }}</strong> <a href="{{ URL::route('basic-info') }}" class="btn btn-sm btn-warning">Edit</a>
			</p>

			<hr>
			<h6 class="text-center">Your Yearbook entry</h6>
			<!-- Profile Photo  -->
			<form class="form-horizontal">
				<div class="form-group" style="margin-bottom:15px;">
					<strong for="profile_photo" class="col-sm-12 col-md-4 control-label">Profile Photo: </strong>
					<div class="col-sm-12 col-md-8">
						@if(empty($basic_info->profile_image))
						<img style="max-height:250px; max-width:250px" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
						@else
						<img style="max-height:250px; max-width:250px" src="{{ $basic_info->profile_image }}">
						@endif
						<br>
						<a style="width:250px;" href="{{ URL::route('basic-info-profile-photo') }}" class="btn btn-inverse">Edit Photo</a>
					</div>
				</div>
			</form>
			@if(is_null($user_yearbook))
				<p>
					Your Yearbook entry is currently empty. <a class="" href="{{ url('/yearbook') }}/{{ Auth::user()->rollno }}/edit">Click here</a> to fill it.
				</p>
			@else
			<form class="form-horizontal">
				<div class="form-group" style="margin-bottom:15px;">
					<strong for="profile_photo" class="col-sm-12 col-md-4 control-label">Yearbook Icons: </strong>
					<div class="col-sm-12 col-md-8">
						@if(empty($user_yearbook->insti_life_icons))
						<img style="max-height:50px; max-width:50px; margin-right:10px;" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
						<img style="max-height:50px; max-width:50px; margin-right:10px;" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
						<img style="max-height:50px; max-width:50px; margin-right:10px;" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
						@else
						<img style="max-height:50px; max-width:50px" src="{{ $basic_info->profile_image }}">
						@endif
						<br>
						<a style="width:178px; margin-top:10px;" data-toggle="modal" data-target="#yearbookIconsModal" class="btn btn-inverse">Edit Yearbook Icons</a>
					</div>
				</div>
				<div class="form-group">
					<strong for="insti_remember_for" class="col-sm-12 col-md-4 control-label">I'll always remember Insti for: </strong>
					<div class="col-sm-12 col-md-8">
					  <span id="insti_remember_for">{{ $user_yearbook->insti_remember_for }}</span>
					</div>
				</div>
				<div class="form-group">
					<strong for="insti_name" class="col-sm-12 col-md-4 control-label">Insti Name: </strong>
					<div class="col-sm-12 col-md-8">
					  <span id="insti_name">{{ $user_yearbook->insti_name }}</span>
					</div>
				</div>
				<div class="form-group">
					<strong for="insti_craziest_moment" class="col-sm-12 col-md-4 control-label">Craziest moment in Insti life: </strong>
					<div class="col-sm-12 col-md-8">
					  <span id="insti_craziest_moment">{{ $user_yearbook->insti_craziest_moment }}</span>
					</div>
				</div>
			</form>
			<div class="col-sm-12 text-center">
				<a href="{{ url('/yearbook') }}/{{ Auth::user()->rollno }}/edit" class="btn btn-primary">Make changes to your Yearbook entry</a>
			</div>
			@endif
			<br>
			<hr>
			<p>
				Would you like to contribute to the Batch Project?
				<br>
				@if(is_null($user_yearbook))
					<span style="font-size:22px; font-weight:900;">Yes</span><br>
					To change your answer, kindly fill your Yearbook entry first.
				@else
					<!-- Button trigger modal -->
					<span style="font-size:22px; font-weight:900;">Yes</span>
					<a class="" data-toggle="modal" data-target="#myModal">
					(Click here to change response)
					</a>
				@endif
			</p>

        </div>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Order Yearbook?</h4>
		      </div>
		      <div class="modal-body">
		        Would you like to contribute to the Batch Project?
				<div class="row">
					<div class="col-sm-12 col-md-6 col-md-offset-3" style="margin-top:20px;">
						<a class="btn btn-block btn-success btn-lg">Yes, I would.</a>
					</div>
					<div class="col-sm-12 text-center" style="margin-top:20px;">
						OR
					</div>
					<div class="col-sm-12 col-md-6 col-md-offset-3" style="margin-top:20px;">
						<a class="btn btn-block btn-danger btn-lg">No. I don't</a>
					</div>
				</div>
				<p>
					<br>
					If you choose NO, you will not receive the Yearbook.
				</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="yearbookIconsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Choose Yearbook Icons</h4>
		      </div>
		      <div class="modal-body">
		        Choose three icons that best describe you.
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

	@elseif($basic_info_check == "False")
		<strong>Note:</strong> You must fill the <a href="{{ URL::route('basic-info') }}" >
		<strong>Basic Information Form</strong></a> before you can edit the Yearbook Entry.
		<br>This Information is required for us to be able to contact you.
	@endif
@stop
