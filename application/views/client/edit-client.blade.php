@layout('template.base')

@section('title')
Edit a client| Alys Google Maps manager
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
			{{ Form::horizontal_open() }}
			<div class="span5">

				<?php
					if ( $errors->has('societe') )
					{
						echo Form::control_group(Form::label('societe', 'Société'),
						Form::xlarge_text('societe', $client->societe, array('Placeholder' => 'Societe') ),
						'error',
						Form::inline_help( $errors->first('societe') ));
					}
					else
					{
						echo Form::control_group(Form::label('societe', 'Société'),
						Form::xlarge_text('societe', $client->societe, array('Placeholder' => 'Societe') ), '');
					}

					if ( $errors->has('nom') )
					{
						echo Form::control_group(Form::label('nom', 'Nom'),
						Form::xlarge_text('nom', $client->nom, array('Placeholder' => 'Nom') ),
						'error',
						Form::inline_help( $errors->first('nom') ));
					}
					else
					{
						echo Form::control_group(Form::label('nom', 'Nom'),
						Form::xlarge_text('nom', $client->nom, array('Placeholder' => 'Nom') ), '');
					}

					echo Form::actions(array(Buttons::primary_submit('Edit Client')));
				?>
			
			</div><!-- / div.span5 -->
			{{ Form::close() }}
			<div class="span5">
				<h4>Nombre de markers: <small>{{ $marker_count }}</small></h4>

				{{ Buttons::link('Add marker for this client', 'home/new_marker/'.$client->id) }}

			</div>
			
		</div>
	</div>

@endsection