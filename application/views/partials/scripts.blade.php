{{ HTML::script('js/jquery-1.8.2.min.js') }}
{{ HTML::script('js/jquery-ui-1.10.0.custom.min.js') }}
{{ HTML::script('js/jquery.dropkick-1.0.0.js') }}
{{ HTML::script('js/custom_forms.js') }}
{{ HTML::script('js/jquery.tagsinput.js') }}
{{ HTML::script('js/bootstrap-tooltip.js') }}
{{ HTML::script('js/jquery.placeholder.js') }}
{{ HTML::script('js/application.js') }}
<!--[if lt IE 9]>
	{{ HTML::script('js/icon-font-ie7.js') }}
	{{ HTML::script('js/lte-ie7-24.js') }}
<![endif]-->

{{ Asset::container('footer')->scripts() }}