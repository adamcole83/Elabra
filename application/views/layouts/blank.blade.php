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
	<body class="blank">
		
		@yield('content')

		<!-- Scripts -->
		@render('partials.scripts')

	</body>
</html>