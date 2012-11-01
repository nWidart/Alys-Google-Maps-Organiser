<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width">
	{{ Asset::container('bootstrapper')->styles(); }}
	{{ Asset::container('bootstrapper')->scripts(); }}
	{{ Asset::scripts() }}
	{{ Asset::styles() }}
</head>
<body>
	<!-- HEADER -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#" name="top">
					<?php
					if (Session::has('client_name_s'))
					{
						echo Session::get('client_name_s');
					}
					else
					{
						echo "Default";
					}
					?>
				</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="icon-book icon-white"></i> Adresses	<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{ URL::to_action('home@marker_'.Session::get('client_name_s')) }}"><i class="icon-align-justify"></i> Listing</a></li>
								<li><a href="{{ URL::to_action('home@new_marker/'.Session::get('client_id_s')) }}"><i class="icon-plus-sign"></i> Ajouter</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
			<!--/.container-fluid -->
		</div>
		<!--/.navbar-inner -->
	</div>
	<!--/.navbar -->
	<!-- end HEADER -->

	<!-- Content -->
	@yield('content')

</body>
</html>
