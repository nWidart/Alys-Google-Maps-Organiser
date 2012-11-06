@layout('template.base')

@section('title')
Add a marker| Alys Google Maps manager
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
		{{ Form::horizontal_open_for_files() }}
		<div class="span5">
		<?php
			if ( $errors->has('name') )
			{
				echo Form::control_group(
				Form::label('name', 'Nom du marker'),
				Form::xlarge_text('name', Input::old('name'), array('placeholder' => 'nom') ),
				'error',
				Form::inline_help( $errors->first('name') ));
			}
			else
			{
				echo Form::control_group(
					Form::label('name', 'Nom du marker'),
					Form::xlarge_text('name', Input::old('name'), array('placeholder' => 'nom') ),
					'');
			}

			if ( $errors->has('address') )
			{
				echo Form::control_group(Form::label('address', 'Adresse'),
				Form::xlarge_text('address', Input::old('address') ), 'error',
				Form::inline_help( $errors->first('address') ) );
			}
			else
			{
				echo Form::control_group(Form::label('address', 'Adresse'),
				Form::xlarge_text('address', Input::old('address') ), '',
				Form::block_help('Longitude & Latitude are generated automaticly.'));
			}
				//echo '<div class="span3 offset2"><button id="address_btn" class="btn btn-info btn-mini" type="button">Calculate coords</button></div><br/><br/>';
			
			if ( $errors->has('lat') )
			{
				echo Form::control_group(Form::label('lat', 'Latitude'),
				Form::xlarge_text('lat', Input::old('lat') ), 'error',
				Form::inline_help( $errors->first('lat') ));
			}
			else
			{
				echo Form::control_group(Form::label('lat', 'Latitude'),
				Form::xlarge_text('lat', Input::old('lat') ), '');
			}

			if ( $errors->has('lng') )
			{
				echo Form::control_group(Form::label('lng', 'Longitude'),
				Form::xlarge_text('lng', Input::old('lng') ), 'error',
				Form::inline_help( $errors->first('lng') ));
			}
			else
			{
				echo Form::control_group(Form::label('lng', 'Longitude'),
				Form::xlarge_text('lng', Input::old('lng')), '');
			}
			
			if ( $errors->has('type') )
			{
				echo Form::control_group(Form::label('type', 'Type'),
				Form::xlarge_text('type', Input::old('type') ), 'error',
				Form::inline_help( $errors->first('type') ));
			}
			else
			{
				echo Form::control_group(Form::label('type', 'Type'),
				Form::xlarge_text('type', Input::old('type') ), '');
			}

			if ( $errors->has('img_input') )
			{
				echo Form::control_group(Form::label('img_input', 'Image'),
				Form::file('img_input'),
				Form::inline_help( $errors->first('img_input') ));
			}
			else
			{
				echo Form::control_group(Form::label('img_input', 'Image'),
				Form::file('img_input'));
			}
			
			echo Form::control_group(Form::label('client', 'Client'),
			Form::select('client', $clients));

			echo Form::actions(array(Buttons::success_submit('Add new')));

		?>
		</div>
		<div class="span5">
			<?php
				$value = (isset($marker->rem1)) ? $marker->rem1 : '';
				echo Form::control_group(Form::label('rem1', 'Remarque #1'),
				   Form::xlarge_textarea('rem1', Input::old('rem1'), array('rows' => '2')));
		
				$value = (isset($marker->rem2)) ? $marker->rem2 : '';
				echo Form::control_group(Form::label('rem2', 'Remarque #2'),
				   Form::xlarge_textarea('rem2', Input::old('rem2'), array('rows' => '2')));
			
				$value = (isset($marker->rem3)) ? $marker->rem3 : '';
				echo Form::control_group(Form::label('rem3', 'Remarque #3'),
				   Form::xlarge_textarea('rem3', Input::old('rem3'), array('rows' => '2')));

				$value = (isset($marker->rem4)) ? $marker->rem4 : '';
				echo Form::control_group(Form::label('rem4', 'Remarque #4'),
				   Form::xlarge_textarea('rem4', Input::old('rem4'), array('rows' => '2')));

				$value = (isset($marker->rem5)) ? $marker->rem5 : '';
				echo Form::control_group(Form::label('rem4', 'Remarque #4'),
				   Form::xlarge_textarea('rem4', Input::old('rem5'), array('rows' => '2')));
			?>
		</div>

		{{ Form::close() }}
		<div class="span3 offset1 img_thumb">
			@if ( !empty($marker->img_url) )
				<h5>Votre image:</h5>
				<div class="img_wrapper"><img src="{{ $marker->img_url }}"></div>
			@endif
		</div>
	</div>
</div>
@endsection
@section('scripts')

<script type="text/javascript">
$(document).ready(function(){
    $("#address_btn").on('click', function(){
    	var geocoder = new google.maps.Geocoder();
		var address = $("#address").val();

		geocoder.geocode( { 'address': address}, function(results, status) {

		if (status == google.maps.GeocoderStatus.OK) {
		    var latitude = results[0].geometry.location.lat();
			var longitude = results[0].geometry.location.lng();
		     $("#lat").val(latitude);
		     $("#lng").val(longitude);
		    } 
		});
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){

	$("#address").on("change", function(){
		var geocoder = new google.maps.Geocoder();
		var address = $("#address").val();

		geocoder.geocode( { 'address': address}, function(results, status) {

		if (status == google.maps.GeocoderStatus.OK) {
		    var latitude = results[0].geometry.location.lat();
			var longitude = results[0].geometry.location.lng();
		     $("#lat").val(latitude);
		     $("#lng").val(longitude);
		    } 
		});
	});

});
</script>

@endsection