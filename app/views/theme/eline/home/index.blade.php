@include('theme.eline.widgets.newsWidget')
@section('content')
<section class="mod-main-slider clearfix">
	<ul class="list-unstyled">
		<li class="slide"><img src="/assets/img/slide-1.jpg"></li>
	</ul>
	<div class="col col-md-4 col-md-offset-7">
		<ul class="list-unstyled articles">
			<!-- The newest posts, no matter what category. -->
			<?php 
				$newestContent = NewsLocalizer::getLatestNewsEntries(\Cache::get('locale.language')->language);
				$langAbbr = \Lang::getLocale();
			 ?>
			@if($newestContent)
				@foreach ($newestContent as $post)
				<li class="clearfix article">
					<a class="clearfix" href="{{{ $post->postUrl() }}}">
						<div>
							@if( ! is_null($post->getCandy()) )
								<img src="{{{ $post->getCandy()->url or '#' }}}" alt="{{{ $post->getCandy()->name }}}">
							@endif
							<h3>{{ $post->title }}</h3>
							<p>{{ Verse::equals($post->post)->stripTags()->first(85)->append('...')->get() }}</p>
						</div>
					</a>
				</li>
				@endforeach
			@else
				<li class="clearfix article"><p> @lang('widget/news_localizer/index.no-posts-available') </p></li>
			@endif
		</ul>
	</div>
</section>

<section class="mod-subscribe-newsletter">
	<div class="container">
		<div class="row">
		@if (is_null(\EmailSubscriptionLocalizer::getCurrentLangInputCode()))
			<div class="col-md-10 col-md-offset-1">
				<h2>@lang('widget/email_subscription_localizer/index.not-configured-yet')</h2>
			</div>
		@else
			<div class="col col-md-8 col-md-offset-1">
				<h2>Abonneer u op de nieuwsbrieven</h2>
				<form class="form-horizontal clearfix form-subscribe" action="{{{ \EmailSubscriptionLocalizer::getCurrentLangUrl() }}}" role="form">
					<div class="col col-md-9">
					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-3 control-label">Uw naam:</label>
					    <div class="col-sm-9">
					      <input type="name" class="form-control" id="inputEmail3" name="cm-name" placeholder="Naam">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-3 control-label">Uw email:</label>
					    <div class="col-sm-9">
					      <input type="email" class="form-control" id="inputPassword3" name="cm-{{{\EmailSubscriptionLocalizer::getCurrentLangInputCode()}}}-{{{\EmailSubscriptionLocalizer::getCurrentLangInputCode()}}}" placeholder="Email">
					    </div>
					  </div>
					</div>
				  <div class="col col-md-3">
				  	<div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-default btn-subscribe"><i class="fa fa-check"></i>Abonneer</button>
					    </div>
					  </div>
				  </div>
				</form>
			</div>
		@endif
		</div>
	</div>
</section>

<section class="mod-content">
	<div class="container">
		<div class="row">
			@yield('newsWidget')
			<div class="col col-md-6">
				<h2>Evenementen <a href="">bekijk alles >></a></h2>
				<article class="post clearfix">
					<figure>
						<img src="/assets/img/events-1.png" title="Oost ontmoet West">
					</figure>
					<div class="social-media">
						<a href="">
							<img src="/assets/img/twitter-icon.png" alt="Twitter" title="Volg ons op Twitter">
						</a>
						<a href="">
							<img class="middle-icon" src="/assets/img/facebook-icon.png" alt="Twitter" title="Like ons op Facebook">
						</a>
						<a href="">
							<img src="/assets/img/googleplus-icon.png" alt="Twitter" title="Voeg ons toe op Google+">
						</a>
					</div>
					<header>Oost ontmoet West</header>
					<p>Benefietconcert met een verrassende mix van klassieke Chinese muziek en Westerse (koor-) muziek. </p>
				</article>
				<footer>
					<button class="btn btn-info"><i class="fa fa-chevron-right"></i>Lees meer</button>
				</footer>

				<article class="post clearfix">
					<figure>
						<img src="/assets/img/events-2.png" title=""Daughters' Return & Sofia's Journey"">
					</figure>
					<div class="social-media">
						<a href="">
							<img src="/assets/img/twitter-icon.png" alt="Twitter" title="Volg ons op Twitter">
						</a>
						<a href="">
							<img class="middle-icon" src="/assets/img/facebook-icon.png" alt="Twitter" title="Like ons op Facebook">
						</a>
						<a href="">
							<img src="/assets/img/googleplus-icon.png" alt="Twitter" title="Voeg ons toe op Google+">
						</a>
					</div>
					<header>"Daughters' Return & Sofia's Journey"</header>
					<p>Dr. Changfu Chang, de "professor of adoption films", presenteert zijn nieuwste documentaires: "Sofia's Jo
