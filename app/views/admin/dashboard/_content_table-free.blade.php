@extends('admin.dashboard._layout')
@section('content')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-header">
                                <h3>{{{ $localeTitle or "Title" }}}</h3>
                            </div>
                            <div class="widget-content">
                                <div class="tabbable">
                                    <br>
                                    <div class="tab-content">
                                         @yield('form')
                                         @yield('list-content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop