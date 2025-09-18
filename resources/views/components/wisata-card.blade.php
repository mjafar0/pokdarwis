@props([
  'title'      => 'PACKAGE TITLE',
  'image'      => 'assets/images/img1.jpg',  // path relatif dari /public
  'detailLink' => '#',
  'description'=> null,

  'duration'   => '—',
  'pax'        => 0,
  'location'   => '—',

  'currency'   => '$',
  'price'      => 0,      // bisa angka atau string siap tampil

  'rating'     => 4.0,    // 0..5
  'reviews'    => 0,

  'bookLink'   => '#',
  'buttonText' => 'Book now',

  'incrementUrl'  => null,          // contoh: route('paket.book.intent', $paket->slug)
  'incrementMode' => 'beacon',      // 'beacon' | 'ajax'

//   'deskripsiLink'   => '#',
//   'buttonDetail' => 'Detail Package',
])

@php
  use Illuminate\Support\Str;
  use Illuminate\Support\Facades\Storage;

  // --- PRICE ---
  $ratingPercent = max(0, min(100, ($rating / 5) * 100));
  if (is_numeric($price)) {
    if (in_array(strtolower($currency), ['rp','idr'])) {
      $priceText = 'Rp ' . number_format($price, 0, ',', '.');
      $currency  = '';
    } else {
      $priceText = number_format($price, 0, ',', '.');
    }
  } else {
    $priceText = $price;
  }

  // --- IMAGE URL NORMALIZER (robust) ---
  $img = $image; // bisa: absolute url, /storage/..., products/..., assets/...
  if (!$img) {
    $imageUrl = asset('assets/images/img1.jpg');
  } elseif (Str::startsWith($img, ['http://','https://','//'])) {
    $imageUrl = $img;                               // absolute
  } elseif (Str::startsWith($img, ['/storage','storage/'])) {
    $imageUrl = url(ltrim($img,'/'));               // /storage/xxx atau storage/xxx
  } elseif (Storage::disk('public')->exists($img)) {
    $imageUrl = Storage::url($img);                 // products/xxx → /storage/products/xxx
  } else {
    $imageUrl = asset(ltrim($img,'/'));             // assets/... di /public
  }

  $bookUrl = $bookLink ?: $detailLink;
  $uid = 'book-now-'.Str::random(8);
@endphp


{{-- Review --}}
{{-- @php
  // hitung width% bintang seperti template: <span style="width: 80%"></span>
  $ratingPercent = max(0, min(100, ($rating / 5) * 100));

  // format harga hanya kalau numeric; kalau string biarkan apa adanya
  if (is_numeric($price)) {
    if (strtolower($currency) === 'rp' || $currency === 'Rp' || $currency === 'IDR') {
      $priceText = 'Rp ' . number_format($price, 0, ',', '.');
      $currency  = ''; // sudah di-embed ke priceText
    } else {
      $priceText = number_format($price, 0, ',', '.');
    }
  } else {
    $priceText = $price;
  }
@endphp --}}

<article {{ $attributes->merge(['class' => 'package-item']) }}>
  <figure class="package-image" style='background-image: url("{{ e($imageUrl) }}");'></figure>
  <div class="package-content">
    <h3><a href="{{ $detailLink }}">{{ $title }}</a></h3>
    @if($description) <p>{{ $description }}</p> @else {{ $slot }} @endif
    <div class="package-meta">
      <ul>
        <li><i class="fas fa-clock"></i> {{ $duration }}</li>
        <li><i class="fas fa-user-friends"></i> pax: {{ $pax }}</li>
        <li><i class="fas fa-map-marker-alt"></i> {{ $location }}</li>
      </ul>
    </div>
  </div>

  <div class="package-price">
    <div class="rating-start-wrap d-inline-block">
      {{-- <div class="rating-start"><span style="width: {{ $ratingPercent }}%"></span></div> --}}
    </div>

    <h6 class="price-list"><span>{{ $currency }} {{ $priceText }}</span></h6>

    <a
      id="{{ $uid }}"
      href="{{ $bookUrl }}"
      class="outline-btn outline-btn-white js-book-now"
      @if($incrementUrl)
        data-increment-url="{{ $incrementUrl }}"
        data-mode="{{ $incrementMode }}"
        data-csrf="{{ csrf_token() }}"
      @endif
    >{{ $buttonText }}</a>
  </div>
</article>


