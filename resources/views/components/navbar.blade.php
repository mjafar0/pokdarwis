@props([
  'pokdarwis' => null,
  'active' => null, // 'home'|'about'|'destination'|'packages'|'pages'|'contact'
])

@php
use Illuminate\Support\Facades\Route;

$slug = $pokdarwis->slug ?? null;

$rl = function (string $name, $params = [], string $fallback = '#') {
    if (!Route::has($name)) return $fallback;
    try { return route($name, $params); } catch (\Throwable $e) { return $fallback; }
};

$hrefHome    = $slug ? $rl('pdw.home', ['slug' => $slug], url('/home'))           : url('/home');
$hrefAbout   = $slug ? $rl('pdw.about', ['slug' => $slug], url('/pokdarwis'))     : url('/pokdarwis');
$hrefDest    = $slug ? $rl('pdw.destinations', ['slug' => $slug], '/gallery')        : url('/gallery');
$hrefProd    = $slug ? $rl('pdw.products', ['slug' => $slug], '#')            : '#';
$hrefContact = $slug ? $rl('pdw.contact', ['slug' => $slug], url('/contact')) : url('/contact');

$isActive = fn ($name) => $active === $name ? 'menu-active' : '';

// 👉 fungsi untuk bikin URL detail pokdarwis
$pdUrl = function ($pd) {
    return route('pokdarwis.show', $pd->id); 
    // kalau pakai slug: return route('pokdarwis.show', $pd->slug);
};

// penanda menu item aktif
$isTourCurrent = function ($pd) use ($pokdarwis) {
    return $pokdarwis && ($pokdarwis->id === $pd->id) ? 'current-menu-item' : '';
};
@endphp

<div class="navigation-container d-none d-lg-block">
  <nav id="navigation" class="navigation" aria-label="Main">
    <ul>
      <li class="{{ $isActive('home') }}"><a href="{{ $hrefHome }}">Home</a></li>
      {{-- <li class="{{ $isActive('about') }}"><a href="{{ $hrefAbout }}">about us</a></li> --}}
      <li class="{{ $isActive('destination') }}"><a href="{{ $hrefDest }}">Gallery</a></li>

      <li class="menu-item-has-children {{ $isActive('packages') }}">
        <a href="#!">tour</a>
        <ul>
          @forelse(($pokdarwisMenu ?? []) as $pd)
            <li class="{{ $isTourCurrent($pd) }}">
              <a href="{{ $pdUrl($pd) }}">{{ $pd->name_pokdarwis }}</a>
            </li>
          @empty
            <li><a href="#" tabindex="-1">— No data —</a></li>
          @endforelse
        </ul>
      </li>

      <li class="menu-item-has-children {{ $isActive('pages') }}">
        <a href="#">Pages</a>
        <ul>
          <li><a href="#">Service</a></li>
          <li class="menu-item-has-children">
            <a href="#">Career</a>
            <ul>
              <li><a href="#">Career</a></li>
              <li><a href="#">Career detail</a></li>
            </ul>
          </li>
          <li><a href="#">Tour guide</a></li>
          <li><a href="#">Gallery page</a></li>
          <li class="menu-item-has-children">
            <a href="#">Blog</a>
            <ul>
              <li><a href="#">Blog archive</a></li>
              <li><a href="#">blog single</a></li>
            </ul>
          </li>
          <li><a href="#">Single Page</a></li>
          <li><a href="#">Testimonial</a></li>
          <li><a href="#">Faq Page</a></li>
          <li><a href="#">Search Page</a></li>
          <li><a href="#">404 Page</a></li>
          <li><a href="#">Comming Soon Page</a></li>
        </ul>
      </li>

      <li class="{{ $isActive('contact') }}"><a href="{{ $hrefContact }}">contact us</a></li>
    </ul>
  </nav>
</div>
