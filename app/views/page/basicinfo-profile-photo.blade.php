@extends('page.home')

@section('mainbodycontent')

		<div class="col-sm-12 col-md-11">
          <h4>Profile Photo</h4>
          <hr>
          <!-- Profile Photo  -->
          @if(empty($basic_info->profile_image))
          <img style="max-height:250px; max-width:250px" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
          @else
          <img style="max-height:250px; max-width:250px" src="{{ $basic_info->profile_image }}">
          @endif

          <br>
          <br>
          <h6>Upload New Photo</h6>
          <p>Choose an Image and the Upload will begin Automatically.</p>
          <input class="btn btn-inverse btn-block" type="file" value="upload" id="fileButton" placeholder="Upload New Photo" />
          <progress value="0" max="100" class="btn-block" id="uploader">0%</progress>

          <form action="{{ URL::route('basic-info-profile-photo-post') }}" id="form_profile_photo" class="form-horizontal" role="form" method="post">
              <!-- Field - Name -->
            <input type="hidden" name="image_url" id="image_url">

            {{ Form::token() }}
          </form>

@stop

@section('jsmainbodycontent')
<script>

    var rollno = "{{ Auth::user()->rollno }}";

    // Get Elements
    var uploader = document.getElementById('uploader');
    var fileButton = document.getElementById('fileButton');

    // Listen for File Selection
    fileButton.addEventListener('change', function(e) {
        // Get file
        var file = e.target.files[0];

        // Create a Storage reference
        // var storageRef = firebase.storage.ref();

        var imageRef = storageRef.child('profilePhotos/' + rollno);

        // Upload file
        var task = imageRef.put(file);

        // Update Bar progress
        task.on('state_changed',

            function progress(snapshot) {
                // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                var percentage = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                console.log('Upload is ' + percentage + '% done');
                uploader.value = percentage;
            },

            function error(err) {
                console.log("Error : " + err);
            },

            function complete() {
                // Upload completed successfully, now we can get the download URL
                var downloadURL = task.snapshot.downloadURL;
                console.log("downloadURL : " + downloadURL);
                var image_url = document.getElementById('image_url');
                image_url.value = downloadURL;

                document.getElementById("form_profile_photo").submit();
            }
        )

    });

</script>
@stop
