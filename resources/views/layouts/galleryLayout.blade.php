<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- favicon -->
      <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}" media="all">

      <!-- jquery-ui css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jquery-ui/jquery-ui.min.css') }}">

      <!-- fancybox box css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/fancybox/dist/jquery.fancybox.min.css') }}">

      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">

      <!-- Elmentkit Icon CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/elementskit-icon-pack/assets/css/ekiticons.css') }}">

      <!-- slick slider css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/slick/slick.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/slick/slick-theme.css') }}">

      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

      <title>@yield('title','Pokdarwis | Traveler')</title>

      @stack('head')
      @stack('styles')
   </head>

   <x-preloader />

  <div id="page" class="page">
    {{-- Header (set menu aktif & tombol booking opsional) --}}
    <x-site-header active="about" bookHref="#" bookText="Book Now" />


    <main id="content" class="site-main">
      @yield('banner')   {{-- opsional --}}
      @yield('main')     {{-- konten halaman --}}
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- Back to top --}}
    <x-back-to-top />

    {{-- Search overlay --}}
    <x-search-form />

    {{-- Offcanvas --}}
    <x-offcanvas />
  </div>

      <!-- JavaScript -->
      <script src="{{ asset('assets/vendors/jquery/jquery.js') }}"></script>
      <script src="{{ asset('assets/vendors/waypoint/waypoints.js') }}"></script>
      {{-- <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.min.js') }}"></script> --}}
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

