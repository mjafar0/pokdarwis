@props([
  'active'   => null,
  // 'bookHref' => '#',
  // 'bookText' => 'Book Now',
  'logo'     => asset('assets/images/site-logo.png'),
  'phone'    => '+01 (977) 2599 12',
])

<header id="masthead" class="site-header">
  <div class="top-header">
    <div class="container">
      <div class="top-header-inner">
        <div class="header-contact text-left">
          <a href="tel:+01977259912">
            <i class="icon icon-phone-call2" aria-hidden="true"></i>
            <div class="header-contact-details">
              <span class="contact-label">For Further Inquires :</span>
              <h5 class="header-contact-no">{{ $phone }}</h5>
            </div>
          </a>
        </div>

        <div class="site-logo text-center">
          <p class="site-title">
            <a href="{{ url('/') }}"><img src="{{ $logo }}" alt="Logo"></a>
          </p>
        </div>

        <div class="header-icon text-right">
          <div class="header-search-icon d-inline-block">
            <a href="#"><i class="fas fa-search" aria-hidden="true"></i></a>
          </div>
          <div class="offcanvas-menu d-inline-block">
            <a href="#"><i class="icon icon-burger-menu" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bottom-header">
    <div class="container">
      <div class="bottom-header-inner d-flex justify-content-between align-items-center">
        <div class="header-social social-icon">
          <ul>
            <li><a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="https://www.twitter.com"  target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://www.youtube.com"  target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a></li>
          </ul>
        </div>

        {{-- navbar kamu --}}
        <x-navbar :pokdarwis="$pokdarwis ?? null" :active="$active" />
        {{-- <x-navbar :pokdarwis="$pokdarwis ?? null" active="packages" /> --}}
        <div class="bottom-header-inner d-flex justify-content-between align-items-center">
                        <div class="header-btn">
                            <a href="{{ url('/login') }}"class="round-btn" style="all:unset; color:white; cursor:pointer; display:inline-block;">LOG IN</a>
                        </div>
                    </div>
        {{-- <div class="header-btn">
          <a href="{{ $bookHref }}" class="round-btn">{{ $bookText }}</a>
        </div> --}}
      </div>
    </div>
  </div>

  <div class="mobile-menu-container"></div>
</header>