@layout('layouts.blank')

@section('content')
	
	<div class="login">
		<div class="login-icon">
			{{ HTML::image('img/illustrations/colors.png') }}
			<h4>
				Welcome to
				<small>Elabra</small>
			</h4>
		</div>
		<div class="login-screen">
			{{ Form::open('login', 'POST', array('class' => 'login-form')) }}
				
				<!-- check for login errors flash var -->
				@if (Session::has('login_errors'))
					<div class="alert alert-error">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<span class="error">Incorrect username or password.</span>
					</div>
				@endif

				<!-- username field -->
				<div class="control-group">
					{{ Form::text('username', '', array('placeholder' => 'Enter your username', 'class' => 'login-field', 'id' => 'login-name', 'autocomplete' => 'off')) }}
					{{ Form::label('username', '', array('class' => 'login-field-icon fui-man-16')) }}
				</div>

				<!-- password field -->
				<div class="control-group">
					{{ Form::password('password', array('placeholder' => 'Password', 'class' => 'login-field', 'id' => 'login-pass')) }}
					{{ Form::label('username', '', array('class' => 'login-field-icon fui-lock-16')) }}
				</div>
				
				<!-- remember me? -->
				<label class="checkbox" for="remember">
					{{ Form::checkbox('remember', true, false, array('id' => 'remember')) }}
					Remember me
				</label>

				<!-- submit button -->
				<p>{{ Form::submit('Login', array('class' => 'btn btn-info btn-large btn-block')) }}</p>

				<!-- forgot password -->
				{{ HTML::link('forgot', 'Lost your password?', array('class' => 'login-link')) }}

			{{ Form::close() }}
		</div>
	</div>
	
	<!-- @render('partials.fss') -->

@endsection