urney" en "Daughters' Return". Deze documentaires vertellen de geschiedenis van drie uit China...</p>
				</article>
				<footer>
					<button class="btn btn-info"><i class="fa fa-chevron-right"></i>Lees meer</button>
				</footer>


				<article class="post clearfix">
					<figure>
						<img src="/assets/img/events-3.png" title=""Oost ontmoet West": 
Verschillen en overeenkomsten tussen 
de Chinese en Westerse cultuur">
					</figure>
					<div class="social-media">
						<a href="">
							<img src="/assets/img/twitter-icon.png" alt="Twitter" title="Volg ons op Twitter">
						</a>
						<a href="">
							<img class="middle-icon" src="/assets/img/facebook-icon.png" alt="Twitter" title="Like ons op Facebook">
						</a>
						<a href="">
							<img src="/assets/img/googleplus-icon.png" alt="Twitter" title="Voeg ons toe op Google+">
						</a>
					</div>
					<header>"Oost ontmoet West": 
Verschillen en overeenkomsten tussen 
de Chinese en Westerse cultuur</header>
					<p>Lulu Wang geeft op haar eigen humoristische wijze de verschillen weer tussen China en Nederland. Aan bod zullen komen aspecten met betrekking tot godsdienst, geschiedenis, politiek, integratie, economie en filosofie. ..</p>
				</article>
				<footer>
					<button class="btn btn-info"><i class="fa fa-chevron-right"></i>Lees meer</button>
				</footer>
			</div>
		</div>
	</div>
</section>

<section class="mod-sponsors">
	<div class="container">
		<div class="row">
			<div class="col col-md-11 col-md-offset-1">
				<h2>Onze sponsors <a href="">sponsor worden >></a></h2>
				<div class="logo-frame">
					<ul class="list-unstyled logo-list">
						<li><a href="#"><img src="/assets/img/logos/mechanic.png"></a></li>
						<li><a href="#"><img src="/assets/img/logos/dura-cloud.png"></a></li>
						<li><a href="#"><img src="/assets/img/logos/fedora.png"></a></li>
						<li><a href="#"><img src="/assets/img/logos/sun.png"></a></li>
						<li><a href="#"><img src="/assets/img/logos/reverb.png"></a></li>
						<li><a href="#"><img src="/assets/img/logos/wikia.png"></a></li>
						<li><a href="#"><img src="/assets/img/logos/dura-cloud.png"></a></li>
						<li><a href="#"><img src="/assets/img/logos/fedora.png"></a></li>
						<li><a href="#"><img src="/assets/img/logos/sun.png"></a></li>
						<li><a href="#"><img src="/assets/img/logos/reverb.png"></a></li>
						<li><a href="#"><img src="/assets/img/logos/wikia.png"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="mod-content last">
	<div class="container">
		<div class="row">
			<div class="col col-md-12">
				<h2>Filmpjes <a href="">bekijk alles >></a></h2>
				<div class="col col-md-3">
					<article class="media">
						<header>Spoorloos</header>
						<span class="span-date">maandag 29 januari 2007</span>
						<a href="http://spoorloos.kro.nl/seizoenen/43/afleveringen/29-01-2007"><img src="/assets/img/spoorloos-1.jpg"></a>
						<p>Voor de De 10-jarige Eline werd op de Chinese televisie een oproep uitgezonden om haar biologische ouders te vinden. Een Chinees echtpaar meldt zich. Maar zijn dit de biologische ouders van Eline?</p>
					</article>
				</div>
				<div class="col col-md-3">
					<article class="media">
						<header>Spoorloos</header>
						<span class="span-date">maandag 24 september 2007</span>
						<a href="http://spoorloos.kro.nl/seizoenen/seizoen_45_2007/afleveringen/24-09-2007"><img src="/assets/img/spoorloos-2.jpg"></a>
						<p>Voor het eerst in de geschiedenis van Spoorloos gaan we samen met een tienjarig meisje op zoek zijn gegaan naar haar biologische ouders...</p>
					</article>
				</div>
				<div class="col col-md-3">
					<article class="media">
						<header>Spoorloos</header>
						<span class="span-date">maandag 1 oktober 2007</span>
						<a href="http://spoorloos.kro.nl/seizoenen/seizoen_45_2007/afleveringen/01-10-2007"><img src="/assets/img/spoorloos-3.jpg"></a>
						<p>Wat gebeurde er allemaal ná de ontmoeting die Eline had met haar Chinese ouders?</p>
					</article>
				</div>
				<div class="col col-md-3">
					<article class="media">
						<header>Spoorloos</header>
						<span class="span-date">maandag 11 juli 2011</span>
						<a href="http://spoorloos.kro.nl/seizoenen/57/afleveringen/11-07-2011/"><img src="/assets/img/spoorloos-4.jpg"></a>
						<p>Hoe wist Eline contact te houden met haar biologische ouders? Vier jaar geleden werden zij door Spoorloos herenigd. Wat is er in de tussentijd gebeurd?</p>
					</article>
				</div>
			</div>
		</section>
@stop