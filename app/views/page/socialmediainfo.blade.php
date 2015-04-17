@extends('page.home')

@section('mainbodycontent')
	
		<div class="col-sm-12 col-md-11">
          <h4>Social Media Information</h4>        	
          <hr>
          <form action="{{ URL::route('socialmedia-info-post') }}" class="form-horizontal" role="form" method="post">
          	<!-- Field - Google Plus Profile Link -->            
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-google-plus"></span></span>
		              <input type="text" class="form-control" name="googleplusprofilelink" placeholder="Google Plus Profile Link" value="{{ $socialmedia_info->googleplusprofilelink }}" >
		            </div>
	            </div>
            </div>
            <!-- Field - Linkedin Profile Link -->  
            <div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-linkedin"></span></span>
		              <input type="text" class="form-control" name="linkedinprofilelink" placeholder="Linkedin Profile Link" value="{{ $socialmedia_info->linkedinprofilelink }}" >
		            </div>
	            </div>
            </div>
            <!-- Field - Facebook Profile Link -->  
          	<div class="form-group">
            	<div class="col-sm-12 col-md-8">
              		<div class="input-group">
		              <span class="input-group-addon"><span class="fui-facebook"></span></span>
		              <input type="text" class="form-control" name="facebookprofilelink" placeholder="Facebook Profile Link" value="{{ $socialmedia_info->facebookprofilelink }}" >
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