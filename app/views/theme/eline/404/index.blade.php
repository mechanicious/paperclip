@section('content')
<section class="mod-slogan">
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-1 col-md-2">
        <h1><i class="fa fa-meh-o" style="font-size: 72px;"></i></h1>
      </div>
      <div class="col col-md-6">
        <h2>@lang('pageErrors.404-title')</h2>
        <p>@lang('pageErrors.404-description', array('link' => 
          HTML::link(route('public.index', array('lang' => $langAbbr)), 
          trans('commonItems.home-page'))))</p>
      </div>
    </div>
  </div>
</section>
@stop