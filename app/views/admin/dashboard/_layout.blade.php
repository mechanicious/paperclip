@include('admin.dashboard._menu')
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> {{{ $localeTitle or "Title" }}} | Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		{{ HTML::style('/assets/admin/css/bootstrap.min.css') }} 										
		{{ HTML::style('/assets/admin/css/bootstrap-responsive.min.css') }}								
		{{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600') }}
		{{ HTML::style('/assets/admin/css/font-awesome.css') }}											
		{{ HTML::style('/assets/admin/css/style.css') }}													
		{{ HTML::style('/assets/admin/css/pages/dashboard.css') }}																
		{{ HTML::style('/assets/admin/css/image-picker.css') }}									
		{{ HTML::style('/assets/admin/css/animate.css') }}
		<!-- {{ HTML::script('/assets/admin/js/jquery-1.7.2.min.js') }} -->
		{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js') }}
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- GammaGallery --> 
	    {{ HTML::script('/assets/admin/gammagallery/js/modernizr.custom.70736.js') }}
	    {{ HTML::style('/assets/admin/gammagallery/css/noJS.css') }}
    <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
  <!-- end GammaGallery -->
	</head>
		<body>
			@yield('menu')
			@yield('content')
			{{-- {{ HTML::script('/assets/admin/js/excanvas.min.js') }}	 --}}		
			{{-- {{ HTML::script('/assets/admin/js/chart.min.js') }} --}}   
			{{ HTML::script('/assets/admin/js/bootstrap.js') }}
			{{-- {{ HTML::script('/assets/admin/js/full-calendar/fullcalendar.min.js') }} --}}
			{{ HTML::script('/assets/admin/js/base.js') }}
			{{ HTML::script('/assets/admin/ckeditor/ckeditor.js') }}
			{{-- {{ HTML::script('/assets/admin/js/typeahead.min.js') }} --}}
			{{-- {{ HTML::script('/assets/admin/tagmanager-master/tagmanager.js') }} --}}
	</body>
</html>