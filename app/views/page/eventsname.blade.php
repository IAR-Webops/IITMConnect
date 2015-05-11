@extends('layout.main')

@section('content')

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">{{$event->event_name}}</h4>        	
		          <hr>
				  {{$event->event_details}}		               
				  <br>
				  <p>
				  		Hi {{$basic_info->firstname}}, we will contact you at <br>
				  		<span class="fui-mail"></span> : {{$basic_info->email}} <a href="{{ URL::route('basic-info') }}">Edit</a><br>
				  		<span class="fui-list-small-thumbnails"></span> : {{$basic_info->phone}} <a href="{{ URL::route('basic-info') }}">Edit</a>
				  	</p>
				  <div class="col-sm-12 col-md-8 col-md-offset-2 text-center">				  	
					<a onclick="attendevent({{$event->event_id}})" id="attendeventbtn" style="margin:15px 0 15px 0;" class="btn btn-block btn-lg btn-primary">Attend Event</a>
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
					<br>
					<img class="img-rounded img-responsive" style="display:inline; margin-top:15px;" src="{{$event->event_picture}}">
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