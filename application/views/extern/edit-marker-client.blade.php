@layout('template.client')


@section('title')
Edit a marker| Alys Google Maps manager
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
			
			if ( $errors->has('name') )
			{
				echo Form::control_group(Form::label('name', 'Nom du marker'),
				Form::xlarge_text('name', $marker->name, array('Placeholder' => 'Nom') ),
				'error',
				Form::inline_help( $errors->first('name') ));
			}
			else
			{
				echo Form::control_group(Form::label('name', 'Nom du marker'),
				Form::xlarge_text('name', $marker->name, array('Placeholder' => 'Nom') ), '');
			}

			if ( $errors->has('address') )
			{
				echo Form::control_group(Form::label('address', 'Adresse'),
				Form::xlarge_text('address', $marker->address), 'error',
				Form::inline_help( $errors->first('address') ));
			}
			else
			{
				echo Form::control_group(Form::label('address', 'Adresse'),
				Form::xlarge_text('address', $marker->address), '');
			}

			if ( $errors->has('lat') )
			{
				echo Form::control_group(Form::label('lat', 'Latitude'),
				Form::xlarge_text('lat', $marker->lat), 'error',
				Form::inline_help( $errors->first('lat') ));
			}
			else
			{
				echo Form::control_group(Form::label('lat', 'Latitude'),
				Form::xlarge_text('lat', $marker->lat), '');
			}

			if ( $errors->has('lng') )
			{
				echo Form::control_group(Form::label('lng', 'Longitude'),
				Form::xlarge_text('lng', $marker->lng), 'error',
				Form::inline_help( $errors->first('lng') ));
			}
			else
			{
				echo Form::control_group(Form::label('lng', 'Longitude'),
				Form::xlarge_text('lng', $marker->lng), '');
			}			
			
			if ( $errors->has('type') )
			{
				echo Form::control_group(Form::label('type', 'Type'),
				Form::xlarge_text('type', $marker->type), 'error',
				Form::inline_help( $errors->first('type') ));
			}
			else
			{
				echo Form::control_group(Form::label('type', 'Type'),
				Form::xlarge_text('type', $marker->type), '');
			}
			
			echo Form::control_group(Form::label('client', 'Client'),
			Form::select('client', $clients, $marker->client_id));

			echo Form::actions(array(Buttons::primary_submit('Edit')));

		?>
		</div>
		<div class="span5">
			<?php
				$value = (isset($marker->rem1)) ? $marker->rem1 : '';
				echo Form::control_group(Form::label('rem1', 'Remarque #1'),
				   Form::xlarge_textarea('rem1', $value, array('rows' => '2')));
		
				$value = (isset($marker->rem2)) ? $marker->rem2 : '';
				echo Form::control_group(Form::label('rem2', 'Remarque #2'),
				   Form::xlarge_textarea('rem2', $value, array('rows' => '2')));
			
				$value = (isset($marker->rem3)) ? $marker->rem3 : '';
				echo Form::control_group(Form::label('rem3', 'Remarque #3'),
				   Form::xlarge_textarea('rem3', $value, array('rows' => '2')));

				$value = (isset($marker->rem4)) ? $marker->rem4 : '';
				echo Form::control_group(Form::label('rem4', 'Remarque #4'),
				   Form::xlarge_textarea('rem4', $value, array('rows' => '2')));

				$value = (isset($marker->rem4)) ? $marker->rem4 : '';
				echo Form::control_group(Form::label('rem4', 'Remarque #4'),
				   Form::xlarge_textarea('rem4', $value, array('rows' => '2')));
			?>
		</div>

		{{ Form::close() }}
	</div>
</div>
	

@endsection