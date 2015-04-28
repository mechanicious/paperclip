@extends('admin.dashboard._layout')
@include('admin.dashboard._table')
@section('content')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        @yield('table')
                        <div class="widget">
                            <div class="widget-header">
                                <h3>{{{ $localeTitle or "Title" }}}</h3>
                            </div>
                            <div class="widget-content">
                                <div class="tabbable">
                                    <br>
                                    <div class="tab-content">
                                         @yield('form')
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