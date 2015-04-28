@extends('admin.dashboard._content_table-free')
@include('admin._alert')
@section('list-content')
    @yield('error')
    @yield('warning')
    @yield('success')
    @yield('info')
	<div class="table-responsive">
		@if (Widget::first())
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>@lang('widget/widget_page.widget')</th>
						<th>@lang('widget/widget_page.description')</th>
						<th>@lang('widget/widget_page.installed-by')</th>
						<th>@lang('widget/widget_page.action')</th>
					</tr>
				</thead>
				<tbody>
				@foreach (Widget::all() as $widget)
					<tr>						
						<td>{{ $widget->title }}</td>
						<td>{{ $widget->description }}</td>
						<td>{{ $widget->user()->get()->first()->firstname }} {{ $widget->user()->get()->first()->lastname }}</td>
						<td>
							<div class="btn-group">
								<a class="btn btn-warning" href="{{ route('admin.dashboard.widget.show', $widget->id) }}">
									<i class="icon-edit"> </i>@lang('widget/widget_page.update')
								</a>		
								{{-- <a class="btn btn-info" href="{{ route('admin.dashboard.reset', $widget->id) }}">
									<i class="icon-rotate"> </i>@lang('widget/widget_page.reinstall')
								</a> --}}
								<a class="btn btn-danger" href="{{ route('admin.dashboard.widget.destroy', $widget->id) }}">
									<i class="icon-remove"> </i>@lang('widget/widget_page.uninstall')
								</a>			
							</div>		
						</td>		
					</tr>
				@endforeach
				</tbody>
			</table>
		@else
			  <?php Notifier::putInfo(Lang::get('widget/widget_page.no-widgets-found')); ?>
			@yield('admin._alert.info')
		@endif
	</div>
@stop