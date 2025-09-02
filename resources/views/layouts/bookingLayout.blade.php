<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title','Booking – Traveler')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}"/>

  <!-- CSS vendor yang umum dipakai di project -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-ui/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/fancybox/dist/jquery.fancybox.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/elementskit-icon-pack/assets/css/ekiticons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/slick/slick-theme.css') }}">

  <!-- Style utama -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  @stack('styles')
</head>
<body>

  {{-- Header / Navbar global (pakai komponen yang sudah ada) --}}
  <header id="masthead" class="site-header">
    <div class="top-header">
      <div class="container">
        <div class="top-header-inner d-flex justify-content-between align-items-center">
          <div class="header-contact">
            <a href="tel:+01977259912" class="d-flex align-items-center">
              <i class="icon icon-phone-call2 me-2"></i>
              <div>
                <span class="contact-label d-block">For Further Inquires :</span>
                <h5 class="mb-0">+01 (977) 2599 12</h5>
              </div>
            </a>
          </div>

          <div class="site-logo text-center">
            <h1 class="site-title mb-0">
              <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/site-logo.png') }}" alt="Logo">
              </a>
            </h1>
          </div>

          <div class="header-icon text-end">
            <a href="#" class="me-3"><i class="fas fa-search"></i></a>
            <a href="#"><i class="icon icon-burger-menu"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="bottom-header">
      <div class="container">
        <div class="bottom-header-inner d-flex justify-content-between align-items-center">
          <div class="header-social social-icon">
            <ul>
              <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
              <li><a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a></li>
            </ul>
          </div>

          {{-- Nav utama (pakai komponen navbar supaya konsisten) --}}
          <x-navbar active="booking" />

          <div class="header-btn">
            <a href="{{ url('/login') }}" class="round-btn">LOGIN</a>
          </div>
        </div>
      </div>
    </div>

    <div class="mobile-menu-container"></div>
  </header>

  {{-- MAIN: halaman booking akan mengisi section "main" ini --}}
  <main id="content" class="site-main">
    @yield('banner') {{-- jika suatu saat butuh banner di atas form --}}
    @yield('main')
  </main>

  {{-- Footer umum --}}
  <x-footer />

  <!-- Back to top -->
  <a id="backTotop" href="#" class="to-top-icon"><i class="fas fa-chevron-up"></i></a>

  <!-- Offcanvas (opsional, sesuai template kamu) -->
  <x-offcanvas />

  {{-- JS vendor --}}
  <script src="{{ asset('assets/vendors/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/countdown-date-loop-counter/loopcounter.js') }}"></script>
  <script src="{{ asset('assets/vendors/counterup/jquery.counterup.min.js') }}"></script>
  <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
  <script src="{{ asset('assets/vendors/masonry/masonry.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/slick/slick.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/fancybox/dist/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/slick-nav/jquery.slicknav.js') }}"></script>
  <script src="{{ asset('assets/js/custom.min.js') }}"></script>

  @stack('scripts')
</body>
</html>
