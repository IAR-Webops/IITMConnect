@extends('page.home-without-leftnav')

@section('mainbodycontent')

		<div class="col-sm-12 col-md-11">
          <h4>Yearbook Information Edit</h4>
          <hr>
		  <p>
			  Personal Email : <strong>{{ $basic_info->email }}</strong> <a href="{{ URL::route('basic-info') }}" class="btn btn-sm btn-warning">Edit</a> <br>
			  Graduating Year : <strong>{{ $basic_info->graduatingyear }}</strong> <a href="{{ URL::route('basic-info') }}" class="btn btn-sm btn-warning">Edit</a>
		  </p>
          <form action="{{ url('/') }}/yearbook/{{ $rollno }}/edit-insti-story" class="form-horizontal" role="form" method="post">
            <div class="form-group">
            	<div class="col-sm-12 col-md-12">
                    <label>Insti Story</label>
                        <textarea class="form-control" name="insti_story" placeholder="Your Story here" rows="10">{{ $user_yearbook->insti_story }}</textarea>
	            </div>
            </div>

			<input type="hidden" class="form-control" name="grad_year" value="{{ $basic_info->graduatingyear }}" required="">

            <hr>
          	<!-- Field - Submit -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-6">
          			<input class="btn btn-block btn-lg btn-primary" type="submit" value="Save">
          		</div>
          		<div class="col-sm-12 col-md-6">
			        <a class="btn btn-block btn-lg btn-danger" href="{{ URL::route('yearbook-home') }}">Cancel</a>
          		</div>
          		{{ Form::token() }}
          	</div>
          </form>
        </div>

@stop
