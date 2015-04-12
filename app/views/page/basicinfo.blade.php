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
		    	</div>
		    	<div class="col-sm-12 col-md-6">
		            <select data-toggle="select" class="form-control select select-default" name="minor" id="minor" required>
		              <optgroup label="Minor">
		                <option value="0">Social Entrepreneurship</option>
		                <option value="1">Applied Mechanics</option>
		                <option value="1">Biotechnology</option>
		                <option value="1">Chemical</option>
		                <option value="1">Computer Science</option>
		                <option value="1">Engineering Design</option>
		              </optgroup>
		            </select>
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
	            </div>
            </div>
            <!-- Field - Project Guide -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-user"></span></span>
		              <input type="text" class="form-control" name="projectguide" placeholder="Project Guide" value="{{ $basic_info->projectguide }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - Email -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-mail"></span></span>
		              <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $basic_info->email }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - Phone -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-list-small-thumbnails"></span></span>
		              <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ $basic_info->phone }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - Graduating Year -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-6">
		            <select data-toggle="select" class="form-control select select-default" name="graduatingyear" id="graduatingyear" required>
		              <optgroup label="Graduating Year">
		                <option value="2015">2015</option>
		                <option value="2014">2014</option>
		                <option value="2013">2013</option>
		                <option value="2012">2012</option>
		                <option value="2011">2011</option>		                
		              </optgroup>
		            </select>
		    	</div>		    	
	        </div>
	        <!-- Field - Future Plans -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-12">
          			<label class="radio" for="radio4job">
		                <input type="radio" name="optionsRadiosFuture" data-toggle="radio" value="Job" id="radio4job" required>
		                 Job
		            </label>
		          	<div class="form-group">		            
			            <div class="col-sm-12 col-md-offset-1 col-md-4">
			                <input type="text" class="form-control" name="companyname" id="companyname" placeholder="Company's Name" readonly="">
			            </div>
			            <div class="col-sm-12 col-md-4">
			                <input type="text" class="form-control" name="companylocation" id="companylocation" placeholder="Location" readonly="">
			            </div>
			        </div>
		            <label class="radio" for="radio4higherstudies">
		                <input type="radio" name="optionsRadiosFuture" data-toggle="radio" value="Higher Studies" id="radio4higherstudies" required>
		                 Higher Studies
		            </label>
		            <div class="form-group">		            
			            <div class="col-sm-12 col-md-offset-1 col-md-4">
			                <input type="text" class="form-control" name="universityname" id="universityname" placeholder="University Name" readonly="">
			            </div>
			            <div class="col-sm-12 col-md-4">
			                <input type="text" class="form-control" name="universitydepartment" id="universitydepartment" placeholder="Department" readonly="">
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
		        $("#companyname, #companylocation, #universityname, #universitydepartment, #futureothers").val("").attr("readonly",true);
		        if($("#radio4job").is(":checked")){
		            $("#companyname").removeAttr("readonly");
		            $("#companylocation").removeAttr("readonly");		            
		            $("#companyname").focus();
		        }
		        else if($("#radio4higherstudies").is(":checked")){
		            $("#universityname").removeAttr("readonly");
		            $("#universitydepartment").removeAttr("readonly");		            
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
			        $('#companylocation').val("{{ $basic_info->future_field2 }}");
			        break;
			    case "Higher Studies ":
			        optionsRadiosFuture_id = "radio4higherstudies";
			        $('#universityname').val("{{ $basic_info->future_field1 }}");
			        $('#universitydepartment').val("{{ $basic_info->future_field2 }}");
			        break;
			    case "Others":
			        optionsRadiosFuture_id = "radio4others";
			        futureothers = "{{ $basic_info->future_field1 }}";
			        $('#futureothers').val("{{ $basic_info->future_field1 }}");
			        break;
			    default:
			        optionsRadiosFuture_id = "radio4job";
			        break;
			} 
			$("#" + optionsRadiosFuture_id).prop("checked", true);


		});

	</script>

@stop