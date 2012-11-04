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
					if ( $errors->has('username') )
					{
						echo Form::control_group(Form::label('username', 'Société'),
						Form::xlarge_text('username', $client->username, array('Placeholder' => 'Societe') ),
						'error',
						Form::inline_help( $errors->first('username') ));
					}
					else
					{
						echo Form::control_group(Form::label('username', 'Société'),
						Form::xlarge_text('username', $client->username, array('Placeholder' => 'Societe') ), '');
					}

					if ( $errors->has('password') )
					{
						echo Form::control_group(
							Form::label('password', 'New password'),
							Form::password('password', array('class' => 'input-large')),
							'error'),
							Form::inline_help( $errors->first('nom') );
					}
					else
					{
						echo Form::control_group(Form::label('password', 'New password'),
						Form::password('password', array('class' => 'input-large')), '');
					}

						echo Form::control_group(Form::label('group', 'Groupe'),
						Form::select( 'group', array('1' => 'Admin', '2' => 'Client'), $client->group ) );

					echo Form::actions(array(Buttons::primary_submit('Create Client')));
				?>
			
			</div>

			{{ Form::close() }}
			<div class="span5">
				<h4>Nombre de markers: <small></small></h4>

				{{ Buttons::link('Add marker for this client', 'home/new_marker/'.$client->id) }}

			</div>
			
		</div>
	</div>

@endsection