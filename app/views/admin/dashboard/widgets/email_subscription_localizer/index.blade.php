@extends('admin.dashboard._content_table-free')
@include('admin._alert')
@section('form')
    {{-- Update --}}
    <form action="{{ route('admin.dashboard.widget.update', $id) }}" class='form-horizontal' method='post'>
      @yield('error')
      @yield('warning')
      @yield('success')
      @yield('info')
      <fieldset>
      <!-- Form Name -->
      <legend>@lang('widget/email_subscription_localizer/index.widget-title')</legend>
      @foreach (\Language::all() as $language)
        <!-- Select Basic -->
        <div class="control-group">
            <div class="controls">
              <fieldset>
                <h4>{{{ $language->language }}}</h4>
                <input type="url" name="{{{ $language->language }}}" value="{{{ \EmailSubscriptionLocalizer::getUrlWithLang($language->language) }}}" placeholder="http://...">
              </fieldset>
            </div>
        </div>
      @endforeach
        <div class='form-actions'>
          <button class='btn btn-primary' type='submit'>@lang('widget/email_subscription_localizer/index.submit')</button>
          <button class='btn' type='reset'>@lang('widget/email_subscription_localizer/index.reset')</button>
        </div><!-- /form-actions -->
  </form>
@stop