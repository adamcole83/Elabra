{{ Form::open('login') }}
	
	<!-- check for login errors flash var -->
	@if (Session::has('login_errors'))
		<span class="error">Incorrect username or password.</span>
		<span class="error">{{ Session::get('login_errors') }}</span>
	@endif

	<!-- username field -->
	<p>{{ Form::label('username', 'Username') }}</p>
	<p>{{ Form::text('username') }}</p>

	<!-- password field -->
	<p>{{ Form::label('password', 'Password') }}</p>
	<p>{{ Form::password('password') }}</p>
	
	<!-- remember me? -->
	<p>{{ Form::checkbox('remember', 'true') . Form::label('remember', ' Remember me for two weeks?') }}</p>

	<!-- submit button -->
	<p>{{ Form::submit('Login') }}</p>

{{ Form::close() }}