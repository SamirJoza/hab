@if ($container_size == 'bg-default-width')
<{{ $tag }} id="{{ $block_id }}" class="{{ $block->classes }} bg-default-width container">
  <div class="innerblock-wrap">
    <InnerBlocks />
  </div>
</{{ $tag }}>
@elseif ($container_size == 'bg-full-width')
<{{ $tag }} id="{{ $block_id }}" class="{{ $block->classes }} bg-full-width">
  <div class="innerblock-wrap">
    <InnerBlocks />
  </div>
</{{ $tag }}>
@endif

<style>
  @if($container_size == 'bg-default-width')
    @if ($bg_image)
    #{{ $block_id }} > .innerblock-wrap {
      {{ $bg_image }}
      {{ $bg_color }}
      {{ $bg_style_desktop }}
    }
    @endif
    @if($bg_color)
    #{{ $block_id }} > .innerblock-wrap {
      {{ $bg_color }}
      {{ $bg_style_desktop }}
    }
    @endif
    @if ($bg_style_tablet)
    @media screen and (max-width: 991px){
      #{{ $block_id }} > .innerblock-wrap {
        {{ $bg_style_tablet }}
      }
    }
    @endif
    @if ($bg_style_mobile)
    @media screen and (max-width: 767px){
      #{{ $block_id }} > .innerblock-wrap {
        {{ $bg_style_mobile }}
      }
    }
    @endif
  @elseif ($container_size == 'bg-full-width')
    @if ($bg_image)
    #{{ $block_id }} {
      {{ $bg_image }}
      {{ $bg_style_desktop }}
    }
    @endif
     @if($bg_color)
      #{{ $block_id }} {
      {{ $bg_color }}
      {{ $bg_style_desktop }}
    }
    @endif
    @if ($bg_style_tablet)
    @media screen and (max-width: 991px){
      #{{ $block_id }} {
        {{ $bg_style_tablet }}
      }
    }
    @endif
    @if ($bg_style_mobile)
    @media screen and (max-width: 767px){
      #{{ $block_id }} {
        {{ $bg_style_mobile }}
      }
    }
    @endif
  @endif

  @if ($spacing_desktop || $max_width)
  #{{ $block_id }} > .innerblock-wrap {
    {{ $spacing_desktop }}
    {{ $max_width }}
  }
  @endif

  @if ($alignment_desktop)
    #{{ $block_id }} > .innerblock-wrap > * {
      text-align: {{ $alignment_desktop }};
      justify-content: {{ $alignment_desktop }};
    }
  @endif

  @if ($spacing_tablet || $alignment_tablet)
    @media screen and (max-width: 991px){
      @if ($spacing_tablet)
        #{{ $block_id }} > .innerblock-wrap {
          {{ $spacing_tablet }}
        }
      @endif
      @if ($alignment_tablet)
        #{{ $block_id }} > .innerblock-wrap > * {
          text-align: {{ $alignment_tablet }};
          justify-content: {{ $alignment_tablet }};
        }
      @endif
    }
  @endif

  @if ($spacing_mobile || $alignment_mobile)
    @media screen and (max-width: 767px){
      @if ($spacing_mobile)
        #{{ $block_id }} > .innerblock-wrap  {
          {{ $spacing_mobile }}
        }
      @endif
      @if($alignment_mobile)
        #{{ $block_id }} > .innerblock-wrap > * {
          text-align: {{ $alignment_mobile }};
          justify-content: {{ $alignment_mobile }};
        }
      @endif
    }
  @endif
</style>
