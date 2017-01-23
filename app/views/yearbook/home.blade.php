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
						Choose three icons that best describe you. <br>
						@if(empty($user_yearbook->insti_life_icons))
						<img style="max-height:50px; max-width:50px; margin-right:10px;" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
						<img style="max-height:50px; max-width:50px; margin-right:10px;" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
						<img style="max-height:50px; max-width:50px; margin-right:10px;" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
						@else
						<img style="max-height:50px; max-width:50px; margin-right:10px;" src="{{ URL::asset('img/icons/yearbook_icons') }}/{{ $yearbook_icons_array[0] }}">
						<img style="max-height:50px; max-width:50px; margin-right:10px;" src="{{ URL::asset('img/icons/yearbook_icons') }}/{{ $yearbook_icons_array[1] }}">
						<img style="max-height:50px; max-width:50px; margin-right:10px;" src="{{ URL::asset('img/icons/yearbook_icons') }}/{{ $yearbook_icons_array[2] }}">
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

				@if(is_null($user_yearbook))
					Would you like to contribute to the Batch Project?
					<br>
					<span style="font-size:22px; font-weight:900;">Not Decided</span><br>
					To change your answer, kindly fill your Yearbook entry first.
				@else
					@if($user_yearbook->order_status == "null")
						Would you like to contribute to the Batch Project?
						<br>
						<!-- Button trigger modal -->
						<span style="font-size:22px; font-weight:900;">Not Decided</span>
						<a class="" data-toggle="modal" data-target="#myModal">
						(Click here to change response)
						</a>
					@elseif($user_yearbook->order_status == "no")
						Would you like to contribute to the Batch Project?
						<br>
						<!-- Button trigger modal -->
						<span style="font-size:22px; font-weight:900;">No</span>
						<a class="" data-toggle="modal" data-target="#myModal">
						(Click here to change response)
						</a>
					@elseif($user_yearbook->order_status == "yes")
						<!-- Would you like to contribute to the Batch Project?
						<br> -->
						<!-- Button trigger modal -->
						<!-- <span style="font-size:22px; font-weight:900;">Yes</span>
						<a class="" data-toggle="modal" data-target="#myModal">
						(Click here to change response)
						</a> -->
					@endif


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
						<a id="order_status_yes" class="btn btn-block btn-success btn-lg">Yes, I would.</a>
					</div>
					<div class="col-sm-12 text-center" style="margin-top:20px;">
						OR
					</div>
					<div class="col-sm-12 col-md-6 col-md-offset-3" style="margin-top:20px;">
						<a id="order_status_no" class="btn btn-block btn-danger btn-lg">No. I don't</a>
					</div>
					<form action="{{ url('/') }}/yearbook/{{ Auth::user()->rollno }}/order-status/edit" id="form_yearbook_order_status" role="form" method="post">
						<input value="" type="hidden" name="order_status_value" id="order_status_value">
						{{ Form::token() }}
					</form>

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
				<br>
				<br>
				<div class="col-sm-12">
				<form action="{{ url('/') }}/yearbook/{{ Auth::user()->rollno }}/icons/edit" id="form_yearbook_icons" role="form" method="post">

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="artist.png" id="artist.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/artist.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="athelectics.png" id="athelectics.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/athelectics.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="badminton.png" id="badminton.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/badminton.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="basketball.png" id="basketball.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/basketball.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="coder.png" id="coder.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/coder.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="cook.png" id="cook.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/cook.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="cricket.png" id="cricket.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/cricket.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="debate_speaker.png" id="debate_speaker.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/debate_speaker.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="dramatists.png" id="dramatists.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/dramatists.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="foodie.png" id="foodie.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/foodie.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="football.png" id="football.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/football.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="gamer.png" id="gamer.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/gamer.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="graphic_designer.png" id="graphic_designer.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/graphic_designer.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="hockey.png" id="hockey.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/hockey.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="instrumental_artist.png" id="instrumental_artist.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/instrumental_artist.png') }}">
		          </label>

				  <label class="checkbox col-sm-6 col-md-3" >
		            <input type="checkbox" value="lawn_tennis.png" id="lawn_tennis.png" name="yearbook_icons[]" data-toggle="checkbox">
					<img style="max-height:50px; max-width:50px; margin-top:-16px;" src="{{ URL::asset('img/icons/yearbook_icons/lawn_tennis.png') }}">
		          </label>

				  <div class="col-sm-12 col-md-6">
            		<!-- <input class="btn btn-block btn-lg btn-primary" type="submit" value="Save"> -->

            	  </div>

				  {{ Form::token() }}
			  	</form>
		        </div>

		      </div>
		      <div class="" style="margin:15px">
				  <button type="button" class="btn btn-primary" onclick="saveYearbookIcons()">Save Icons</button>
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

@section('jscontent')
<script>
var limit = 3;
$('input[type=checkbox]').on('change', function (e) {
    if ($('input[type=checkbox]:checked').length > limit) {
        $(this).prop('checked', false);
		$.notify("Sorry, You can select only Three icons", "error");
    }
});

function saveYearbookIcons() {
	if ($('input[type=checkbox]:checked').length == limit) {
		document.getElementById("form_yearbook_icons").submit();
    } else {
		$.notify("Sorry, You must select Three icons", "error");

	}
}

$("#order_status_yes").click(function() {
	saveOrderStatus("yes");
});
$("#order_status_no").click(function() {
	saveOrderStatus("no");
});

function saveOrderStatus(order_value){
	$("#order_status_value").val(order_value);
	document.getElementById("form_yearbook_order_status").submit();
}
</script>
@stop
