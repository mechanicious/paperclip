@section('newsWidget')
      <!-- News Widget-->
      <?php
        $lang           = \Cache::get('locale.language');
        $langAbbr       = \Cache::get('locale.abbr');
        $newsCategoryId = \NewsLocalizer::getCategory($lang->language);
        if(! is_null($newsCategoryId)) {
          $categoryTitle  = \NewsLocalizer::getCategory($lang->language)->category;
          $categoryLink   = route('public.category', array('id' => NewsLocalizer::getCategoryId($lang->language), 'title' => dash_encode($categoryTitle), 'lang' => $langAbbr));
          $entries        = \NewsLocalizer::getLatestNewsEntries($lang->language);
          $postLink       = function ($post) use($langAbbr) {
            return route('public.post', array('lang' => $langAbbr, 'id' => $post->id, 'title' => dash_encode($post->title)));
          };
          $postContent    = function ($post) {
            return Verse::equals($post->post)->stripTags()->first(\NewsLocalizer::getPostChunkSize())->append('...')->get();
          };
        }
      ?>
      <div class="col col-md-6">
        @if( ! is_null($newsCategoryId) )
            <h2>{{{ $categoryTitle }}} <a href="{{ $categoryLink }}">bekijk alles >></a></h2>
            @if ($entries)
              @foreach ($entries as $post)
                <article class="post">
                <header>{{{ $post->title }}}</header>
                <p>{{{ $postContent($post) }}}</p>
                </article>
                <footer>
                  <a class="btn btn-info" href="{{ $postLink($post) }}"><i class="fa fa-chevron-right"></i>Lees meer</a>
                </footer>
              @endforeach
            @else
              <p>@lang('widget/news_localizer/index.no-posts-available')</p>
            @endif
        @else
            <p>@lang('widget/news_localizer/index.category-not-available')</p>
        @endif
      </div>
@stop