@if($slides)
<div class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="7000">
  <div class="carousel-inner text-white text-uppercase text-md-end h-100 pb-3 pb-lg-5">
    {!! $slides !!}
  </div>
</div>
<script>
function normalizeSlideHeights() {
    jQuery('.carousel').each(function(){
      var items = jQuery('.carousel-item', this);
      // reset the height
      items.css('min-height', 0);
      // set the height
      var maxHeight = Math.max.apply(null, 
          items.map(function(){
              return jQuery(this).outerHeight()}).get() );
      items.css('min-height', maxHeight + 'px');
    })
}

jQuery(window).on(
    'load resize orientationchange', 
    normalizeSlideHeights);
</script>
@endif