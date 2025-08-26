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

//   'deskripsiLink'   => '#',
//   'buttonDetail' => 'Detail Package',
])

@php
  use Illuminate\Support\Str;

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

  // gambar: suport absolut & relatif
  $imageUrl = Str::startsWith($image, ['http://','https://','//'])
    ? $image
    : asset($image);

  // kalau bookLink kosong, fallback ke detailLink
  $bookUrl = $bookLink ?: $detailLink;
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
      {{-- contoh kalau nanti mau tampilkan rating --}}
      {{-- <div class="rating-start"><span style="width: {{ $ratingPercent }}%"></span></div> --}}
    </div>

    <h6 class="price-list"><span>{{ $currency }} {{ $priceText }}</span></h6>

    <a href="{{ $bookUrl }}" class="outline-btn outline-btn-white">{{ $buttonText }}</a>
  </div>
</article>


