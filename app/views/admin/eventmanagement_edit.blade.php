@extends('layout.main')

@section('content')
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-3 col-md-6">
		          <h4 class="text-center">Edit {{$event->event_name}}</h4>        	
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Your current Access Level to <a href="{{ URL::route('admin') }}">Admin Page</a> is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>

						<form action="{{ URL::to('/') }}/admin/eventmanagement/{{$event->event_unique_name}}/edit" class="form-horizontal" role="form" method="post">
				          	<!-- Field - Event Name -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Name :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_name" placeholder="Event Name *" value="{{ $event->event_name }}" required>
				              </div>				              
				            </div>
				          	<!-- Field - Roll Number -->
				            <div class="form-group">
				            	<div class="col-sm-12 col-md-4 text-right">				            
					            	<label class="text-right">Event Unique Name :</label>
					            </div>
				            	<div class="col-sm-12 col-md-8">
				              		<div class="input-group">
						              <span class="input-group-addon"><span class="fui-credit-card"></span></span>
						              <input type="text" class="form-control" name="event_unique_name" placeholder="event_unique_name" value="{{ $event->event_unique_name }}" disabled="">
						              <input type="text" class="form-control" name="event_unique_name" value="{{ $event->event_unique_name }}" style="display:none;">
						            </div>
					            </div>
				            </div>

				            <!-- Field - Event Details Short -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Detail Short :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <textarea type="text" class="form-control" name="event_details_short" placeholder="Limit 255 words" required>{{ $event->event_details_short }}</textarea>
				              </div>				              
				            </div>
				            <!-- Field - Event Details Long -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Detail Long :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <textarea type="text" class="form-control" name="event_details" placeholder="Limit 2000 words" required>{{ $event->event_details }}</textarea>
				              </div>				              
				            </div>
				            <!-- Field - Event Picture -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Picture URL :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_picture" placeholder="Event Picture URL" value="{{ $event->	event_picture }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Data -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Date :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_date" placeholder="Event Date" value="{{ $event->event_date }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Time -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Time :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_time" placeholder="Event Time" value="{{ $event->event_time }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Place -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Place :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <!--
				                <input type="text" class="form-control" name="event_place" placeholder="Event Place" value="{{ $event->event_place }}">
				              	-->
		
					            <!-- Field - Event Place Google Maps API -->
				              	<input id="event_place" class="controls" type="text" placeholder="Enter a location" name="event_place"
				              	value="{{ $event->event_place }}"
				              	style="background-color: #fff; font-family: Roboto;
								        font-size: 15px; font-weight: 300; margin-left: 12px;
								        padding: 0 11px 0 13px; text-overflow: ellipsis; width: 350px;
								        margin-top: 16px;">

							    <div id="type-selector" class="controls" style="display:none">
							      <input type="radio" name="type" id="changetype-all" checked="checked">
							      <label for="changetype-all">All</label>

							      <input type="radio" name="type" id="changetype-establishment">
							      <label for="changetype-establishment">Establishments</label>

							      <input type="radio" name="type" id="changetype-address">
							      <label for="changetype-address">Addresses</label>

							      <input type="radio" name="type" id="changetype-geocode">
							      <label for="changetype-geocode">Geocodes</label>
							    </div>
							    <div id="map-canvas" style="height:500px; "></div>

				              </div>				              
				            </div>

				            <!-- Field - Event Facebook Link -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Facebook Link :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_fb_event_link" placeholder="Event Facebook Link" value="{{ $event->event_fb_event_link }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Organizer -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Organizer :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="event_organizer" placeholder="Event Organizer" value="{{ $event->event_organizer }}">
				              </div>				              
				            </div>
				            <!-- Field - Event Status -->	
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event Status :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				              	<div class="bootstrap-switch-square">
				                  <input type="checkbox" data-toggle="switch" name="event_status" id="event_status" value="Open" />
				                </div>
				              </div>				              
				            </div>	
				            <!-- Field - Event RSVP Status -->	
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event RSVP Status :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				              	<div class="bootstrap-switch-square">
				                  <input type="checkbox" data-toggle="switch" name="event_rsvp_status" id="event_rsvp_status" value="Open" />
				                </div>
				              </div>				              
				            </div>
				            <!-- Field - Event Specific Questions -->	
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">				            
				            	<label class="text-right">Event has Specific Questions :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				              	<div class="bootstrap-switch-square">
				                  <input type="checkbox" data-toggle="switch" name="event_has_questions" id="event_has_questions" data-on-text="<span class='fui-check'></span>" data-off-text="<span class='fui-cross'></span>" value="Yes" />
				                </div>
				              </div>				              
				            </div>			           
							

				            <hr>
            
				          	<!-- Field - Submit -->
				          	<div class="form-group">
				          		<div class="col-sm-12 col-md-6">
				          			<input class="btn btn-block btn-lg btn-primary" type="submit" value="Save">
				          		</div>
				          		<div class="col-sm-12 col-md-6">
							        <a class="btn btn-block btn-lg btn-danger" href="{{ URL::route('admin-event-management') }}">Cancel</a>          			
				          		</div>
				          		{{ Form::token() }}
				          	</div>
				          	<hr>
				        </form>

				        <div class="col-sm-12">
				          <h4 class="text-center">Danger Zone</h4>        	
				          <hr>
							<p class="text-center">
								Click the button below to delete this event permanently.<br>
								Be advised, this action cannot be undone.
							</p>
							<p class="text-center">
						  		<a href="#fakelink" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#deleteEventModal">Delete Event</a>	
						  	</p>
						</div>


						<!-- Modal -->
						<div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
							<form action="{{ URL::to('/') }}/admin/eventmanagement/{{$event->event_unique_name}}/edit" class="form-horizontal" role="form" method="post">

						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Delete Event</h4>
						      </div>
						      <div class="modal-body">
						      	<div class="container-fluid">

						          	<!-- Field - Name -->
						            <div class="form-group">
						        	Are you sure you want to delete the event permanently?
									<input type="text" class="form-control" id="event_unique_name" name="event_unique_name" placeholder="Event Name" value="{{$event->event_unique_name}}" style="display:none">
						            </div>
						        </div>		        
						      </div>
						      <div class="modal-footer">
						        <button type="submit" class="btn btn-danger">Yes</button>
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						      </div>

						    	{{ Form::token() }}
							</form>
						    </div>
						  </div>
						</div>
						<!-- END - Modal -->	

					@elseif($admin_user_check == "False")
						<p>
						Sorry, You cannot access this page because your Access Level is not Admin. <br>
						If you are an Admin and are still seeing this message then contact the 
						Webops Team ASAP.
						</p>
					@else
						<p>There was an Internal Error. Contact the Webops Team with a screenshot of this ASAP.</p>
					@endif
				</div>
			</div>
		</div>
			


@stop

@section('jscontent')
<script type="text/javascript">
	if ("{{ $event->event_status }}" == "Open") {
			$('#event_status').attr('checked', true);
	} else{
			$('#event_status').attr('checked', false);
	};
	if ("{{ $event->event_rsvp_status }}" == "Open") {
			$('#event_rsvp_status').attr('checked', true);
	} else{
			$('#event_rsvp_status').attr('checked', false);
	};
	if ("{{ $event->event_has_questions }}" == "Yes") {
			$('#event_has_questions').attr('checked', true);
	} else{
			$('#event_has_questions').attr('checked', false);
	};


</script>
@stop

@section('jsmainbodycontent')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

<script>
function initialize() {
  var mapOptions = {
    center: new google.maps.LatLng(-33.8688, 151.2195),
    zoom: 13
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);

  var input = /** @type {HTMLInputElement} */(
      document.getElementById('event_place'));

  var types = document.getElementById('type-selector');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    google.maps.event.addDomListener(radioButton, 'click', function() {
      autocomplete.setTypes(types);
    });
  }

  setupClickListener('changetype-all', []);
  setupClickListener('changetype-address', ['address']);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>


@stop