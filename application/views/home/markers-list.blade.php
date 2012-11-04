@layout('template.base')

@section('title')
Markers list | Alys Google Maps manager
@endsection

@section('content')
<div class="container">
	<div class="row-fluid">
		<div class="span3">
			<a href="{{ URL::to_action('home@new_marker') }}"><button class="btn btn-primary">New Marker</button></a>
			<a href="{{ URL::to_action('home@delete_session') }}"><button class="btn">Flush</button></a>
		</div>
		<div class="pull-right">
			{{ Form::open() }}
			@if (isset($active_client))
			{{ Form::append_buttons(Form::select('client', $clients, $active_client), Form::submit('Filter')) }}
			@else
			{{ Form::append_buttons(Form::select('client', $clients), Form::submit('Filter')) }}
			{{ Form::close() }}
			@endif
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
				  <th>Client</th>
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
							<td>{{ $marker->username }}</td>
							<td>
								  <a href="{{ URL::to_action('home@edit_marker/') }}/{{ $marker->id }}"><i class="icon-pencil"></i></a>
								  <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
							  </td>
						</tr>
					@endforeach
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