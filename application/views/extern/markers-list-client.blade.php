@layout('template.client')

@section('title')
Markers list | Alys Google Maps manager
@endsection

@section('content')
<div class="container">
	<div class="row-fluid">
		<div class="span9">
			<?php $message = Session::get('message'); ?>
			@if(!empty($message))
				<div class="alert alert-success fade in">
					{{ $message }}
					<button type="button" class="close" data-dismiss="alert">×</button>
				</div>
			@endif

			<div class="well">
				<table class="table table-striped table-hover">
				  <thead>
					<tr>
						<th style="width: 15px; border-right: 1px solid #e3e3e3;"><abbr title="Edit">E</abbr></th>
						<th>#</th>
						<th>Name</th>
						<th>Address</th>
						<th>Lat</th>
						<th>Long</th>
						<th>Type</th>
					</tr>
				  </thead>
				  <tbody>
				  	@if( !empty($markers) )
						@foreach ($markers->results as $marker)
							<tr>
								<td style="width: 15px; border-right: 1px solid #e3e3e3;">
									<a href="{{ URL::to_route('client_edit_marker',$marker->id) }}"><i class="icon-pencil"></i></a>
								</td>
								<td>{{ $marker->id }}</td>
								<td>{{ $marker->name }}</td>
								<td>{{ $marker->address }}</td>
								<td>{{ $marker->lat }}</td>
								<td>{{ $marker->lng }}</td>
								<td>{{ $marker->type }}</td>
							</tr>
						@endforeach
					@else
						<p class="lead">
							You don't have any markers. <a href="{{ URL::to_route('client_new_marker') }}">Start by adding a marker here.</a>
						</p>
					@endif

				  </tbody>

				</table>
				<?php echo $markers->links(3, Paginator::ALIGN_CENTER); ?>
			</div>
		</div><!-- / .span8 -->
		<div class="span3">
			<ul class="nav nav-list">
				<li class="nav-header">Actions</li>
				<li class=""><a href="{{ URL::to_route(strtolower(Auth::user()->username)) }}"><i class="icon-home"></i> Accueil</a></li>
				<li class="active"><a href="{{ URL::to_route('client_marker_list') }}"><i class="icon-align-justify"></i> Liste d'adresses</a></li>
				<li class=""><a href="{{ URL::to_route('client_new_marker') }}"><i class="icon-plus-sign"></i> Ajouter une adresse</a></li>
			</ul>
		</div><!-- / .span4 -->

		
	</div>
</div>
<div class="container">
	<div class="row-fluid">
		<div class="span3">
			<a href="{{ URL::to_route('client_new_marker') }}">
				<button class="btn btn-success {{strtolower(Auth::user()->username)}}">New Marker</button>
			</a>
		</div>
	</div>
</div>
@endsection