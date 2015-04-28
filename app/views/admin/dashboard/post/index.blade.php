@extends('admin.dashboard._content')
@include('admin._alert')
@section('form')
	@if (is_null(Session::get('input.id')))
        {{-- Store --}}
        <form action="{{ route('admin.dashboard.post.store') }}" class='form-horizontal' method='post'>
    @else
        {{-- Update --}}
        <form action="{{ route('admin.dashboard.post.update', Session::get('input.id')) }}" class='form-horizontal' method='post' autocomplete="off">
    @endif
    	@yield('error')
        @yield('warning')
        @yield('success')
        @yield('info')
		<fieldset>
			<div class='control-group'>
				
				<!-- Title -->
				<label class='control-label' for='title'>Titel</label>
				<div class='controls'>
					<input class='span9' id='title' name='title' type='text' value='{{ Session::get('input.title') }}' required autofocus>
				</div><br/>
				
				<!-- URL Preview -->
				<div class='controls'>
					<input class='span9 disabled' disabled id='url' type='text' value="http://stichting-eline.org/nl/posts/terugblik-op-2012">
				</div><br/>
				
				<!-- Post -->
				<label class='control-label' for='post'>Inhoud</label>
				<div class='controls clearfix'>
					<div class="span9" style="margin-left: 0px;">
						<textarea class='ckeditor' cols='58' id='post' name='post' rows='10' style='margin: 0px; width: 576px; height: 204px; overflow: hidden;'>{{ Session::get('input.post') }}</textarea>
					</div>
				</div><br/>
				
				<!-- Language -->
				<!-- <label class='control-label' for='language'>Taal</label>
				<div class="controls">
					<input type="text" id="language" disabled>
				</div><br/> -->

				<!-- Thumbnail -->
				<label class="control-label" for="candy_id">Thumbnail</label>
				<div class="controls">
					<select id="candy" name="candy_id" disabled>
						@foreach (Candy::all() as $candy)
							<option value="{{ $candy->id }}" data-img-src="{{ $candy->url }}">{{ $candy->name }}</option>
						@endforeach
					</select>
					<button type="button" id="candy-switch" class="btn btn-md btn-block btn-warning"><i class="icon-picture"> </i><span> ON</span></button>
						<!-- Button trigger modal -->
					  <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Launch demo modal</a>

					  <!-- Modal -->
					  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					    <div class="modal-dialog">
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					          <h4 class="modal-title">Modal title</h4>
					        </div>
					        <div class="modal-body">
					          <h1>Gamma Gallery<span>A responsive image gallery experiment</span></h1>
											<div class="support-note">
												<span class="note-ie">Sorry, only modern browsers.</span>
											</div>
										</header>
							
										<div class="gamma-container gamma-loading" id="gamma-container">
											<ul class="gamma-gallery"></ul>
											<div class="gamma-overlay"></div>
											<div id="loadmore" class="loadmore">+ More</div>
										</div>
										<!-- More images JS loader -->
										<script type="text/javascript">
											$(document).ready(function() {
												var GammaSettings = {
														// order is important!
														viewport : [ {
															width : 1200,
															columns : 5
														}, {
															width : 900,
															columns : 4
														}, {
															width : 500,
															columns : 3
														}, { 
															width : 320,
															columns : 2
														}, { 
															width : 0,
															columns : 2
														} ]
												};

												Gamma.init( GammaSettings, fncallback );


												// Example how to add more items (just a dummy):
												function fncallback() {
													$('#loadmore').show().on('click', function() {
														var candyCount = $('.gamma-gallery').length, amount = 20;
														$.get('/api/secret/dashboard/candies/' + candyCount + '/' + amount, function(data) {
																var candies = JSON.parse(data);
																if(candies.length == 0) return $('#loadmore').hide();
																candyCount += candies.length;
																candies = htmlifyCandies(candies);
																Gamma.add($.parseHTML( candies.join('') ));
														});
													});
												}

													function htmlifyCandies(candies) {
														var counter = 0, parsedCandies = [];
														candies.forEach(function(candy) {
															parsedCandies.push(
															'<li>'
																+'<div data-alt="img'+ counter +'" data-description="'+ candy.name +'" data-max-width="1800" data-max-height="1350">'
																	+'<div data-src="'+ candy.url +'" data-min-width="300"></div>'
																	+'<noscript>'
																	+'<img src="'+ candy.url +'" alt="img'+ counter +'"/>'
																	+'</noscript>'
																+'</div>'
															+'</li>');
														});
														return parsedCandies;
													}
											});
										</script>	
					        </div>
					        <div class="modal-footer">
					          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					          <button type="button" class="btn btn-primary">Save changes</button>
					        </div>
					      </div><!-- /.modal-content -->
					    </div><!-- /.modal-dialog -->
					  </div><!-- /.modal -->
						<script>
						$('#candy-switch').toggle(
							function() {
								$('#candy').removeAttr('disabled');
								$(this).find('span').text('OFF');
							},
							function() {
								$('#candy').attr('disabled', '');
								$(this).find('span').text('ON');
							});
					</script>
				</div><br/>
				
				<!-- Category -->
				<label class='control-label'>Categorieën</label>
				<div class='controls'>
					@foreach (Category::all() as $category)
						<input name='category_id' type='radio' value='{{ $category->id }}' required
						{{ PostVH::checkInputOnCategoryMatch(Session::get('input.id'), $category->id) }}> <span class="label label-default">{{ $category->category }} [{{ $category->language->language }}]</span>
					@endforeach
				</div><br/>
				<input type="hidden" name="id" value="{{ Session::get('input.id') }}">
				
				<!-- Keywords -->
				<!-- <label class='control-label' for='tags'>Zoekwoorden</label>
				<div class='controls'>
					<input class='tm-input' id='tags' name='tags' placeholder='zoekwoord' type='text'>
				</div> -->

			</div>
		</fieldset>

		<!-- Controls -->
		<div class='form-actions'>
			<button class='btn btn-primary' type='submit'>Bevestigen</button>
			<button class='btn' type='reset'>Reset</button>
		</div>
	</form>

	{{-- We use the image picker for the select. --}}
	{{ HTML::script('/assets/admin/gammagallery/js/jquery.masonry.min.js') }}
	{{ HTML::script('/assets/admin/gammagallery/js/jquery.history.js') }}
	{{ HTML::script('/assets/admin/gammagallery/js/js-url.min.js') }}
	{{ HTML::script('/assets/admin/gammagallery/js/jquerypp.custom.js') }}
	{{ HTML::script('/assets/admin/gammagallery/js/gamma.js') }}
@stop