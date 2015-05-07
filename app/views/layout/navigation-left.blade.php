        <div class="col-sm-12 col-md-4 col-lg-3"><!-- START - Navigation Left -->

          <div class="col-sm-12">
              <div class="todo">
                <ul>
                  <a href="{{ URL::route('basic-info') }}" style="color:#798795;">
                    <li id="basicinfoli">
                      <div class="todo-icon fui-user"></div>
                      <div class="todo-content">
                        <h4 class="todo-name">
                          Basic Information
                        </h4>
                        Stuff like Name, Phone, etc
                      </div>
                    </li>
                  </a>
                  <a href="{{ URL::route('home-info') }}" style="color:#798795;">
                    <li id="homeinfoli">
                      <div class="todo-icon fui-home"></div>
                      <div class="todo-content">
                        <h4 class="todo-name">
                          Home Information
                        </h4>
                        Something that's permanent
                      </div>
                    </li>
                  </a>
                  <a href="{{ URL::route('instilife-info') }}" style="color:#798795;">                 
                    <li id="intilifeinfoli">
                      <div class="todo-icon fui-bookmark"></div>
                      <div class="todo-content">
                        <h4 class="todo-name">
                          Insti Life
                        </h4>
                        Coreship, Coordship, etc
                      </div>
                    </li>
                  </a>
                  <a href="{{ URL::route('socialmedia-info') }}" style="color:#798795;">                 
                    <li id="socialmediainfoli">
                      <div class="todo-icon fui-twitter"></div>
                      <div class="todo-content">
                        <h4 class="todo-name">
                          Social Media
                        </h4>
                        Tell us where to follow you
                      </div>
                    </li>
                  </a>
                </ul>
              </div><!-- /.todo -->
              <!-- START - Linkedin Join Group -->
              <a href="https://www.linkedin.com/groups/IIT-Madras-Alumni-1747/about" target="_alt">
                <img src="{{ URL::asset('img/linkedin_join_group.png') }}" style="margin:0 10px 10px 0;">
              </a>
              <!-- END - Linkedin Join Group -->
              <!-- START - Facebook Page Plugin -->
              <!--
              <div class="fb-page" data-href="https://www.facebook.com/iar.iitmadras/" data-width="250" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                <div class="fb-xfbml-parse-ignore">
                <blockquote cite="https://www.facebook.com/iar.iitmadras/">
                <a href="https://www.facebook.com/iar.iitmadras/">International and Alumni Relations, IIT Madras</a>
                </blockquote>
                </div>
              </div>
              -->
              <div class="fb-like" data-href="https://www.facebook.com/iar.iitmadras/" data-width="250" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
              <!-- END - Facebook Page Plugin -->              
          </div>

        </div><!-- END - Navigation Left -->

@section('jsleftnavcontent')
  <script type="text/javascript">
    if ("{{ $info_check['basic'] }}" == "True") {
      $('#basicinfoli').addClass('todo-done');
    };
    if ("{{ $info_check['home'] }}" == "True") {
      $('#homeinfoli').addClass('todo-done');
    };
    if ("{{ $info_check['instilife'] }}" == "True") {
      $('#intilifeinfoli').addClass('todo-done');
    };
    if ("{{ $info_check['socialmedia'] }}" == "True") {
      $('#socialmediainfoli').addClass('todo-done');
    };    

  </script>
@stop