@extends('page.home-without-leftnav')

@section('mainbodycontent')

		<div class="col-sm-12 col-md-11">
          <h4>Yearbook Information Edit</h4>
          <hr>
		  <p>
			  Personal Email : <a href="#" class="">Edit</a> <br>
			  Graduating Year : <a href="#" class="">Edit</a>
		  </p>
          <form action="{{ url('/') }}" class="form-horizontal" role="form" method="post">
            <div class="form-group">
            	<div class="col-sm-12 col-md-12">
                    <label>I'll always remember Insti for ...</label>
                        <textarea class="form-control" name="remember_insti_for" placeholder="Your message here"></textarea>
	            </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12 col-md-12">
                    <label>Insti Nickname</label>
                      <input type="text" class="form-control" name="insti_name" placeholder="Insti Name" value="">
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
