@extends('page.home-without-leftnav')

@section('mainbodycontent')

		<div class="col-sm-12 col-md-10 col-md-offset-1">
			<h4>Yearbook Home</h4>
			<hr>
			<p class="text-center">
			  Graduating Year : <strong>{{ $basic_info->graduatingyear }}</strong> <a href="{{ URL::route('basic-info') }}" class="btn btn-sm btn-warning">Edit</a>
			</p>
			<p>
				Would you like to order the Yearbook?<br>
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
			<hr>
			<h6 class="text-center">Your Yearbook entry</h6>
			@if(is_null($user_yearbook))
				<p>
					Your Yearbook entry is currently empty. <a class="" href="{{ url('/yearbook') }}/{{ Auth::user()->rollno }}/edit">Click here</a> to fill it.
				</p>
			@else
			<form class="form-horizontal">
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
			<hr>
			<div class="col-sm-12 text-center">
				<a href="{{ url('/yearbook') }}/{{ Auth::user()->rollno }}/edit" class="btn btn-primary">Make changes to your Yearbook entry</a>
			</div>
			@endif

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
		        Would you like to order the Yearbook?
				<div class="row">
					<div class="col-sm-12 col-md-6 col-md-offset-3" style="margin-top:20px;">
						<a class="btn btn-block btn-success btn-lg">Yes, I would like to Order</a>
					</div>
					<div class="col-sm-12 text-center" style="margin-top:20px;">
						--- OR ---
					</div>
					<div class="col-sm-12 col-md-6 col-md-offset-3" style="margin-top:20px;">
						<a class="btn btn-block btn-danger btn-lg">No. I don't</a>
					</div>
				</div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

@stop
