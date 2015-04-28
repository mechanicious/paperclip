@section('menu')
	<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse"></a>
            <a class="brand" href="{{ route('admin.home') }}">
                {{{ $title or 'Title'}}}
            </a>
            <div class="nav-collapse">
                <ul class="nav pull-right">
                    <li class=""><a class="" href="{{ route('admin.signup') }}">Don't have an account?</a></li>

                    <li class=""><a class="" href="{{ route('admin.home') }}">Back to Homepage</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!-- /container -->
    </div><!-- /navbar-inner -->
</div><!-- /navbar -->
@stop