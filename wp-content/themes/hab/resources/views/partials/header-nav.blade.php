  <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center align-items-start w-100">
    <div class="container py-0 my-0">
      <a class="navbar-brand d-flex w-50 me-auto text-center" href="{{ home_url('/') }}">
        @if($headerLogo)
          <img src="{!! $headerLogo !!}" alt="{{ $siteName }}" class="img-fluid lozad">
        @else
          {{ $siteName }}
        @endif
      </a>
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainnav">
        <i class="fas fa-bars"></i>
      </button>
      <div class="navbar-collapse collapse w-100" id="mainnav">
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'navbar-nav ms-auto w-100 justify-content-end', 'echo' => false]) !!}
        @endif
      </div>
    </div>
  </nav>