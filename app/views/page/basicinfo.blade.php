@extends('page.home')

@section('mainbodycontent')
	
		<div class="col-sm-12 col-md-11">
          <h4>Basic Information</h4>        	
          <hr>
          <form action="{{ URL::route('basic-info-post') }}" class="form-horizontal" role="form" method="post">
          	<!-- Field - Name -->
            <div class="form-group">
              <div class="col-sm-12 col-md-4">
                <input type="text" class="form-control" name="firstname" placeholder="First Name *" value="{{ $basic_info->firstname }}" required>
              </div>
              <div class="col-sm-12 col-md-4">
                <input type="text" class="form-control" name="middlename" placeholder="Middle Name" value="{{ $basic_info->middlename }}">
              </div>
              <div class="col-sm-12 col-md-4">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name *" value="{{ $basic_info->lastname }}" required>
              </div>
            </div>
          	<!-- Field - Roll Number -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-credit-card"></span></span>
		              <input type="text" class="form-control" placeholder="Roll Number" value="{{ Auth::user()->rollno }}" disabled="">
		            </div>
	            </div>
            </div>
          	<!-- Field - Department and Minor -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-6">
		            <select data-toggle="select" class="form-control select select-default" name="department" id="department" required>
		              <optgroup label="Department">
		              	@foreach ($static_departments as $static_department)
		                <option value="{{$static_department->deptartment_name}}">{{$static_department->deptartment_name}}</option>
						@endforeach		                
		              </optgroup>
		            </select>
		            @if(!$basic_info->department == "")
		            	<span style="font-size:14px;" >Department Saved : {{ $basic_info->department }}</span>
		            @else
		            	<span style="font-size:14px;" >Choose your Department</span>		            	
		            @endif
		    	</div>
		    	<div class="col-sm-12 col-md-6">
		            <select data-toggle="select" class="form-control select select-default" name="minor" id="minor" required>
		              <optgroup label="Minor">
		              	@foreach ($static_minors as $static_minor)
		                <option value="{{$static_minor->minor_name}}">{{$static_minor->minor_name}}</option>		                
						@endforeach		                
		              </optgroup>
		            </select>
		            @if(!$basic_info->minor == "")
		            	<span style="font-size:14px;">Minor Saved : {{ $basic_info->minor }}</span>
		            @else
		            	<span style="font-size:14px;" >Choose your Minor</span>		            			            
		            @endif	            
		    	</div>
	        </div>
          	<!-- Field - Degree Type -->
          	<div class="form-group">            
	          	<div class="col-sm-12 col-md-6"> 
	              <label class="radio" for="radio4a">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="B. Tech" id="radio4a" required checked>
	                 B. Tech
	              </label>
	              <label class="radio" for="radio4b">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="Dual Degree" id="radio4b" required>
	                 Dual Degree
	              </label>
	              <label class="radio" for="radio4c">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="MS" id="radio4c" required>
	                 MS
	              </label>
	              <label class="radio" for="radio4d">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="PhD" id="radio4d" required>
	                 PhD
	              </label>
	              <label class="radio" for="radio4e">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="M. Tech" id="radio4e" required>
	                 M. Tech
	              </label>
	              <label class="radio" for="radio4f">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="MA (HS)" id="radio4f" required>
	                 MA (HS)
	              </label>
	              <label class="radio" for="radio4g">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="MBA" id="radio4g" required>
	                 MBA
	              </label>
	              <label class="radio" for="radio4h">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="M.Sc" id="radio4h" required>
	                 M.Sc
	              </label>
	            </div>
            </div>            
            <!-- Field - Email -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-mail"></span></span>
		              <input type="text" class="form-control" name="email" placeholder="Email *" value="{{ $basic_info->email }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - Phone Current -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-list-small-thumbnails"></span></span>
		              <input type="text" class="form-control" name="phone" placeholder="Phone *" value="{{ $basic_info->phone }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - Phone Home -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-list-small-thumbnails"></span></span>
		              <input type="text" class="form-control" name="phonehome" placeholder="Phone ( Home )" value="{{ $basic_info->phonehome }}">
		            </div>
	            </div>
            </div>
            <!-- Field - Project Guide -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-user"></span></span>
		              <input type="text" class="form-control" name="projectguide" placeholder="Project Guide" value="{{ $basic_info->projectguide }}" >
		            </div>
	            </div>
            </div>
            <!-- Field - Graduating Year -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-6">
		            <select data-toggle="select" class="form-control select select-default" name="graduatingyear" id="graduatingyear" required>
		              <optgroup label="Graduating Year">
		              	<option value="2020">2020</option>
		                <option value="2019">2019</option>
		                <option value="2018">2018</option>
		                <option value="2017">2017</option>
		                <option value="2016">2016</option>
		                <option value="2015">2015</option>
		                <option value="2014">2014</option>
		                <option value="2013">2013</option>
		                <option value="2012">2012</option>
		                <option value="2011">2011</option>
		                <option value="2010">2010</option>
		                <option value="2009">2009</option>
		                <option value="2008">2008</option>
		                <option value="2007">2007</option>
		                <option value="2006">2006</option>
		                <option value="2005">2005</option>
		                <option value="2004">2004</option>
		                <option value="2003">2003</option>
		                <option value="2002">2002</option>
		                <option value="2001">2001</option>
		                <option value="2000">2000</option>
		              </optgroup>
		            </select>
		            @if(!$basic_info->graduatingyear == "")
		            	<span style="font-size:14px;">Graduating Year : {{ $basic_info->graduatingyear }}</span>
		            @else
		            	<span style="font-size:14px;" >Choose your Graduating Year</span>		            	
		            @endif
		    	</div>		    	
	        </div>
	        <!-- Field - Future Plans -->
          	<div class="form-group">
          	<label>Current Job / Current Internship Details :</label>
          		<div class="col-sm-12 col-md-12">
          			<label class="radio" for="radio4job">
		                <input type="radio" name="optionsRadiosFuture" data-toggle="radio" value="Job" id="radio4job" required>
		                 Company Details
		            </label>
		          	<div class="form-group">		            
			            <div class="col-sm-12 col-md-offset-1 col-md-4">
			                <input type="text" class="form-control" name="companyname" id="companyname" placeholder="Company's Name" readonly="" required>
			            </div>
			            <div class="col-sm-12 col-md-4">
			                <input type="text" class="form-control" name="companytitle" id="companytitle" placeholder="Job Title" readonly="" required>
			            </div>
			            <div class="col-sm-12 col-md-3">
			                <input type="text" class="form-control" name="companylocation" id="companylocation" placeholder="Location" readonly="" required>
			            </div>
			        </div>
		            <label class="radio" for="radio4higherstudies">
		                <input type="radio" name="optionsRadiosFuture" data-toggle="radio" value="Higher Studies" id="radio4higherstudies" required>
		                 University Details
		            </label>
		            <div class="form-group">		            
			            <div class="col-sm-12 col-md-offset-1 col-md-4">
			                <input type="text" class="form-control" name="universityname" id="universityname" placeholder="University Name" readonly="" required>
			            </div>
			            <div class="col-sm-12 col-md-4">
			                <input type="text" class="form-control" name="universitydepartment" id="universitydepartment" placeholder="University Department" readonly="" required>
			            </div>
			            <div class="col-sm-12 col-md-3">
			                <input type="text" class="form-control" name="universitylocation" id="universitylocation" placeholder="University Location" readonly="" required>
			            </div>
			        </div>
			        <label class="radio" for="radio4others">
		                <input type="radio" name="optionsRadiosFuture" data-toggle="radio" value="Others" id="radio4others" required>
		                 Others
		            </label>
		            <div class="form-group">		            
			            <div class="col-sm-12 col-md-offset-1 col-md-4">
			                <input type="text" class="form-control" name="futureothers" id="futureothers" placeholder="Other Plans" readonly="">
			            </div>			            
			        </div>
          		</div>
          	</div>
          	<!-- Field - Current City Google Maps API -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-location"></span></span>
		              <input type="text" class="form-control" id="current_city" name="current_city" placeholder="Enter you current city *" value="{{ $basic_info->current_city }}" required>
		            </div>
		            <p>Make sure to update this when travelling to a different city to get updates 
		            on the latest happenings and events by the Alumni chapter of that city.	</p>
	            </div>
            </div>
          	<hr>
            
          	<!-- Field - Submit -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-6">
          			<input class="btn btn-block btn-lg btn-primary" type="submit" value="Save">
          		</div>
          		<div class="col-sm-12 col-md-6">
			        <a class="btn btn-block btn-lg btn-danger" href="{{ URL::route('home') }}">Cancel</a>          			
          		</div>
          		{{ Form::token() }}
          	</div>
          </form>
        </div> 

