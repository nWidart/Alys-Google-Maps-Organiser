@layout('template.base')

@section('title')
Alys Google Maps manager
@endsection

@section('content')
<div class="container">
	<div class="row-fluid">
	  <div class="span4 offset4">
	  		<a href="{{ URL::to_action('home@marker')}}">
				<button class="btn btn-large btn-block btn-primary" type="button">Adresses</button>
			</a>
			<br />
			<a href="{{ URL::to_action('client@listing') }}">
				<button class="btn btn-large btn-block btn-primary" type="button">Clients</button>
			</a>
	  </div>
	</div>
</div>
@endsection