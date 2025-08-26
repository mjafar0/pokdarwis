@props([
  /**
   * items: array gambar.
   * [
   *   ['src' => 'assets/images/img14.jpg', 'alt' => 'Caption optional'],
   *   ['src' => 'assets/images/img11.jpg', 'alt' => 'Another'],
   *   ...
   * ]
   */
  'items' => [],
  'gallery' => 'gallery'
])

@php
  // fallback demo jika kosong
  if (empty($items)) {
    $items = [
      ['src'=>'assets/images/img14.jpg','alt'=>'Image 14'],
      ['src'=>'assets/images/img11.jpg','alt'=>'Image 11'],
      ['src'=>'assets/images/img12.jpg','alt'=>'Image 12'],
      ['src'=>'assets/images/img13.jpg','alt'=>'Image 13'],
      ['src'=>'assets/images/img10.jpg','alt'=>'Image 10'],
    ];
  }
@endphp

<div {{ $attributes->merge(['class' => 'gallery-section']) }}>
  <div class="container">
    <div class="gallery-outer-wrap">
      <div class="gallery-container grid">
        @foreach($items as $it)
          @php
            $src = asset(data_get($it, 'src'));
            $alt = data_get($it, 'alt', '');
          @endphp
          <div class="single-gallery grid-item">
            <figure class="gallery-img">
              <a href="{{ $src }}" data-fancybox="{{ $gallery }}">
                <img src="{{ $src }}" alt="{{ $alt }}">
              </a>
            </figure>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
