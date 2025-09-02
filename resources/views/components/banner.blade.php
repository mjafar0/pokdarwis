@props([
  'slides' => [],
])

@php
  if (empty($slides)) {
      $slides = [
          [
              'image' => 'assets/images/banner-img1.jpg',
              'title' => 'JOURNEY TO EXPLORE WORLD',
              'text'  => 'Welcome to our site!',
              'primaryHref' => url('pokdarwis'),
              'primaryText' => 'EXPLORE',
          ],
          [
              'image' => 'assets/images/img7.jpg',
              'title' => 'BEAUTIFUL PLACE TO VISIT',
              'text'  => 'Discover amazing destinations',
              'primaryHref' => url('pokdarwis'),
              'primaryText' => 'EXPLORE',
          ],
      ];
  }

  $toUrl = fn($path) => \Illuminate\Support\Str::startsWith($path, ['http://','https://','//'])
      ? $path
      : asset($path);

  $uid = uniqid('banner_');
@endphp

<section {{ $attributes->merge(['class' => 'home-banner-section']) }}>
  <div id="{{ $uid }}" class="home-banner-slider">
    @foreach($slides as $slide)
      @php
        $img   = $toUrl($slide['image'] ?? 'assets/images/banner.jpg');
        $title = $slide['title'] ?? '';
        $text  = $slide['text'] ?? '';
        $pHref = $slide['primaryHref'] ?? '#';
        $pText = $slide['primaryText'] ?? '';
        $sHref = $slide['secondaryHref'] ?? '#';
        $sText = $slide['secondaryText'] ?? '';
      @endphp

      <div class="home-banner d-flex flex-wrap align-items-center" style='background-image:url("{{ $img }}")'>
        <div class="overlay"></div>
        <div class="container">
          <div class="banner-content text-center">
            <div class="row">
              <div class="col-lg-8 offset-lg-2">
                @if($title)<h2 class="banner-title">{{ $title }}</h2>@endif
                @if($text)<p>{{ $text }}</p>@endif
                <div class="banner-btn">
                  @if($pText)<a href="{{ $pHref }}" class="round-btn">{{ $pText }}</a>@endif
                  @if($sText)<a href="{{ $sHref }}" class="outline-btn outline-btn-white">{{ $sText }}</a>@endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  var $el = $('#{{ $uid }}');
  if (!$el.length) return;

  // kalau sudah pernah di-init, jangan ulang
  if ($el.hasClass('slick-initialized')) return;

  $el.on('init', function(){
    // paksa play (kalau autoplay sempat ke-pause)
    $el.slick('slickPlay');
  });

  $el.slick({
    autoplay: true,
    autoplaySpeed: 4000,
    arrows: true,
    dots: true,
    fade: false,          // matikan dulu fade untuk uji; boleh nyalakan lagi nanti
    speed: 600,
    pauseOnHover: false,
    pauseOnFocus: false,
  });
});
</script>
@endpush
