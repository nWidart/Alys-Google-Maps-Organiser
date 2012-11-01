@layout('template.base')

@section('title')
Client list | Alys Google Maps manager
@endsection

@section('content')
<div class="container">
	<div class="row-fluid">
		<?php $message = Session::get('message'); ?>
		@if(!empty($message))
			<div class="alert alert-success fade in">
				{{ $message }}
				<button type="button" class="close" data-dismiss="alert">×</button>
			</div>
		@endif
	</div>
	<div class="row-fluid">
		<div class="span3">
			<a href="{{ URL::to_action('client@new_client') }}"><button class="btn btn-primary">New Client</button></a>
		</div>
	</div>
</div>
<div class="container">
	<div class="row-fluid">
		
		<div class="span6">
			<div class="well">
				<table class="table">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Société</th>
					  <th>Nom</th>
					  <th style="width: 36px;"></th>
					</tr>
				  </thead>
				  <tbody>
				  	@if( !empty($clients) )
						@foreach ($clients as $client)
							<tr>
								<td>{{ $client->id }}</td>
								<td>{{ $client->societe }}</td>
								<td>{{ $client->nom }}</td>
								<td>
									  <a href="{{ URL::to_action('client@edit_client/') }}/{{ $client->id }}"><i class="icon-pencil"></i></a>
									  <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
								  </td>
							</tr>
						@endforeach
					@endif
				  </tbody>
				</table>
			</div><!-- / div.well -->
		</div><!-- / div.span6 -->
		<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Confirmation de suppresion</h3>
			</div>
			<div class="modal-body">
				<p class="error-text">Etes vous sur de vouloir supprimer le marker?</p>
			</div>
			<div class="modal-footer">
				@if( !empty($clients) )
				<button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
				<a href="{{ URL::to_action('client@delete_client/' . $client->id) }}">
					<button class="btn btn-danger">Suprimmer</button>
				</a>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection