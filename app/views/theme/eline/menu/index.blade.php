@section('menu')
<header class="mod-landingPage">
<!-- menu -->
	<div class="container">
		<div class="row">
			<div class="col col-md-4">
				<div class="logo">
					<a href="{{{ route('public.index', array('lang' => \Lang::getLocale())) }}}"><img src="/assets/img/mod-lp-logo.png" title="Stichting Eline - De Cirkel is Rond"></a>
				</div>
			</div>
			<div class="col col-md-4">
				<div class="col col-md-6">
					<ul class="menu menu-vertical list-unstyled main-menu">
						<li><a href="">Over de stichting</a></li><li>
						<a href="">Voor donateurs</a></li><li>
						<a href="">Voor vrijwilligers</a></li>
					</ul>
				</div>
				<div class="col col-md-6">
					<ul class="menu menu-vertical list-unstyled main-menu">
						<li><a href="">Nieuws</a></li><li>
						<a href="">Contact</a></li>
					</ul>
				</div>
			</div>
			<div class="col col-md-4">
				<ul class="menu menu-vertical">
					<div class="row lp-btn-panel">
						<div class="col col-md-12">
							<?php $donateUrl = \DonateButtonLocalizer::getCurrentLangUrl(); ?>
							@if ($donateUrl)
								<a class="btn btn-success" href="{{{ $donateUrl }}}"><i class="fa fa-heart"></i>Doneer</a>
							@else
								<p>Currently there's no donate campaign for this country.</p>
							@endif
							<div class="btn-group">
							  <button type="button" class="btn btn-warning"><i class="fa fa-globe"></i>{{{ \Cache::get('locale.language')->language }}}</button>
							  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
							    <span class="caret"></span>
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="langaugeMenu" role="menu">
							    @foreach (Language::whereNull('deleted_at')->get() as $item)
							    	<li><a href="{{ route('public.index', $item->abbreviation) }}">{{ $item->language }}</a></li>
							    @endforeach
							  </ul>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col col-md-12">
							<form class="form-inline search" role="search">
	                <div class="form-group">
	                    <input type="text" class="form-control" placeholder="Zoeken...">
	                </div>
	                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
	            </form>
						</div>
					</div>
				</ul>
			</div>
		</div>
	</div>
</header>
<!-- end menu -->
@stop