@stop

@section('jsmainbodycontent')

	<script type="text/javascript">

		$(function(){
		    $("#radio4job, #radio4higherstudies, #radio4others").change(function(){
		        $("#companyname, #companytitle, #companylocation, #universityname, #universitydepartment, #universitylocation, #futureothers").val("").attr("readonly",true);
		        if($("#radio4job").is(":checked")){
		            $("#companyname").removeAttr("readonly");
		            $("#companytitle").removeAttr("readonly");		            		            
		            $("#companylocation").removeAttr("readonly");		            
		            $("#companyname").focus();
		        }
		        else if($("#radio4higherstudies").is(":checked")){
		            $("#universityname").removeAttr("readonly");
		            $("#universitydepartment").removeAttr("readonly");
		            $("#universitylocation").removeAttr("readonly");		            		            		            
		            $("#universityname").focus();
		        }
		        else if($("#radio4others").is(":checked")){
		            $("#futureothers").removeAttr("readonly");
		            $("#futureothers").focus();
		        }
		    });
		});



	</script>

	<script type="text/javascript">
		$(function(){
			//department = "{{ $basic_info->department }}";
			//alert($('#department').val());
			// Set the Department
			$('#department').val("{{ $basic_info->department }}");
			// Set the Minor
			$('#minor').val("{{ $basic_info->minor }}");
			// Set the Degree Type
			switch("{{ $basic_info->optionsRadiosDegree }}") {
			    case "B. Tech":
			        optionsRadiosDegree_id = "radio4a";
			        break;
			    case "Dual Degree":
			        optionsRadiosDegree_id = "radio4b";
			        break;
			    case "MS":
			        optionsRadiosDegree_id = "radio4c";
			        break;
			    case "PhD":
			        optionsRadiosDegree_id = "radio4d";
			        break;
			    case "M. Tech":
			        optionsRadiosDegree_id = "radio4e";
			        break;
			    case "MA (HS)":
			        optionsRadiosDegree_id = "radio4f";
			        break;
			    case "MBA":
			        optionsRadiosDegree_id = "radio4g";
			        break;
			    case "M.Sc":
			        optionsRadiosDegree_id = "radio4h";
			        break;    
			    default:
			        optionsRadiosDegree_id = "radio4a";
			        break;
			} 
			$("#" + optionsRadiosDegree_id).prop("checked", true);
			// Set Graduating Year
			$('#graduatingyear').val("{{ $basic_info->graduatingyear }}");
			// Set Future Plan
			switch("{{ $basic_info->optionsRadiosFuture }}") {
			    case "Job":
			        optionsRadiosFuture_id = "radio4job";			       
			        $('#companyname').val("{{ $basic_info->future_field1 }}");
			        $('#companytitle').val("{{ $basic_info->future_field2 }}");			        
			        $('#companylocation').val("{{ $basic_info->future_field3 }}");
			        break;
			    case "Higher Studies":
			        optionsRadiosFuture_id = "radio4higherstudies";
			        $('#universityname').val("{{ $basic_info->future_field1 }}");
			        $('#universitydepartment').val("{{ $basic_info->future_field2 }}");
			        $('#universitylocation').val("{{ $basic_info->future_field3 }}");			        
			        break;
			    case "Others":
			        optionsRadiosFuture_id = "radio4others";
			        futureothers = "{{ $basic_info->future_field1 }}";
			        $('#futureothers').val("{{ $basic_info->future_field1 }}");
			        break;
			    default:
			        optionsRadiosFuture_id = "radio4job";
			        $("#companyname").removeAttr("readonly");
		            $("#companytitle").removeAttr("readonly");			        
		            $("#companylocation").removeAttr("readonly");
			        break;
			} 
			$("#" + optionsRadiosFuture_id).prop("checked", true);


		});

	</script>
	<!-- Google Maps API -->
	<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
	<script type="text/javascript">
	   function initialize() {
	      
	      var options = {
		  types: ['(cities)']
		 };

		 var input = document.getElementById('current_city');
		 var autocomplete = new google.maps.places.Autocomplete(input, options);

	   }
	   google.maps.event.addDomListener(window, 'load', initialize);
	</script>

@stop