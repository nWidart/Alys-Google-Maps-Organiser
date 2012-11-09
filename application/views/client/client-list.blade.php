@layout('template.base')

@section('title')
Client list | Alys Google Maps manager
@endsection

@section('content')
<div class="container">
	<div class="row-fluid">
		<?php $message = Session::get('message');?>
		@if(!empty($message))
			<div class="alert alert-success fade in">
				{{ $message }}
				<button type="button" class="close" data-dismiss="alert">×</button>
			</div>
		@endif
		@if (Session::has('hint'))
		<div class="span8">
			<div class="alert alert-block fade in">
				<button type="button" class="close" data-dismiss="alert">×</button>
				Don't forget to add correct route to the <code>application/routes.php</code> file!
				<pre>
Route::any('utilisateur', array('as' => 'utilisateur', 'uses' => 'company@index', 'before' => 'client') );
				</pre>
			</div>
		</div>
		@endif
	</div>
	<div class="row-fluid">
		<div class="span3">
			<a href="{{ URL::to_action('client@new_client') }}"><button class="btn btn-success">New Client</button></a>
		</div>
	</div>
</div>
<div class="container">
	<div class="row-fluid">
		
		<div class="span6">
			<div class="well">
				<table class="table table-striped">
				  <thead>
					<tr>
						<th style="width: 15px; border-right: 1px solid #e3e3e3;"></th>
					  <th>#</th>
					  <th>Société(login)</th>
					  <th>Password</th>
					  <th>Groupe</th>
					</tr>
				  </thead>
				  <tbody>
				  	@if( !empty($clients) )
						@foreach ($clients as $client)
							<tr>
								<td style="width: 15px; border-right: 1px solid #e3e3e3;">
									<a href="{{ URL::to_action('client@edit_client/') }}/{{ $client->id }}"><i class="icon-pencil"></i></a>
									<!-- <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a> -->
								</td>
								<td>{{ $client->id }}</td>
								<td>{{ $client->username }}</td>
								<td>**********</td>
								<td>
									@if ($client->group == 1)
										Admin
									@else
										Client
									@endif
								</td>
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
							</tr>
						@endforeach
					@endif
				  </tbody>
				</table>
				<p>
					<span class="label label-important">Important</span> <a href="https://github.com/nWidart/Alys-Google-Maps-Organiser/blob/master/readme.md" target="_blank">Comment créer & ajouter un nouveau client.</a>
				</p>
			</div><!-- / div.well -->
		</div><!-- / div.span6 -->
	</div>
</div>
@endsection