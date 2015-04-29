@section('content')
	<section class="mod-slogan">
		<div class="container">
			<div class="row">
				<div class="col col-md-12">
					<span>De cirkel is rond, maar wij willen die laten groeien.</span>
				</div>
			</div>
		</div>
	</section>
	<section class="mod-post">
		<div class="container">
			<div class="row">
				<div class="col col-md-9">
					<?php 
						$category = $post->categories()->first();
					 ?>
					<a href="{{{ route('public.category', array('id' => $category->id, 'lang' => \Lang::getLocale(), 'title' => dash_encode($category->category))) }}}">terug naar {{{ $category->category or "Title" }}}</a>
					<article>
						<header>
							<h1>{{{ $post->title }}}</h1>
						</header>
						<span class="date"><i class="fa fa-calendar"></i> {{{ $post->created_at }}}</span>
<!-- 						<figure>
							<img src="../assets/img/post-image-1.jpg" alt="Kunstveiling Cultuurhuis Schagen" title="Kunstveiling Cultuurhuis Schagen">
						</figure> -->
						{{ $post->post }}
					</article>
					<section class="teasers">
						<div class="row">
							<div class="col col-md-6">
								<section>
									<header>
										<h3>Relevante nieuwsberichten</h3>
									</header>
									<ul>
									<?php 
									/*---------------------------------------------------------
									| Variable Declaration
									|---------------------------------------------------------*/
										$posts = $post->latestCategorySiblings(4);
									?>
									@if ( ! is_null($posts))
										@foreach($posts as $post)
											<li><a href="{{ route('public.post', array('lang' => \Lang::getLocale(), 'id' => $post->id, 'title' => dash_encode($post->title))) }}">{{{ $post->title }}}</a></li>
										@endforeach
									@else
										<p>geen</p>
									@endif
									</ul>
								</section>
							</div>
							<!-- <div class="col col-md-6">
								<section>
									<header>
										<h3><i class="fa fa-tags"></i> Zoekwoorden</h3>
									</header>
									<ul>
										<li><a href="" rel="tag">kunstveiling</a>,</li>
										<li><a href="" rel="tag">550 jaar marktrechten</a>,</li>
										<li><a href="" rel="tag">chinese vrijwilligers</a>,</li>
										<li><a href="" rel="tag">nieuwe website</a>,</li>
										<li><a href="" rel="tag">schagen</a></li>
									</ul>
								</section>
							</div> -->
						</div>
					</section>
				</div>

					<div class="col col-md-3">
				<div class="row widgets">
					<div class="col col-md-12">
						<section>
						<header>
							<h2><i class="fa fa-inbox"></i>Categorieën</h2>
							</header>
							<ul class="list-unstyled">
							<?php 
								$currentCategoryTitle = $post->categories()->first()->category;
							?>
							@foreach ($post->categories()->first()->getLanguageSiblingCategories() as $category)
								<li><a href="{{{ $category->getCategoryPageUrl() }}}">@if($currentCategoryTitle === $category->category) <i class="fa fa-caret-right"></i> @endif{{{ $category->category }}}</a></li>
							@endforeach
							</ul>
						</section>
					</div>
				</div>

					<div class="row widgets newsletter">
						<div class="col col-md-12">
							<section>
								<header class="clearfix">
									<h2><img src="../assets/img/nw-widget.jpg" alt="">Abonner u op de nieuwsberichten</h2>
								</header>
								<form class="form-horizontal" role="form">
								  <div class="form-group">
								    <div class="col-sm-12">
								      <input type="text" class="form-control" id="inputEmail3" placeholder="Uw naam">
								    </div>
								  </div>
								  <div class="form-group">
								    <div class="col-sm-12">
								      <input type="text" class="form-control" id="inputPassword3" placeholder="Uw email">
								    </div>
								  </div>
								  <div class="form-group">
								    <div class="col-sm-12 right">
								      <button type="submit" class="btn btn-subscribe"><i class="fa fa-check"></i>Abonneer</button>
								    </div>
								  </div>
								</form>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@stop