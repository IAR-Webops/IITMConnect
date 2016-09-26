@extends('layout.main')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 col-md-offset-2 col-md-8">
			@if(!is_null($affinity_program))
			<h4 class="text-center">{{ $affinity_program->name }}</h4>
		    <hr>

		    <div class="row">
		    	<div class="col-sm-12 col-md-4 text-center">
		    		<img src="{{ $affinity_program->image }}" style="height:200px;">
		    	</div>
		    	<div class="col-sm-12 col-md-8">
		    		<p>{{ $affinity_program->long_details }}</p>
		    		@if($affinity_programs_registration_status == "true")
		    			<p>You are registered for this program.</p>
		    		@else
		    			<form method="POST" action="{{ URL::route('affinityprogram-registration-post') }}">
		    				<p>You are not registered for this program.</p>
		    				<input type="hidden" name="affinityprogramId" value="{{ $affinity_program->id }}">
		    				<input type="hidden" name="affinityprogram_unique_name" value="{{ $affinity_program->unique_name }}">
		    				<button type="submit" class="btn btn-inverse btn-lg">Register Now</button>
			          		{{ Form::token() }}
		    			</form>
		    		@endif
		    	</div>
		    </div>
			<hr>
			<h6 class="text-center">The Deals</h6>
			<br>

				@if(!is_null($affinity_programs_offers))

				<div class="row">
					@foreach ($affinity_programs_offers as $affinity_programs_offer)
						    		<p></p>

							<div class="col-sm-12 col-md-4">
							  <div class="tile">
								<img src="{{ $affinity_programs_offer->image }}" alt="Affinity Program Offer" style="max-width:200px;" class="tile-image">
								<h3 class="tile-title">{{ $affinity_programs_offer->name }}</h3>
								<p>{{ $affinity_programs_offer->short_details }}</p>
								<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal{{ $affinity_programs_offer->id }}">
								  Offer Details
								</button>
							  </div>
							</div>


							<!-- Modal -->
							<div class="modal fade" id="myModal{{ $affinity_programs_offer->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">{{ $affinity_programs_offer->name }}</h4>
							      </div>
							      <div class="modal-body">
									  <p>
										  <strong><span style="color:#fff; background-color:#2f4154; padding:5px 8px; font-size:12px; letter-spacing:1px;">DETAILS</span></strong>
										  <span style="color:#777">{{ $affinity_programs_offer->long_details }}</span>
									  </p>
									  @if($affinity_programs_registration_status == "true")
										  <hr>
										  <span class="btn-inverse btn-block" style="padding:5px 15px;">Offer Code : {{ $affinity_programs_offer->offer_code }}</span>
										  <!-- <a href="#" class="btn btn-inverse btn-block" style="cursor:default">Offer Code : {{ $affinity_programs_offer->offer_code }}</a> -->
										  <p style="color:#777">{{ $affinity_programs_offer->offer_code_message }}</p>
									  @else
									  	  <p style="color:#777">You need to register to view the Promo Code.</p>
									  @endif
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
							<!-- END - Modal -->
					@endforeach
				</div>
					<hr>

				@else
					<p>Sorry! This Affinity Program does not exist or is currently inactive.</p>
				@endif
			@else
				<p>Sorry! This Affinity Program does not exist or is currently inactive.</p>
			@endif


        </div>
	</div>
</div>

@stop

@section('jscontent')

@stop
