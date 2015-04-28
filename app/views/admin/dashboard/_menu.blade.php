@section('menu')
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner" @if(isset($menuHeaderCSS)) style="{{ $menuHeaderCSS }}" @endif>
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="{{ route('admin.dashboard') }}">
                        @if (isset($widgetTitle))
                            {{{ $widgetTitle }}}
                        @elseif(isset($localeTitle))
                            {{{ $localeTitle }}}
                        @else
                            {{{ 'Title' }}}
                        @endif
                         | Dashboard
                    </a>
                    <div class="nav-collapse" style="height: 0px;"></div>
                </div>
            </div>
        </div>
        <div class="subnavbar">
            <div class="subnavbar-inner">
                <div class="container">
                    <ul class="mainnav">
                        <li @if (Route::currentRouteName() === "admin.dashboard") class="active" @endif>
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="icon-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li @if (Route::currentRouteName() === "admin.dashboard.language") class="active" @endif >
                            <a href="{{ route('admin.dashboard.language') }}">
                                <i class="icon-globe"></i>
                                <span>Talen
                                </span>
                            </a>
                        </li>
                        <li @if (Route::currentRouteName() === "admin.dashboard.category") class="active" @endif >
                            <a href="{{ route('admin.dashboard.category') }}">
                                <i class="icon-list "></i>
                                <span>Categorieën
                                </span>
                            </a>
                        </li>
                        <li class="subnavbar-open-right @if (Route::currentRouteName() === "admin.dashboard.post") active @endif ">
                            <a href="{{ route('admin.dashboard.post') }}">
                                <i class="icon-book"></i>
                                <span>Berichten
                                </span>
                            </a>
                        </li @if (Route::currentRouteName() === "admin.dashboard.page") class="active" @endif >
                        <li class="subnavbar-open-right">
                            <a href="{{ route('admin.dashboard.page') }}">
                                <i class="icon-book"></i>
                                <span>Paginas</span>
                            </a>
                        </li>
                        <li @if (Route::currentRouteName() === "admin.dashboard.social") class="active" @endif >
                            <a href="{{ route('admin.dashboard.social') }}">
                                <i class="icon-rocket"></i>
                                <span>Sociale media</span>
                            </a>
                        </li>
                        <li @if (Route::currentRouteName() === "admin.dashboard.candy") class="active" @endif >
                            <a href="{{ route('admin.dashboard.candy') }}">
                                <i class="icon-file"></i>
                                <span>Image Slider</span>
                            </a>
                        </li>
                        <li @if (Route::currentRouteName() === "admin.dashboard.mass") class="active" @endif >
                            <a href="{{ route('admin.dashboard.mass') }}">
                                <i class="icon-envelope"></i>
                                <span>Mass-email</span>
                            </a>
                        </li>
                        <li @if (strpos(Route::currentRouteName(), "admin.dashboard.widget") !== false) class="active" @endif >
                            <a href="{{ route('admin.dashboard.widget') }}">
                                <i class="icon-fire"></i>                               
                                <span>Widgets</span>
                            </a>
                        </li>
                        <li @if (Route::currentRouteName() === "admin.dashboard.bp") class="active" @endif class="dropdown subnavbar-open-right" >
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-long-arrow-down"></i>
                                <span>Backup</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="icons.html">Download</a>
                                </li>
                            </ul>
                        </li>
                        <li @if (Route::currentRouteName() === "admin.dashboard.user") class="active" @endif class="dropdown subnavbar-open-right" >
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user"></i>
                                <span>User</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('admin.user.logout') }}">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
@stop