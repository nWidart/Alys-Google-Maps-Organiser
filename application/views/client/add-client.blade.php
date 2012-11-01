@layout('template.base')

@section('title')
Add a client| Alys Google Maps manager
@endsection


@section('content')
	
	<div class="container">
		<div class="row-fluid">
			<?php $message = Session::get('message'); ?>
			<?php if(!empty($message)) : ?>
				<div class="alert alert-success">
					{{ $message }}
				</div>
			<?php endif; ?>
			{{ Form::horizontal_open() }}
			<div class="span5">

				<?php
					if ( $errors->has('societe') )
					{
						echo Form::control_group(Form::label('societe', 'Société'),
						Form::xlarge_text('societe', '', array('Placeholder' => 'Societe') ),
						'error',
						Form::inline_help( $errors->first('societe') ));
					}
					else
					{
						echo Form::control_group(Form::label('societe', 'Société'),
						Form::xlarge_text('societe', '', array('Placeholder' => 'Societe') ), '');
					}

					if ( $errors->has('nom') )
					{
						echo Form::control_group(Form::label('nom', 'Nom'),
						Form::xlarge_text('nom', '', array('Placeholder' => 'Nom') ),
						'error',
						Form::inline_help( $errors->first('nom') ));
					}
					else
					{
						echo Form::control_group(Form::label('nom', 'Nom'),
						Form::xlarge_text('nom', '', array('Placeholder' => 'Nom') ), '');
					}

					echo Form::actions(array(Buttons::primary_submit('Add Client')));
				?>
			
			</div>

			{{ Form::close() }}
		</div>
	</div>

@endsection