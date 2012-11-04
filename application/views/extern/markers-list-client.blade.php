@layout('template.client')

@section('title')
Markers list | Alys Google Maps manager
@endsection

@section('content')
<div class="container">
	<div class="row-fluid">
		<div class="span3">
			<a href="{{ URL::to_route('client_new_marker') }}">
				<button class="btn btn-primary {{strtolower(Auth::user()->username)}}">New Marker</button>
			</a>
		</div>
	</div>
</div>
<div class="container">
	<div class="row-fluid">
		<?php $message = Session::get('message'); ?>
		@if(!empty($message))
			<div class="alert alert-success fade in">
				{{ $message }}
				<button type="button" class="close" data-dismiss="alert">×</button>
			</div>
		@endif

		<div class="well">
			<table class="table">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Name</th>
				  <th>Address</th>
				  <th>Lat</th>
				  <th>Long</th>
				  <th>Type</th>
				  
				  <th style="width: 36px;"></th>
				</tr>
			  </thead>
			  <tbody>
			  	@if( !empty($markers) )
					@foreach ($markers as $marker)
						<tr>
							<td>{{ $marker->id }}</td>
							<td>{{ $marker->name }}</td>
							<td>{{ $marker->address }}</td>
							<td>{{ $marker->lat }}</td>
							<td>{{ $marker->lng }}</td>
							<td>{{ $marker->type }}</td>
							
							<td>
								  <a href="{{ URL::to_route('client_edit_marker',$marker->id) }}"><i class="icon-pencil"></i></a>
								  <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
							</td>
						</tr>
					@endforeach
				@else
					<p class="lead">
						You don't have any markers. <a href="{{ URL::to_route('client_new_marker',Session::get('client_id_s')) }}">Start by adding a marker here.</a>
					</p>
				@endif
			  </tbody>
			</table>
		</div>
		<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Confirmation de suppresion</h3>
			</div>
			<div class="modal-body">
				<p class="error-text">Etes vous sur de vouloir supprimer le marker?</p>
			</div>
			<div class="modal-footer">
				@if( !empty($markers) )
				<button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
				<a href="{{ URL::to_action('home@delete_marker/' . $marker->id) }}">
					<button class="btn btn-danger">Suprimmer</button>
				</a>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection