@layout('template.client')

@section('title')
{{ Auth::user()->username }} | Alys Google Maps manager
@endsection


@section('content')
<div class="container">
	<div class="row-fluid">
		<div class="span8">
			<p class="lead">
				Bienvenue {{ Auth::user()->username }}, <br />
				Dans cette administration vous pouvez gérer votre Google Map.
			</p>
		</div>
		<div class="span4">
			<ul class="nav nav-list">
				<li class="nav-header">Actions</li>
				<li class="active"><a href="{{ URL::to_route(''.Session::get('client_name_s').'') }}">Accueil</a></li>
				<li class=""><a href="{{ URL::to_route('client_marker_list') }}">Liste d'adresses</a></li>
				<li><a href="{{ URL::to_route('client_new_marker',Session::get('client_id_s')) }}">Ajouter une adresse</a></li>
			</ul>
		</div>

	</div>
</div>
@endsection
