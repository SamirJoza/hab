<div class="{{ $block->classes }} banner-full" >
  <div class="background-container" style="{{ $style }}">
    <img src="{{$bgimg}}" alt="" width="0" height="0" style="display: none !important;" />
  </div>
  <div class="banner-content container-fluid content-max">
    <div class="row">
      <div class="col-12 col-lg-6 banner-content-col">
        @if ($h1)
            <h1 @if($title_max) style="max-width: {{ $title_max }}px;" @endif>{!! $h1 !!}</h1>
        @endif

        @if ($desc)
            <p class="lead" @if($desc_max) style="max-width: {{ $desc_max }}px;" @endif>{!! $desc !!}</p>
        @endif
      </div>
    </div>
  </div>
</div>
