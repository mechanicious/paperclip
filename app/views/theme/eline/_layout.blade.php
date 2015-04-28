@include('theme.eline.menu.index')
@include('theme.eline.footer.index')

<!DOCTYPE html>
<html lang="">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap core CSS -->
        {{ HTML::style('/assets/css/bootstrap.css') }}
        {{ HTML::style('/assets/css/mods.css') }}
        <!-- Bootstrap core Icons -->
        {{ HTML::style('/assets/css/font-awesome.min.css') }}

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- Favicons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="shortcut icon" href="/assets/ico/favicon.png">
        <style id="holderjs-style" type="text/css"></style>

    </head>
<body style="">
	@yield('menu')
	@yield('content')
  @yield('footer')

    {{ HTML::script('/assets/js/jquery.min.js') }}
    {{ HTML::script('/assets/js/bootstrap.js') }}
    <!-- Image placeholders -->
    {{ HTML::script('/assets/js/holder.js') }}
    <!-- Our application core -->
    {{ HTML::script('/assets/js/application.js') }}
    {{ HTML::script('/assets/js/scripts.js') }}
  
</body>
</html>