<section class="container-fluid bg-black">
  <div class="row">
    @foreach($newsitems->all() as $news_item)
    <div class="col-lg-4 news-item">
      <div class="news-image">
        <img src="{!! $news_item->image !!}" alt="{!! $news_item->title !!}" class="lozad">
      </div>
      <h4 class="text-uppercase text-brand-3 mt-4">{!! $news_item->title !!}</h4>
      <p class="text-white fs-6">{!! $news_item->excerpt !!}</p>
      @if($news_item->linkto)
        {!! $news_item->linkto !!}
      @endif
    </div>
    @endforeach
  </div>
</section>