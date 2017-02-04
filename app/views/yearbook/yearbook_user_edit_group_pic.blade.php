@extends('page.home-without-leftnav')

@section('mainbodycontent')

		<div class="col-sm-12 col-md-11">
          <h4>Group Photo {{ $group_pic_id }}</h4>
          <hr>
          @if($group_pic_id == 1)
              @if(empty($user_yearbook->group_pic_1))
              <img style="max-height:250px; max-width:250px" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
              @else
              <img style="max-height:250px; max-width:250px" src="{{ $user_yearbook->group_pic_1 }}">
              @endif
          @elseif($group_pic_id == 2)
              @if(empty($user_yearbook->group_pic_2))
              <img style="max-height:250px; max-width:250px" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
              @else
              <img style="max-height:250px; max-width:250px" src="{{ $user_yearbook->group_pic_2 }}">
              @endif
          @elseif($group_pic_id == 3)
              @if(empty($user_yearbook->group_pic_3))
              <img style="max-height:250px; max-width:250px" src="http://1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png">
              @else
              <img style="max-height:250px; max-width:250px" src="{{ $user_yearbook->group_pic_3 }}">
              @endif
          @endif

          <br>
          <br>
          <h6>Upload New Photo</h6>
          <p>Choose an Image and the Upload will begin Automatically.</p>
          <input class="btn btn-inverse btn-block" type="file" value="upload" id="fileButton" placeholder="Upload New Photo" />
          <progress value="0" max="100" class="btn-block" id="uploader">0%</progress>

          <form action="{{ URL::route('yearbook-home') }}/{{ Auth::user()->rollno }}/edit-group-photo/{{ $group_pic_id }}" id="form_group_photo" class="form-horizontal" role="form" method="post">
              <!-- Field - Name -->
            <input type="hidden" name="image_url" id="image_url">

            {{ Form::token() }}
          </form>

@stop

@section('jsmainbodycontent')
<script>

    var rollno = "{{ Auth::user()->rollno }}";
    var group_pic_id = "{{ $group_pic_id }}"

    // Get Elements
    var uploader = document.getElementById('uploader');
    var fileButton = document.getElementById('fileButton');

    // Listen for File Selection
    fileButton.addEventListener('change', function(e) {
        // Get file
        var file = e.target.files[0];

        // Create a Storage reference
        // var storageRef = firebase.storage.ref();

        var imageRef = storageRef.child('yearbookGroupPhotos/' + rollno + "_" + group_pic_id);

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

                document.getElementById("form_group_photo").submit();
            }
        )

    });

</script>
@stop
