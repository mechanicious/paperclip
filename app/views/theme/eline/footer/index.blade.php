@section('footer')
	<footer>
		<div class="container">
			<div class="row">
				<div class="col col-md-4">
					<section class="widget-more">
						<header>Meer...</header>
						<ul class="list-unstyled">
						<?php $categories = \Category::whereLangId(\Cache::get('locale.language')->id)->get(); ?>
						@if (count($categories) < 1)
							<p>Sorry, there are currenly no categories in this language, please try again later.</p>
						@else
							@foreach (\Category::whereLangId(\Cache::get('locale.language')->id)->get() as $category)
								<li>
									<a href="{{{ route('public.category', array('id' => $category->id, 'title' => dash_encode($category->category), 'lang' => \Cache::get('locale.abbr'))) }}}">{{{ $category->category }}}</a>
								</li>
							@endforeach
						@endif
						</ul>
					</section>
				</div>
				<div class="col col-md-3">
					<section class="widget-contact-info">
						<header>Stichting</header>
						<p>Stichting Eline - De Cirkel is Rond<br/>
							Iepenlaan 129<br/>
							1741 TD  SCHAGEN</p>
						<p><i class="fa fa-phone"> </i> 0224-298532</p>
						<p>Lid van het gemeentelijk Platform Grenzenloos Schagen</p>
						<p>©2012 Stichting Eline - De Cirkel is Rond. All rights reserved</p>
						<div class="social-media">
							<a href="">
								<img src="/assets/img/social-icon-dark-twitter.png" alt="Twitter" title="Volg ons op Twitter">
							</a>
							<a href="">
								<img src="/assets/img/social-icon-dark-facebook.png" alt="Twitter" title="Like ons op Facebook" style="">
							</a>
							<a href="">
								<img src="/assets/img/social-icon-dark-gplus.png" alt="Twitter" title="Voeg ons toe op Google+">
							</a>
						</div>
					</section>
				</div>
				<div class="col col-md-4 col-md-offset-1">
					<section class="widget-contact-form">
						<header>Contact formulier</header>
						<form role="form">
						  <div class="form-group">
						    <input type="text" class="form-control" min-length="2" placeholder="Uw naam" data-validation="name">
						    <span class="state state-valid"><i class="fa fa-check"></i></span>
						    <span class="state state-unvalid"><i class="fa fa-times"></i></span>
						  </div>
						  <div class="form-group">
						    <input type="email" class="form-control" placeholder="Uw email" data-validation="email">
						    <span class="state state-valid"><i class="fa fa-check"></i></span>
						    <span class="state state-unvalid"><i class="fa fa-times"></i></span>
						  </div>
						  <div class="form-group">
						  	<textarea name="" id="" style="width: 100%;" rows="7" placeholder="Uw bericht..."></textarea>
						  	</div>
						  <button type="submit" class="btn btn-default" data-validation="submit">Verstuur</button>
						</form>
					</section>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-2">
					<p style="margin-top: 40px;">&copy; 2015-2016 Graphics and Software Design and construction proudly donated by Mateusz Zawartka to the Eline Foundation.</p>
				</div>
			</div>
		</div>
	</footer>
@stop