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

					@foreach ($affinity_programs_offers as $affinity_programs_offer)
						<div class="row">
					    	<div class="col-sm-12 col-md-4 text-center"  >
					    		<img src="{{ $affinity_programs_offer->image }}" style="height:150px;">
					    	</div>
					    	<div class="col-sm-12 col-md-8" style="border-left:medium #AAA solid; ">
					    		<p>{{ $affinity_programs_offer->name }}</p>
					    		<hr>
					    		<p>{{ $affinity_programs_offer->short_details }}</p>
					    		<p>
					    			<strong><span style="color:#fff; background-color:#2f4154; padding:5px 8px; font-size:12px; letter-spacing:1px;">DETAILS</span></strong> 
					    			<span style="color:#777">{{ $affinity_programs_offer->long_details }}</span>
					    		</p>
					    		@if($affinity_programs_registration_status == "true")
					    			<hr>
						    		<span class="btn-inverse btn-block" style="padding:5px 15px;">Offer Code : {{ $affinity_programs_offer->offer_code }}</span>
						    		<!-- <a href="#" class="btn btn-inverse btn-block" style="cursor:default">Offer Code : {{ $affinity_programs_offer->offer_code }}</a> -->
						    		<p style="color:#777">{{ $affinity_programs_offer->offer_code_message }}</p>
					    		@endif
					    	</div>
					    </div>
						<hr>
					@endforeach

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
