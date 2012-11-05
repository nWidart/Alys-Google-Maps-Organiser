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
				<a class="brand" href="{{ URL::to_route('dashboard') }}" name="top">Alys Google Maps Organiser</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li><a href="{{ URL::to_route('dashboard') }}"><i class="icon-home icon-white"></i> Home</a></li>
						<li class="divider-vertical"></li>
						@if ( Auth::check() )
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="icon-book icon-white"></i> Adresses	<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{ URL::to_action('home@marker') }}"><i class="icon-align-justify"></i> Listing</a></li>
								<li><a href="{{ URL::to_action('home@new_marker') }}"><i class="icon-plus-sign"></i> Ajouter</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="icon-user icon-white"></i> Clients	<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{ URL::to_action('client@listing') }}"><i class="icon-align-justify"></i> Listing</a></li>
								<li><a href="{{ URL::to_action('client@new_client') }}"><i class="icon-plus-sign"></i> Ajouter</a></li>
							</ul>
						</li>

						<li><a href="{{ URL::to_action('geocode@index') }}"><i class="icon-map-marker icon-white"></i> Geocode</a></li>
						@endif
					</ul>
					<div class="pull-right">
						<ul class="nav pull-right">
							@if ( Auth::check() )
							<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, {{ Auth::user()->username }} <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="/logout"><i class="icon-off"></i> Logout</a></li>
								</ul>
							</li>
							@else
							<li class="dropdown">
								<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
								<div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
									{{ Form::open('login') }}
										<input style="margin-bottom: 15px;" type="text" placeholder="Username" id="username" name="username">
										<input style="margin-bottom: 15px;" type="password" placeholder="Password" id="password" name="password">										
										<input class="btn btn-info btn-block" type="submit" id="sign-in" value="Sign In">

									{{ Form::close() }}
								</div>
							</li>
							@endif

						</ul>
					</div>
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

	<!-- Extra page specific scripts -->
	@yield('scripts')

	<!-- Side wide scripts -->
	<script type="text/javascript">$(".alert").alert()</script>
</body>
</html>
