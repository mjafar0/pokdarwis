@props([
  'bg'            => 'assets/images/img7.jpg', // gambar background (relatif / absolut)
  'video'         => 'https://www.youtube.com/watch?v=2OYar8OHEOU',
  'title'         => 'ARE YOU READY TO TRAVEL? REMEMBER US !!',
  'description'   => null, // kalau null, pakai $slot
  'primaryHref'   => '#',
//   'primaryText'   => 'View Packages',
  'secondaryHref' => '#',
//   'secondaryText' => 'Learn More',
  'showOverlay'   => true,
])

@php
  /** pastikan URL bg benar: boleh absolute atau asset() **/
  $isAbsolute = \Illuminate\Support\Str::startsWith($bg, ['http://', 'https://', '//']);
  $bgUrl = $isAbsolute ? $bg : asset($bg);
@endphp

<div {{ $attributes->merge(['class' => 'bg-img-fullcallback']) }} style="background-image: url({{ $bgUrl }});">
  @if($showOverlay)
    <div class="overlay"></div>
  @endif
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="callback-content">
          <div class="video-button">
            <a id="video-container" data-fancybox="video-gallery" href="{{ $video }}">
              <i class="fas fa-play"></i>
            </a>
          </div>

          <h2 class="section-title">{{ $title }}</h2>

          @if(!empty($description))
            <p>{{ $description }}</p>
          @else
            {{ $slot }}
          @endif

          {{-- <div class="callback-btn">
            <a href="{{ $primaryHref }}" class="round-btn">{{ $primaryText }}</a>
            <a href="{{ $secondaryHref }}" class="outline-btn outline-btn-white">{{ $secondaryText }}</a>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</div>
