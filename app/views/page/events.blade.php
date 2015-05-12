@extends('layout.main')

@section('content')

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">Events</h4>        	
		          <hr>
		          @if($basic_info_check == "True")
		          	Upcoming Events : <br>	          	
		          @elseif($basic_info_check == "False")
		          	<strong>Note:</strong> You must fill the <a href="{{ URL::route('basic-info') }}" >
		          	<strong>Basic Information Form</strong></a> before you can view Details for any Event.
		          @endif

		          @if($admin_user_check == "True")						
						Your current Access Level for <a href="{{ URL::route('admin') }}">Admin Page</a> is : 
						<strong>{{ $admin_user->user_level }}</strong>						
				  @endif
		          
		          <br>
				  <br>
				  <div class="col-sm-12">
					@foreach ($events as $event)
					
					    <div class="tile">
					    	<div class="row">
						    	<div class="col-sm-12 col-md-4">
						            <img src="img/icons/svg/gift-box.svg" alt="Compas" class="tile-image big-illustration">						    		
						    	</div>	
						    	<div class="col-sm-12 col-md-8">
						            <h3 class="tile-title" style="margin-top:20px;">{{$event->event_name}}</h3>
						            <br>
						            <p>{{$event->event_details_short}}
						            <br><br>					            
						            	<span class="fui-calendar"></span> - {{$event->event_date}}
						            	|
						            	<span class="fui-time"></span> - {{$event->event_time}}
						            	|
						            	<span class="fui-location"></span> - {{$event->event_place}}						            	
						            </p>						            
						            <a class="btn btn-primary btn-large btn-block vieweventdetailsbtn" href="{{ URL::to('/') }}/events/{{$event->event_unique_name}}">View Event Details</a>
				            	</div>
				            </div>
				        </div>
					
					@endforeach
				  </div>
				</div>
			</div>
		</div>
			


@stop

@section('jscontent')

	<script type="text/javascript">
		basic_info_check = "{{$basic_info_check}}";
		if(basic_info_check == "False"){
			$(".vieweventdetailsbtn").addClass('disabled');
		}

	</script>
@stop