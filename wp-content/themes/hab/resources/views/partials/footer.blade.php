<footer class="content-info page-footer bg-brand-4 text-white mt-auto">
  <div class="container">
    <div class="row justify-content-evenly mb-5">
      <div class="col-lg text-center text-lg-start mb-2 mb-lg-0 align-self-center">
        @if($footerLogo)
          <a href="/" title=""><img src="{!! $footerLogo !!}" alt="" class="img-fluid lozad"></a>
        @endif
      </div>
      <div class="col-lg text-center text-lg-start mb-4 mb-lg-0 align-self-center">
        @if($address)
          <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
            {!! $address !!}
          </div>
        @endif
      </div>
      <div class="col-lg-4 align-self-center text-center text-lg-end">
        @if (has_nav_menu('footer_navigation'))
          {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'w-100 justify-content-end', 'echo' => false]) !!}
        @endif
      </div>
      <div class="col-sm-6 col-lg-3 text-sm-start text-center text-lg-end mt-5 mt-lg-0 align-self-center">
        @if($footerButton)
          {!! $footerButton !!}
        @endif
      </div>
      <div class="col align-self-center text-center text-sm-end">
        @if($socials)
          {!! $socials !!}
        @endif
      </div>
    </div>
    <div class="row justify-content-evenly text-white">
      <div class="col-md">
        <p class="fs-7">Copyright &copy; @php echo date('Y'); @endphp {!! $siteName !!}. All Rights Reserved.</p>
      </div>
      <div class="col-md text-md-end">
        <p class="fs-7">Website by <a href="https://samirjoza.com" class="text-white text-decoration-none" target="_blank">Samir Joza</a></p>
      </div>
    </div>
  </div>
</footer>
