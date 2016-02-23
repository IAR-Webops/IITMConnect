@extends('layout.main')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 col-md-offset-3 col-md-6">
			@if(!is_null($access_program))
			<h4 class="text-center">{{ $access_program->name }}</h4>        	
		    <hr>

		    <div class="row">
		    	<div class="col-sm-12 col-md-4 text-center">
		    		<img src="{{ $access_program->image }}" style="height:200px;">
		    	</div>
		    	<div class="col-sm-12 col-md-8">
		    		<p>{{ $access_program->long_details }}</p>
		    		@if($access_programs_registration_status == "true")
		    			<p>You are registered for this program.</p>
		    		@else
		    			<form method="POST" action="{{ URL::route('accessprogram-registration-post') }}">
		    				<p>You are not registered for this program.</p>
		    				<input type="hidden" name="accessprogramId" value="{{ $access_program->id }}">
		    				<input type="hidden" name="accessprogram_unique_name" value="{{ $access_program->unique_name }}">
		    				<button type="submit" class="btn btn-inverse btn-lg">Register Now</button>
			          		{{ Form::token() }}
		    			</form>
		    		@endif
		    	</div>
		    </div>
			<hr>
			<h6 class="text-center">The Deals</h6>		
			<br>	

				@if(!is_null($access_programs_offers))

					@foreach ($access_programs_offers as $access_programs_offer)
						<div class="row">
					    	<div class="col-sm-12 col-md-4 text-center"  >
					    		<img src="{{ $access_programs_offer->image }}" style="height:150px;">
					    	</div>
					    	<div class="col-sm-12 col-md-8" style="border-left:medium #AAA solid; ">
					    		<p>{{ $access_programs_offer->name }}</p>
					    		<hr>
					    		<p>{{ $access_programs_offer->short_details }}</p>
					    		<p>
					    			<strong><span style="color:#fff; background-color:#2f4154; padding:5px 8px; font-size:12px; letter-spacing:1px;">DETAILS</span></strong> 
					    			<span style="color:#777">{{ $access_programs_offer->long_details }}</span>
					    		</p>
					    		@if($access_programs_registration_status == "true")
					    			<hr>
						    		<span class="btn-inverse btn-block" style="padding:5px 15px;">Offer Code : {{ $access_programs_offer->offer_code }}</span>
						    		<!-- <a href="#" class="btn btn-inverse btn-block" style="cursor:default">Offer Code : {{ $access_programs_offer->offer_code }}</a> -->
						    		<p style="color:#777">{{ $access_programs_offer->offer_code_message }}</p>
					    		@endif
					    	</div>
					    </div>
						<hr>
					@endforeach

				@else
					<p>Sorry! This Access Program does not exist or is currently inactive.</p>
				@endif
			@else
				<p>Sorry! This Access Program does not exist or is currently inactive.</p>
			@endif


        </div>
	</div>        
</div>

@stop

@section('jscontent')

@stop
