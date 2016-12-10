@extends('page.home-without-leftnav')

@section('mainbodycontent')

		<div class="col-sm-12 col-md-11">
          <h4>Yearbook Home</h4>
          <hr>
		  <p>
			  Graduating Year : <strong>{{ $basic_info->graduatingyear }}</strong> <a href="{{ URL::route('basic-info') }}" class="btn btn-sm btn-warning">Edit</a>
		  </p>
          <p>
              Would you like to order the Yearbook?
          </p>

        </div>

@stop
