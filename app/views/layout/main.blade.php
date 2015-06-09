<!DOCTYPE html>
<html lang="en">
    <head>        
    	 <!-- META SECTION -->
        <title>#iitmconnect</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="UTF-8">
        <meta name="description" content="IIT Madras Alumni Connect">
        <meta name="keywords" content="IIT,Madras,Alumni,Connect">
        <meta name="author" content="Yash Murty">
        <meta name="_token" content="{{ csrf_token() }}" />

        <link rel="icon" href="{{ URL::asset('img/IIT_Madras_Logo_30.png') }}" type="image/x-icon" />
        <!-- END META SECTION -->
        {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'); }}             
        <!-- CSS INCLUDE -->  
        <!-- Loading Bootstrap -->

        <!-- Loading Flat UI -->
        {{ HTML::style('css/flat-ui.min.css'); }}     

        <!-- Loading Font Awesome and Social Bootstrap -->
        {{ HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'); }}             
        {{ HTML::style('css/bootstrap-social.css'); }}     

        <!-- EOF CSS INCLUDE -->      

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          {{ HTML::script('js/vendor/html5shiv.js'); }}
          {{ HTML::script('js/vendor/respond.min.js'); }} 
        <![endif]-->                               
    </head>                                        
	<body>
        @include('layout.js.sdkanalytics')
		
        @if(Auth::check())

            @include('layout.navigation-top')
		
        @endif

			@yield('content')

		@if(Auth::check())

            @include('layout.navigation-bottom')
        
        @endif
		
        
       



    <!-- START SCRIPTS -->

        <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
        {{ HTML::script('js/vendor/jquery.min.js'); }}        
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        {{ HTML::script('js/vendor/video.js'); }}
        {{ HTML::script('js/flat-ui.min.js'); }} 
        {{ HTML::script('js/application.js'); }} 
        {{ HTML::script('js/notify.min.js'); }} 
        <!-- Search Box -->
        <script src="{{ URL::asset('js/typeahead.bundle.js') }}"></script>        
        <script src="{{ URL::asset('js/handlebars-v3.0.3.js') }}"></script>


        @yield('jsmainbodycontent')
        @yield('jsleftnavcontent')
        @yield('jscontent')

        @include('layout.js.searchboxtop')

        @if(Session::has('globalalertmessage'))
            <script type="text/javascript">
                $.notify("{{ Session::get('globalalertmessage') }}", "{{ Session::get('globalalertclass') }}");
            </script>
        @endif


     
    </body>
</html><!-- Yash Murty -->