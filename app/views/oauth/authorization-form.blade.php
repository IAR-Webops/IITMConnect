@extends('layout.main')

@section('content')

<div class="col-md-8 col-md-offset-2">

<form action="/oauth/authorize?client_id={{$params['client_id'];}}&redirect_uri={{$params['redirect_uri'];}}&response_type={{$params['response_type'];}}" 
    method="post" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <!-- foreach -->
    <input type="hidden" name="client_id" value="{{$params['client_id'];}}">
    <input type="hidden" name="redirect_uri" value="{{$params['redirect_uri'];}}">
    
    <div class="modal" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Login with IITMConnect</h4>
          </div>
          <div class="modal-body">
            <p>You will be sharing the following details :</p>
            <ul>
                <li>Name</li>
                <li>Roll Number</li>
                <li>Email</li>
            </ul>
          </div>
          <div class="modal-footer">
          <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-lg btn-danger btn-block" name="deny" value="1">Deny</button>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-lg btn-success btn-block" name="approve" value="1">Approve</button>
            </div>
          </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="col-md-6 col-md-offset-3">
        <h5>Login with IITMConnect</h5>
        <hr>
        <p>You will be sharing the following details :</p>
        <ul>
            <li>Name</li>
            <li>Roll Number</li>
            <li>Email</li>
        </ul>
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-lg btn-danger btn-block" name="deny" value="1">Deny</button>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-lg btn-success btn-block" name="approve" value="1">Approve</button>
            </div>
        </div>
    </div>
    </form>	

</div>

@stop

@section('jscontent')

<script type="text/javascript">
    $('#myModal').modal({
      show: true
    })
</script>

@stop