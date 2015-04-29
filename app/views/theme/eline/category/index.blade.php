@section('content')
<section class="mod-slogan">
	<div class="container">
		<div class="row">
			<div class="col col-md-12">
				<span>{{{ $category->description }}}</span>
			</div>
		</div>
	</div>
</section>

<section class="mod-content">
	<div class="container">
		<div class="row">
			<div class="col col-md-9">
				<h2>{{{ $category->title }}}</h2>
						@if( count($category->posts()) >= 1 )
							@foreach($category->posts()->where('posts.deleted_at', '=', null)->get() as $post)
							<div class="search-result">
								<figure class="col col-md-2">
									@if( ! is_null($post->getCandy()) )
										<img class="preview-image" src="{{{ $post->getCandy()->url or '#' }}}" alt="{{{ $post->getCandy()->name }}}">
									@endif
								</figure>
											<article class="post col col-md-9">
												<header>{{{ $post->title }}}</header>
												<p>{{ $post->contentChunk(400) }}</p>
											</article>
								<footer class="clearfix">
									<a href="{{{ $post->postUrl() }}}" class="btn btn-info"><i class="fa fa-chevron-right"></i>Lees meer</a>
								</footer>
							</div>
							@endforeach
						@else
							<p>Sorry, there are currently no posts in this category.</p>
						@endif
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
								$currentCategoryTitle = $category->category;
							?>
							@foreach ($category->getLanguageSiblingCategories() as $category)
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
								<h2><img src="{{{ URL::asset('assets/img/nw-widget.jpg') }}}" alt="">Abonner u op de nieuwsberichten</h2>
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