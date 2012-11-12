@layout('template.base')

@section('title')
Markers list | Alys Google Maps manager
@endsection

@section('content')
<div class="container">
	<div class="row-fluid">
		<div class="span3">
			<a href="{{ URL::to_route('new_marker') }}"><button class="btn btn-success">New Marker</button></a>
			<a href="{{ URL::to_action('home@marker') }}"><button class="btn btn-info">Show all</button></a>
		</div>
		<div class="pull-right">
			{{ Form::open() }}
			@if (isset($active_client))
			{{ Form::append_buttons(Form::select('client', $clients, $active_client), Form::submit('Filter', array('class' => 'btn-info'))) }}
			@else
			{{ Form::append_buttons(Form::select('client', $clients), Form::submit('Filter', array('class' => 'btn-info'))) }}
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
			<table class="table table-striped">
			  <thead>
				<tr>
					<th style="width: 15px; border-right: 1px solid #e3e3e3;">E</th>
					<th>#</th>
					<th>Name</th>
					<th>Address</th>
					<th>Lat</th>
					<th>Long</th>
					<th>Type</th>
					<th>Client</th>
				</tr>
			  </thead>
			  <tbody>
			  	@if( !empty($markers) )
					@foreach ($markers->results as $marker)
						<tr>
							<td style="width: 15px; border-right: 1px solid #e3e3e3;">
								<a href="{{ URL::to_action('home@edit_marker/') }}/{{ $marker->id }}"><i class="icon-pencil"></i></a>
							</td>
							<td>{{ $marker->id }}</td>
							<td>{{ $marker->name }}</td>
							<td>{{ $marker->address }}</td>
							<td>{{ $marker->lat }}</td>
							<td>{{ $marker->lng }}</td>
							<td>{{ $marker->type }}</td>
							<td>{{ $marker->username }}</td>
						</tr>
					@endforeach
				@endif
			  </tbody>
			</table>
			<?php echo $markers->links(3, Paginator::ALIGN_CENTER); ?>
		</div>
		
	</div>
</div>
@endsection