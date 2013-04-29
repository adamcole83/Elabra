<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Elabra</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Stylesheets -->
		@render('partials.stylesheets')

		<!-- Header scripts -->
		{{ Asset::container('header')->scripts() }}

		@yield('head')

	</head>
	<body>
		
			<div class="navbar">
				<div class="navbar-inner">
				
					<a class="brand" href="#">Elabra</a>

					<div class="span4 pull-right">
						{{ Form::select('department', array('Choose a department', 'xx' => 'Physical Medicine & Rehabilitation')) }}
					</div>
				</div>
			</div>

		<div class="container-fluid">
			
			<div class="row-fluid">
				<div class="span3">
					<form class="search">
						<input type="search" class="search-query" placeholder="Search">
					</form>
					<aside>
						Inner sidebar
					</aside>
				</div>
				
				<div class="span10">
					@yield('content')
				</div>
			</div>
		</div>

		<!-- Scripts -->
		@render('partials.scripts')

	</body>
</html>