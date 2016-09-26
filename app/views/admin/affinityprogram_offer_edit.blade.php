@extends('layout.main')

@section('content')

	<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-offset-1 col-md-10">
		          <h4 class="text-center">Edit for {{$affinity_program_offer->name}}</h4>
		          <hr>
					@if($admin_user_check == "True")
						<p>
						Your current Access Level to <a href="{{ URL::route('admin') }}">Admin Page</a> is : <strong>{{ $admin_user->user_level }}</strong> <br>
						</p>

                        <form action="{{ URL::to('/') }}/admin/affinityprogram/{{ $affinity_program_offer->affinityprogramId }}/{{$affinity_program_offer->id}}/edit" class="form-horizontal" role="form" method="post">
				          	<!-- Field - AP Name -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">Offer Name :</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="name" placeholder="AP Name *" value="{{$affinity_program_offer->name}}" required>
				              </div>
				            </div>

                            <!-- Field - AP Unique Name -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">affinityprogramId</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="affinityprogramId" placeholder="affinityprogramId *" value="{{$affinity_program_offer->affinityprogramId}}" readonly="">
				              </div>
				            </div>

                            <!-- Field - Image URL -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">Image URL</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="image" placeholder="Image URL *" value="{{$affinity_program_offer->image}}" required>
				              </div>
				            </div>

                            <!-- Field - Short Details -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">Short Details</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <textarea type="text" class="form-control" name="short_details" placeholder="Short Details *" value="" required>{{$affinity_program_offer->short_details}}</textarea>
				              </div>
				            </div>

                            <!-- Field - Long Details -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">Long Details</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <textarea type="text" class="form-control" name="long_details" placeholder="Long Details *" value="" required>{{$affinity_program_offer->long_details}}</textarea>
                              </div>
				            </div>

                            <!-- Field - Status -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">Status</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="status" placeholder="open / close *" value="{{$affinity_program_offer->status}}" required="">
				              </div>
				            </div>

                            <!-- Field - offer_code -->
				            <div class="form-group">
				              <div class="col-sm-12 col-md-4 text-right">
				            	<label class="text-right">offer_code</label>
				              </div>
				              <div class="col-sm-12 col-md-8">
				                <input type="text" class="form-control" name="offer_code" placeholder="open / close *" value="{{$affinity_program_offer->offer_code}}" required="">
				              </div>
				            </div>

                            <!-- Field - offer_code_message -->
                            <div class="form-group">
                              <div class="col-sm-12 col-md-4 text-right">
                                <label class="text-right">offer_code_message</label>
                              </div>
                              <div class="col-sm-12 col-md-8">
                                <textarea type="text" class="form-control" name="offer_code_message" placeholder="offer_code_message *" value="">{{$affinity_program_offer->offer_code_message}}</textarea>
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

						<div class="col-sm-12">
				          <h4 class="text-center">Danger Zone</h4>
				          <hr>
							<p class="text-center">
								Click the button below to delete this Offer permanently.<br>
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
							<form action="{{ URL::to('/') }}/admin/affinityprogram/{{ $affinity_program_offer->affinityprogramId }}/{{$affinity_program_offer->id}}/delete" class="form-horizontal" role="form" method="post">

						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Delete Offer</h4>
						      </div>
						      <div class="modal-body">
						      	<div class="container-fluid">

						          	<!-- Field - Name -->
						            <div class="form-group">
						        	Are you sure you want to delete the Offer permanently?
									<input type="text" class="form-control" id="name" name="name" placeholder="Offer Name" value="{{$affinity_program_offer->name}}" style="display:none">
									<input type="text" class="form-control" id="offer_id" name="offer_id" placeholder="Offer ID" value="{{$affinity_program_offer->id}}" style="display:none">
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


@stop
