<form action="/oauth/authorize?client_id={{$params['client_id'];}}&redirect_uri={{$params['redirect_uri'];}}&response_type={{$params['response_type'];}}" 
    method="post" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <!-- foreach -->
    <input type="hidden" name="client_id" value="{{$params['client_id'];}}">
    <input type="hidden" name="redirect_uri" value="{{$params['redirect_uri'];}}">
    <input type="text" name="redirect_uri">
    <input type="password" name="password">
    <button type="submit" name="approve" value="1">Approve</button>
	<button type="submit" name="deny" value="1">Deny</button>
</form>