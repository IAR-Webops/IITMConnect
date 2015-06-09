      <nav class="navbar navbar-inverse navbar-static-top " role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-7">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <a class="navbar-brand" href="{{ URL::route('home') }}">#iitmconnect</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-7">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ URL::route('home') }}"><span class="fui-home"></span> | Home</a></li>            
            <!--
            <li><a href="#"><span class="fui-mail"></span> | Messages<span class="navbar-unread">1</span></a></li>
            -->
            <li><a href="{{ URL::route('events') }}"><span class="fui-calendar-solid"></span> | Events<span class="navbar-unread">1</span></a></li>
            <li><a href="{{ URL::route('about-us') }}">About Us</a></li>
           </ul>
           <div class="col-sm-12 col-md-4">
          <form class="navbar-form navbar-left" action="#" role="search">
            <div class="form-group">
              <div class="input-group" id="remote">
                <input class="form-control typeahead" id="navbarInput-01" type="search" placeholder="Search Users">
                <span class="input-group-btn">
                  <button type="submit" class="btn"><span class="fui-search"></span></button>
                </span>
              </div>
            </div>
          </form>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle text-uppercase" data-toggle="dropdown"><span class="fui-user"></span> | {{ Auth::user()->rollno }} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="fui-eye"></span> | View Profile</a></li>
                <li class="divider"></li>
                <li><a href="{{ URL::route('account-sign-out') }}"><span class="fui-lock"></span> | Sign Out</a></li>
              </ul>
            </li>
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="visible-sm visible-xs">Settings<span class="fui-gear"></span></span>
                <span class="visible-md visible-lg"><span class="fui-gear"></span></span>                
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ URL::route('oauth-settings') }}"><span class="fui-google-plus"></span> | 
                                <span class="fui-linkedin"></span> | 
                                <span class="fui-facebook"></span> | 
                                Oauth Settings </a></li>
                <li class="divider"></li>
                <li><a href="{{ URL::route('privacy-policy') }}"><span class="glyphicon glyphicon-briefcase"></span> | Privacy Policy</a></li>                                
                <li><a href="{{ URL::route('report-issues') }}"><span class="glyphicon glyphicon-exclamation-sign"></span> | Report Issues</a></li>                
              </ul>
            </li>           
            <li><a href="#"></a></li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
