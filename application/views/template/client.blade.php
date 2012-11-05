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
		<div class="navbar-inner {{ strtolower(Auth::user()->username) }}">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="{{ URL::to_route(''.strtolower(Auth::user()->username).'') }}" name="top">
					{{ strtolower(Auth::user()->username) }}
				</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li class="dropdown {{ strtolower(Auth::user()->username) }}">
							<a class="dropdown-toggle{{ strtolower(Auth::user()->username) }}" data-toggle="dropdown" href="#">
								<i class="icon-book icon-white"></i> Adresses	<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{ URL::to_route('client_marker_list') }}"><i class="icon-align-justify"></i> Listing</a></li>
								<li><a href="{{ URL::to_route('client_new_marker',Session::get('client_id_s')) }}"><i class="icon-plus-sign"></i> Ajouter</a></li>
							</ul>
						</li>
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

	<footer class="footer">
		<div class="container">
			<ul class="footer-links">
				<li><a href="http://www.alys.be">Alys</a></li>
			</ul>
		</div>
	</footer>

	<!-- Extra page specific scripts -->
	@yield('scripts')

</body>
</html>
