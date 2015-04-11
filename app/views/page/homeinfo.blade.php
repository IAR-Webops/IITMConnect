@extends('page.home')

@section('mainbodycontent')
	
	<div class="col-sm-12 col-md-11">
          <h4>Home Information</h4>        	
          <hr>
          <form action="{{ URL::route('home-info-post') }}" class="form-horizontal" role="form" method="post">
          	<!-- Field - Parent's Name -->
            <div class="form-group">
              <div class="col-sm-12 col-md-6">
                <input type="text" class="form-control" name="fathersname" placeholder="Father's Name *" value="{{ $home_info->fathersname }}" required>
              </div>
              <div class="col-sm-12 col-md-6">
                <input type="text" class="form-control" name="mothersname" placeholder="Mother's Name *" value="{{ $home_info->mothersname }}">
              </div>             
            </div>
            <!-- START - Permanent Fields -->
          	<!-- Field - Permanent Address -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
            	<p>Permanent Address :</p>
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-home"></span></span>
		              <input type="text" class="form-control" name="permaddline1" placeholder="Address Line 1 *" value="{{ $home_info->permaddline1 }}" required>
		            </div>
	            </div>
            </div>
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-home"></span></span>
		              <input type="text" class="form-control" name="permaddline2" placeholder="Address Line 2" value="{{ $home_info->permaddline2 }}">
		            </div>
	            </div>
            </div>
          	
          	
            <!-- Field - City -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-location"></span></span>
		              <input type="text" class="form-control" name="permcity" placeholder="City *" value="{{ $home_info->permcity }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - State / Province -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-location"></span></span>
		              <input type="text" class="form-control" name="permstate" placeholder="State / Province *" value="{{ $home_info->permstate }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - Pin Code -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-credit-card"></span></span>
		              <input type="text" class="form-control" name="permpincode" placeholder="Pin Code *" value="{{ $home_info->permpincode }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - Country -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-location"></span></span>
		              <input type="text" class="form-control" name="permcountry" placeholder="Country *" value="{{ $home_info->permcountry }}" required>
		            </div>
	            </div>
            </div>
            
	        <!-- Field - Phone Landline -->
          	<div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-list-small-thumbnails"></span></span>
		              <input type="text" class="form-control" name="permphonelandline" placeholder="Phone ( Land Line )" value="{{ $home_info->permphonelandline }}">
		            </div>
	            </div>
            </div>
            <!-- Field - Phone Landline -->
          	<div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-list-small-thumbnails"></span></span>
		              <input type="text" class="form-control" name="permphonemobile" placeholder="Phone ( Mobile )" value="{{ $home_info->permphonemobile }}">
		            </div>
	            </div>
            </div>
            <!-- END - Permanent Fields -->
            <hr>
            <!-- Mail Fields -->
          	<!-- Field - Mail Address -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
            	<p>Mail Address :</p>
            	<label class="checkbox checkbox-inline" for="checkboxmailadd">
                	<input type="checkbox" data-toggle="checkbox" value="True" id="checkboxmailadd" name="checkboxmailadd"> 
                	Use same as Permanent Address
              	</label>
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-home"></span></span>
		              <input type="text" class="form-control" name="mailaddline1" id="mailaddline1" placeholder="Address Line 1 *" value="{{ $home_info->mailaddline1 }}" required>
		            </div>
	            </div>
            </div>
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-home"></span></span>
		              <input type="text" class="form-control" name="mailaddline2" id="mailaddline2" placeholder="Address Line 2" value="{{ $home_info->mailaddline2 }}">
		            </div>
	            </div>
            </div>
          	
          	
            <!-- Field - City -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-location"></span></span>
		              <input type="text" class="form-control" name="mailcity" id="mailcity" placeholder="City *" value="{{ $home_info->mailcity }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - State / Province -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-location"></span></span>
		              <input type="text" class="form-control" name="mailstate" id="mailstate" placeholder="State / Province *" value="{{ $home_info->mailstate }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - Pin Code -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-credit-card"></span></span>
		              <input type="text" class="form-control" name="mailpincode" id="mailpincode" placeholder="Pin Code *" value="{{ $home_info->mailpincode }}" required>
		            </div>
	            </div>
            </div>
            <!-- Field - Country -->
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-location"></span></span>
		              <input type="text" class="form-control" name="mailcountry" id="mailcountry" placeholder="Country *" value="{{ $home_info->mailcountry }}" required>
		            </div>
	            </div>
            </div>
            
	        <!-- Field - Phone Landline -->
          	<div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-list-small-thumbnails"></span></span>
		              <input type="text" class="form-control" name="mailphonelandline" id="mailphonelandline" placeholder="Phone ( Land Line )" value="{{ $home_info->mailphonelandline }}">
		            </div>
	            </div>
            </div>
            <!-- Field - Phone Landline -->
          	<div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-list-small-thumbnails"></span></span>
		              <input type="text" class="form-control" name="mailphonemobile" id="mailphonemobile" placeholder="Phone ( Mobile )" value="{{ $home_info->mailphonemobile }}">
		            </div>
	            </div>
            </div>
            <!-- END - Mail Fields -->
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

		$(document).ready(function(){

			checkboxmailadd = "{{ $home_info->checkboxmailadd }}";
			if (checkboxmailadd == "True") {
				$('#checkboxmailadd').prop('checked', true);
	    		$("#mailaddline1, #mailaddline2, #mailcity, #mailstate, #mailpincode, #mailcountry ,#mailphonelandline ,#mailphonemobile").val("").attr("readonly",true);
			};

	        $('#checkboxmailadd').click(function(){
	            if($(this).is(":checked")){
		    		$("#mailaddline1, #mailaddline2, #mailcity, #mailstate, #mailpincode, #mailcountry ,#mailphonelandline ,#mailphonemobile").val("").attr("readonly",true);
	            } else if($(this).is(":not(:checked)")){
	                //alert("Checkbox is unchecked.");
		    		$("#mailaddline1, #mailaddline2, #mailcity, #mailstate, #mailpincode, #mailcountry ,#mailphonelandline ,#mailphonemobile").removeAttr("readonly");
	            }
	        });

	    });

	</script>

@stop