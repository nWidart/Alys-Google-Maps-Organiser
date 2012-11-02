@layout('template.base')

@section('title')
Geocoder
@endsection


@section('content')
<div class="container">
	<?php
		echo Form::search_open();
		echo Form::search_box('address',null, array('class' => 'input-medium'));
		echo Form::submit('Search');
		echo Form::close();
	?>
	@if ( !empty($lng) && !empty($lat) )
		Your coords are : {{$lng}} and {{$lat}}
	@endif
</div>
@endsection

