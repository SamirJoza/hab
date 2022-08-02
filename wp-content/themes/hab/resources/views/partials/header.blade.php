<header id="masthead" class="site-header" style="background-image: url(@if($featuredImage) {!! $featuredImage !!} @endif)">
<div class="headerInner">
@include('partials.header-nav')
<div class="container title-container">
  <h1 class="text-white">@php(the_title())</h1>
</div>
</div> 
</header>