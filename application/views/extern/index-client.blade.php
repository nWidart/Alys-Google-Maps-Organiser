@layout('template.client')

@section('title')
{{ Auth::user()->username }} | Alys Google Maps manager
@endsection


@section('content')
<div class="container">
	<div class="row-fluid">
		<div class="span9">
			<p class="lead">
				Bienvenue {{ Auth::user()->username }}, <br />
				Dans cette administration vous pouvez gérer votre Google Map.
			</p>
		</div>
		<div class="span3">
			<ul class="nav nav-list">
				<li class="nav-header">Actions</li>
				<li class="active"><a href="{{ URL::to_route(strtolower(Auth::user()->username)) }}"><i class="icon-home"></i> Accueil</a></li>
				<li class=""><a href="{{ URL::to_route('client_marker_list') }}"><i class="icon-align-justify"></i> Liste d'adresses</a></li>
				<li><a href="{{ URL::to_route('client_new_marker') }}"><i class="icon-plus-sign"></i> Ajouter une adresse</a></li>
			</ul>
		</div>

	</div>
</div>
@endsection
