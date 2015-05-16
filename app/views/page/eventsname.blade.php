@extends('layout.main')

@section('content')

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">{{$event->event_name}}</h4>        	
		          <hr>
				  {{$event->event_details}}		               
				  <hr>
				  <p>
				  		Hi {{$basic_info->firstname}}, we will contact you at <br>
				  		<span class="fui-mail"></span> : {{$basic_info->email}} <a href="{{ URL::route('basic-info') }}">Edit</a><br>
				  		<span class="fui-list-small-thumbnails"></span> : {{$basic_info->phone}} <a href="{{ URL::route('basic-info') }}">Edit</a>
				  </p>
				  
				  <hr>
				  <p>
				  	You must fill the <strong>Event Specific Questions</strong> to become eligible to attend
				  	the Event. Click on the button below to fill the short questionnaire.
				  </p>
				  <div class="col-sm-12 col-md-8 col-md-offset-2 text-center">
				  	<a href="#fakelink" class="btn btn-block btn-lg btn-inverse" data-toggle="modal" data-target="#esqModal">Event Specific Questions</a>	
				  	@if(empty($events_specific_questions_answers))
					  	<p style="font-size:12px" id="esqstatusmessage"><strong>Status : </strong>You have not answered the Event Specific Questions yet.</p>			  	
					@else
					  	<p style="font-size:12px" id="esqstatusmessage"><strong>Status : </strong>You have Successfully answered the Event Specific Questions.</p>			  	
					@endif		

					@if($event->event_rsvp_status == "Open")
					  	@if(empty($events_specific_questions_answers))
							<a onclick="attendevent({{$event->event_id}})" id="attendeventbtn" style="margin:15px 0 15px 0;" class="btn btn-block btn-lg btn-primary disabled">Attend Event</a>
						@else
							<a onclick="attendevent({{$event->event_id}})" id="attendeventbtn" style="margin:15px 0 15px 0;" class="btn btn-block btn-lg btn-primary">Attend Event</a>					
						@endif
					@elseif($event->event_rsvp_status == "Closed")					
						<p><strong>RSVP for the Event has now Closed</strong></p>
					@else
						<p><strong>RSVP for the Event will open soon</strong></p>						
					@endif
					<div id="cancelevent" style="display:none;">
						<p><strong>You are attending this Event.</strong></p>
						<a onclick="cancelevent({{$event->event_id}})" id="canceleventbtn" style="margin:15px 0 15px 0;" class="btn btn-block btn-lg btn-danger">Cancel</a>					
					</div>
					<span class="fui-calendar"></span> - {{$event->event_date}}
					<br>
					<span class="fui-time"></span> - {{$event->event_time}}
					<br>
					<span class="fui-location"></span> - {{$event->event_place}}
					<br>
					<span class="fui-user"></span> - Organizer : {{$event->event_organizer}}
					<hr>

					<p>Get notified about the latest updates by following the Event on Facebook
					  <br><a target="_alt" href="{{$event->event_fb_event_link}}">
					  <span class="fui-facebook"></span> | {{$event->event_name}}</a>
					</p>
					<img class="img-rounded img-responsive" style="display:inline; margin-top:15px;" src="{{$event->event_picture}}">
					<hr>  
				  </div>
				</div>
			</div>
		</div>


<!-- Modal -->
<div class="modal fade" id="esqModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form action="{{ URL::route('events-questions-answers-post') }}" class="form-horizontal" role="form" method="post">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Questionnaire for {{$event->event_name}}</h4>
      </div>
      <div class="modal-body">
      	<div class="container-fluid">
      		Hello {{$basic_info->firstname}},<br>
	        @if($basic_info->optionsRadiosFuture == "Higher Studies")

		          	<!-- Field - Name -->
		            <div class="form-group">
		        	Fill this questionnaire and become eligible to attend the event.			            
		              <div class="col-sm-12">
		                <label>University Name :</label>
		                <input type="text" class="form-control" name="universityname" placeholder="University Name *" value="{{ $basic_info->future_field1 }}" disabled="">
		              </div>
		            
		              <div class="col-sm-12">
		                <label>Departments Name :</label>		              
		                <input type="text" class="form-control" name="departmentname" placeholder="Department Name *" value="{{ $basic_info->future_field2 }}" disabled="">
		              </div>
		              <p>Change the above values in <a href="{{ URL::route('basic-info') }}"><strong>Basic Information Form</strong></a>.</p>
		              @if(!is_null($events_specific_questions))
			              @foreach ($events_specific_questions as $events_specific_question)
						  <div class="col-sm-12">
			                <label>{{ $events_specific_question->question_value }}</label>
			                <input type="text" class="form-control" name="{{ $events_specific_question->question_id }}" placeholder="{{ $events_specific_question->question_placeholder }}" value="" required>
			              </div>
						  @endforeach  

			          <input type="text" class="form-control" name="event_id" style="display:none;" value="{{$event->event_id}}">
			          <input type="text" class="form-control" name="event_unique_name" style="display:none;" value="{{$event->event_unique_name}}">

					  @else
					  	There are no Event Specific Questions for this event. Just click Save Changes
					  @endif          

		            </div>
		          
	        @else
	        	This Event is only open for students pursuing Higer studies in the US. 	

	        @endif
            
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    @if($basic_info->optionsRadiosFuture == "Higher Studies")
        	<button type="submit" class="btn btn-primary">Save changes</button>
      	@else
        	<button type="submit" class="btn btn-primary disabled">Save changes</button>      		
      	@endif
      </div>

    	{{ Form::token() }}
	</form>
    </div>
  </div>
</div>
			


@stop

@section('jscontent')
	<script type="text/javascript">
		eventattendance_check = "{{ $eventattendance_check }}";
		if(eventattendance_check == "True") {
			$("#attendeventbtn").hide();
			$("#cancelevent").show();     						     			
		} 

		function attendevent(event_id){
			$("#attendeventbtn").addClass('disabled');

			$.ajax({
			    url: "{{ URL::route('events-attendance-post') }}",
			    type: 'POST',
			    data: "event_id="+event_id,
			    beforeSend: function(request) {
			        return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
			    },
			    success: function(result) {
			        // Do something with the result
					$.notify(result ,"success");	   
					$("#attendeventbtn").hide();
					$("#cancelevent").show();     
					//$("#por_row_id_"+oauthclient).fadeOut();
					//$.notify("Under Construction " + id ,"error");	        
			    },
			    error: function(xhr, status, error) {
				  //var err = eval("(" + xhr.responseText + ")");
				  //alert(err.Message);
				  //alert(xhr.responseText);
					$.notify("Unable to Attend Event. Contact Webops Team" ,"error");	        
				}
			});			
		}

		function cancelevent(event_id){
			$("#attendeventbtn").removeClass('disabled');			
			$.ajax({
			    url: "{{ URL::route('events-attendance-delete') }}",
			    type: 'DELETE',
			    data: "event_id="+event_id,
			    beforeSend: function(request) {
			        return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
			    },
			    success: function(result) {
			        // Do something with the result
					$.notify(result ,"error");	   
					$("#attendeventbtn").show();
					$("#cancelevent").hide();     
					//$("#por_row_id_"+oauthclient).fadeOut();
					//$.notify("Under Construction " + id ,"error");	        
			    },
			    error: function(xhr, status, error) {
				  //var err = eval("(" + xhr.responseText + ")");
				  //alert(err.Message);
				  //alert(xhr.responseText);
					$.notify("Unable to Cancel Event Attendance. Contact Webops Team" ,"error");	        
				}
			});			
		}
	</script>
@stop