<div class="{{ $block->classes }}">
  @if ($hasData)
    <div class="row row-cols-1 {!! $cols !!} g-0 g-sm-0 g-lg-6 d-flex justify-content-center">
      @foreach ($data->all() as $resource)
        <div class="col">
          <div class="card h-100 pt-5 pt-sm-2 pt-lg-0">
            <img src="{!! $resource->resource_image !!}" class="card-img-top" alt="{!! $resource->title !!}">
            <div class="card-body text-white">
              <h5 class="card-title text-brand-3">{!! $resource->title !!}</h5>
              <p>{!! $resource->summary !!}</p>
            </div>
            <div class="card-footer">
              {!! $resource->link !!}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <p>No Resources found!</p>
  @endif
</div>
