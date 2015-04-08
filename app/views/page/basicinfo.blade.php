@extends('page.home')

@section('mainbodycontent')
	
		<div class="col-sm-12 col-md-11">
          <h4>Basic Information</h4>
          <hr>
          <form class="form-horizontal" role="form" method="POST">
          	<!-- Field - Name -->
            <div class="form-group">
              <div class="col-sm-12 col-md-4">
                <input type="text" class="form-control" id="firstname" placeholder="First Name *">
              </div>
              <div class="col-sm-12 col-md-4">
                <input type="text" class="form-control" id="middlename" placeholder="Middle Name">
              </div>
              <div class="col-sm-12 col-md-4">
                <input type="text" class="form-control" id="lastname" placeholder="Last Name *">
              </div>
            </div>
          	<!-- Field - Roll Number -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-credit-card"></span></span>
		              <input type="text" class="form-control" placeholder="Roll Number">
		            </div>
	            </div>
            </div>
          	<!-- Field - Department and Minor -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-6">
		            <select data-toggle="select" class="form-control select select-default">
		              <optgroup label="Department">
		                <option value="0">Aerospace</option>
		                <option value="1">Applied Mechanics</option>
		                <option value="1">Biotechnology</option>
		                <option value="1">Chemical</option>
		                <option value="1">Computer Science</option>
		                <option value="1">Engineering Design</option>
		              </optgroup>
		            </select>
		    	</div>
		    	<div class="col-sm-12 col-md-6">
		            <select data-toggle="select" class="form-control select select-default">
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
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="" id="radio4a" required checked>
	                 B. Tech
	              </label>
	              <label class="radio" for="radio4b">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="" id="radio4b" required>
	                 Dual Degree
	              </label>
	              <label class="radio" for="radio4c">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="" id="radio4c" required>
	                 MS
	              </label>
	              <label class="radio" for="radio4d">
	                <input type="radio" name="optionsRadiosDegree" data-toggle="radio" value="" id="radio4d" required>
	                 PhD
	              </label>
	            </div>
            </div>
            <!-- Field - Project Guide -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-user"></span></span>
		              <input type="text" class="form-control" id="projectguide" placeholder="Project Guide">
		            </div>
	            </div>
            </div>
            <!-- Field - Email -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-mail"></span></span>
		              <input type="text" class="form-control" id="email" placeholder="Email">
		            </div>
	            </div>
            </div>
            <!-- Field - Phone -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-list-small-thumbnails"></span></span>
		              <input type="text" class="form-control" id="phone" placeholder="Phone">
		            </div>
	            </div>
            </div>
            <!-- Field - Graduating Year -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-6">
		            <select data-toggle="select" class="form-control select select-default">
		              <optgroup label="Graduating Year">
		                <option value="0">2015</option>
		                <option value="1">2014</option>
		                <option value="1">2013</option>
		                <option value="1">2012</option>
		                <option value="1">2011</option>		                
		              </optgroup>
		            </select>
		    	</div>		    	
	        </div>
	        <!-- Field - Future Plans -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-12">
          			<label class="radio" for="radio4job">
		                <input type="radio" name="optionsRadiosFuture" data-toggle="radio" value="" id="radio4job" required>
		                 Job
		            </label>
		          	<div class="form-group">		            
			            <div class="col-sm-12 col-md-offset-1 col-md-4">
			                <input type="text" class="form-control" id="companyname" placeholder="Company's Name" readonly="">
			            </div>
			            <div class="col-sm-12 col-md-4">
			                <input type="text" class="form-control" id="companylocation" placeholder="Location" readonly="">
			            </div>
			        </div>
		            <label class="radio" for="radio4higherstudies">
		                <input type="radio" name="optionsRadiosFuture" data-toggle="radio" value="" id="radio4higherstudies" required>
		                 Higher Studies
		            </label>
		            <div class="form-group">		            
			            <div class="col-sm-12 col-md-offset-1 col-md-4">
			                <input type="text" class="form-control" id="universityname" placeholder="University Name" readonly="">
			            </div>
			            <div class="col-sm-12 col-md-4">
			                <input type="text" class="form-control" id="universitydepartment" placeholder="Department" readonly="">
			            </div>
			        </div>
			        <label class="radio" for="radio4others">
		                <input type="radio" name="optionsRadiosFuture" data-toggle="radio" value="" id="radio4others" required>
		                 Others
		            </label>
		            <div class="form-group">		            
			            <div class="col-sm-12 col-md-offset-1 col-md-4">
			                <input type="text" class="form-control" id="futureothers" placeholder="Other Plans" readonly="">
			            </div>			            
			        </div>
          		</div>
          	</div>
          	<!-- Field - Future Plans -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-6">
          			<input class="btn btn-block btn-lg btn-primary" type="submit" value="Save">
          		</div>
          		<div class="col-sm-12 col-md-6">
			        <a class="btn btn-block btn-lg btn-danger" href="{{ URL::route('home') }}">Cancel</a>          			
          		</div>
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

@stop