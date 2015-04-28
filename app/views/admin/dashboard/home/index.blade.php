@extends('admin.dashboard._layout')
@include('admin._alert')
@section('content')
    <div class="main">
      <div class="main-inner">
        <div class="container">
          <div class="row">
            <div class="span12">
            @yield('error')
            @yield('warning')
            @yield('success')
            @yield('info')
              <div class="widget">
                <div class="widget-header"> <i class="icon-bookmark"></i>
                  <h3>Important Shortcuts</h3>
                </div>
                <div class="widget-content">
                  <div class="shortcuts">
                    <a href="javascript:;" class="shortcut">
                    <i class="shortcut-icon icon-signal"></i> 
                    <span class="shortcut-label">Google analistics</span> 
                  </a> 
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop