@section('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{{$title or "Title" }}}</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">   
	{{ HTML::style('/assets/admin/css/bootstrap.min.css') }}
	{{ HTML::style('/assets/admin/css/bootstrap-responsive.min.css') }}
	{{ HTML::style('/assets/admin/css/font-awesome.css') }}
	{{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600') }}    
	{{ HTML::style('/assets/admin/css/style.css') }}
	{{ HTML::style('/assets/admin/css/pages/signin.css') }}
  	{{ HTML::style('/assets/admin/css/animate.css') }}
</head>
<body>
@stop