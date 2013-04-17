<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Elabra</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Stylesheets -->
		{{ HTML::style('css/bootstrap.css') }}
		{{ HTML::style('css/flat-ui.css') }}
		{{ Asset::styles() }}

		<!-- Header scripts -->
		{{ Asset::container('header')->scripts() }}

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			{{ HTML::style('js/html5shiv.js') }}
		<![endif]-->
	</head>
	<body>
		
		@yield('content')

		<!-- Scripts -->
		{{ HTML::script('js/jquery-1.8.2.min.js') }}
		{{ HTML::script('js/jquery-ui-1.10.0.custom.min.js') }}
		{{ HTML::script('js/jquery.dropkick-1.0.0.js') }}
		{{ HTML::script('js/custom-forms.js') }}
		{{ HTML::script('js/jquery.tagsinput.js') }}
		{{ HTML::script('js/bootstrap-tooltip.js') }}
		{{ HTML::script('js/jquery.placeholder.js') }}
		{{ HTML::script('js/application.js') }}

		{{ Asset::container('footer')->scripts() }}
		<!--[if lt IE 9]>
			{{ HTML::script('js/icon-font-ie7.js') }}
			{{ HTML::script('js/lte-ie7-24.js') }}
		<![endif]-->
	</body>
</html>