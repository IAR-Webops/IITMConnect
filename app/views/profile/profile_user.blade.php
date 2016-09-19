<!DOCTYPE HTML>
<!--
	Yash Murty
-->
<html>
	<head>
		<title>Profile Page</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="profile_assets/js/ie/html5shiv.js"></script><![endif]-->
        {{ HTML::style('profile_assets/css/main.css'); }}

		<!--[if lte IE 8]><link rel="stylesheet" href="profile_assets/css/ie8.css" /><![endif]-->
	</head>
	<body id="top">

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="#" class="image avatar"><img src="{{ URL::asset('img/github-search.jpg') }}" alt="" /></a>
					<h1><strong>I am {{ $basic_info->firstname }}</strong><br />
					Something cool about me here.</h1>
				</div>
			</header>

		<!-- Main -->
			<div id="main">

				<!-- One -->
					<section id="one">
						<header class="major">
							<h2>{{ $basic_info->firstname }} {{ $basic_info->lastname }}</h2>
						</header>
						<p>Accumsan orci faucibus id eu lorem semper. Eu ac iaculis ac nunc nisi lorem vulputate lorem neque cubilia ac in adipiscing in curae lobortis tortor primis integer massa adipiscing id nisi accumsan pellentesque commodo blandit enim arcu non at amet id arcu magna. Accumsan orci faucibus id eu lorem semper nunc nisi lorem vulputate lorem neque cubilia.</p>
					</section>

				<!-- Three -->
					<section id="three">
						<h2>Get In Touch</h2>
						<p>Sign in to view contact details.</p>

					</section>


			</div>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-linkedin"><span class="label">Linkedin</span></a></li>
						<!-- <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li> -->
					</ul>
					<ul class="copyright">
						<li>&copy; <a href="https://github.com/IAR-Webops" target="_alt">IAR Webops</a></li>
						<!-- <li>Design: <a target="_alt" href="https://yashmurty.com">yashmurty</a></li> -->
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
        {{ HTML::script('profile_assets/js/jquery.min.js'); }}
        {{ HTML::script('profile_assets/js/jquery.poptrox.min.js'); }}
        {{ HTML::script('profile_assets/js/skel.min.js'); }}
        {{ HTML::script('profile_assets/js/util.js'); }}
        <!--[if lte IE 8]><script src="profile_assets/js/ie/respond.min.js"></script><![endif]-->
        {{ HTML::script('profile_assets/js/main.js'); }}

	</body>
</html>
