@layout('template.base')

@section('title')
Login
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="span4 offset4 well">
			{{ Form::open('login') }}
				<legend>Please Sign In</legend>
          	@if (Session::has('login_errors'))
				<div class="alert alert-error fade in">
					Username or password incorrect.
					<button type="button" class="close" data-dismiss="alert">×</button>
				</div>
			@endif
			@if(Session::has('denied'))
				<div class="alert alert-warning fade in">
					{{ $denied }}
					<button type="button" class="close" data-dismiss="alert">×</button>
				</div>
			@endif
			{{ Form::text('username', null, array('class' => 'span4', 'placeholder' => 'Username')) }}
			{{ Form::password('password', array('class' => 'span4', 'placeholder' => 'Password')) }}
			{{ Buttons::info_submit('Sign In', array('class' => 'btn-block'))}}
			{{ Form::close() }}    
		</div>
	</div>
</div>
@endsection