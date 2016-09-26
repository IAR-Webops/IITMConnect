@extends('layout.main')

@section('content')

	<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-1 col-md-10">
		          <h4 class="text-center">New Offer</h4>
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Your current Access Level to <a href="{{ URL::route('admin') }}">Admin Page</a> is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>

                        <form action="{{ URL::to('/') }}/admin/affinityprogram/{{ $affinityprogram_unique_id }}/offer/new" class="form-horizontal" role="form" method="post">
				          	<!-- Field - AP Name -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">Offer Name :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="name" placeholder="AP Name *" value="" required>
				              </div>
				            </div>

                            <!-- Field - AP Unique Name -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">affinityprogramId</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="affinityprogramId" placeholder="affinityprogramId *" value="{{ $affinityprogram_unique_id }}" readonly="">
				              </div>
				            </div>

                            <!-- Field - Image URL -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">Image URL</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="image" placeholder="Image URL *" value="" required>
				              </div>
				            </div>

                            <!-- Field - Short Details -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">Short Details</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <textarea type="text" class="form-control" name="short_details" placeholder="Short Details *" value="" required></textarea>
				              </div>
				            </div>

                            <!-- Field - Long Details -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">Long Details</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <textarea type="text" class="form-control" name="long_details" placeholder="Long Details *" value="" required></textarea>
                              </div>
				            </div>

                            <!-- Field - Status -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">Status</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="status" placeholder="open / close *" value="" required="">
				              </div>
				            </div>

                            <!-- Field - offer_code -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">offer_code</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="offer_code" placeholder="open / close *" value="" required="">
				              </div>
				            </div>

                            <!-- Field - offer_code_message -->
                            <div class="form-group">
                              <div class="col-sm-12 col-md-4 text-right">
                                <label class="text-right">offer_code_message</label>
                              </div>
                              <div class="col-sm-12 col-md-8">
                                <textarea type="text" class="form-control" name="offer_code_message" placeholder="offer_code_message *" value=""></textarea>
                              </div>
                            </div>

                            <hr>

                            <!-- Field - Submit -->
                            <div class="form-group">
                                <div class="col-sm-12 col-md-6">
                                    <input class="btn btn-block btn-lg btn-primary" type="submit" value="Save">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <a class="btn btn-block btn-lg btn-danger" href="{{ URL::route('admin-affinity-program') }}">Cancel</a>
                                </div>
                                {{ Form::token() }}
                            </div>

                        </form>

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


@stop
