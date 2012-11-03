@layout('template.base')

@section('title')
Login
@endsection

@section('content')
<div class="container">
	<div class="row-fluid">
		{{ Form::open('login') }}
		<!-- check for login errors flash var -->
		@if (Session::has('login_errors'))
		<span class="error">Username or password incorrect.</span>
		@endif
		<!-- username field -->
		<p>{{ Form::label('username', 'Username') }}</p>
		<p>{{ Form::text('username') }}</p>
		<!-- password field -->
		<p>{{ Form::label('password', 'Password') }}</p>
		<p>{{ Form::password('password') }}</p>
		<!-- submit button -->
		<p>{{ Form::submit('Sign In') }}</p>
		{{ Form::close() }}
	</div>
</div>
@endsection