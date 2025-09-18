@props([
  /**
   * items: each item may be:
   *   ['src'=>'…','alt'=>'…','type'=>'foto|video']  // type optional
   * or you can just pass strings (src only) and it will try to detect the type.
   */
  'items' => [],
  'gallery' => 'gallery',
])

@php
  use Illuminate\Support\Str;

  // Fallback demo if empty
  if (empty($items)) {
    $items = [
      ['src'=>'assets/images/img14.jpg','alt'=>'Image 14','type'=>'foto'],
      ['src'=>'assets/images/img11.jpg','alt'=>'Image 11','type'=>'foto'],
    ];
  }

  // Normalize each item into ['src'=>..., 'alt'=>..., 'type'=>...]
  $norm = collect($items)->map(function ($it) {
    if (is_string($it)) $it = ['src' => $it];

    $src  = data_get($it, 'src', '');
    $alt  = data_get($it, 'alt', '');
    $type = data_get($it, 'type'); // optional

    // If type missing, infer from src
    if (!$type) {
      $lower = Str::lower($src);
      if (Str::contains($lower, ['youtube.com', 'youtu.be'])) {
        $type = 'video';
      } elseif (Str::endsWith($lower, ['.mp4'])) {
        $type = 'video';
      } else {
        $type = 'foto';
      }
    }

    // Convert to usable URL: keep absolute as-is, otherwise asset()
    $toUrl = function ($path) {
      return Str::startsWith($path, ['http://','https://','//','data:'])
        ? $path
        : asset($path);
    };

    // Extract YouTube ID if needed
    $ytId = null;
    if ($type === 'video' && Str::contains($src, ['youtube.com', 'youtu.be'])) {
      $host = parse_url($src, PHP_URL_HOST) ?? '';
      if (Str::contains($host, 'youtu.be')) {
        $ytId = trim(basename(parse_url($src, PHP_URL_PATH) ?? ''), '/');
      } else {
        parse_str(parse_url($src, PHP_URL_QUERY) ?? '', $q);
        $ytId = $q['v'] ?? null;
      }
    }

    return [
      'src'  => $src,
      'alt'  => $alt,
      'type' => $type,
      'url'  => $toUrl($src),
      'ytId' => $ytId,
    ];
  });
@endphp

<div {{ $attributes->merge(['class' => 'gallery-section']) }}>
  <div class="container">
    <div class="gallery-outer-wrap">
      <div class="gallery-container grid">

        @foreach($norm as $it)
          <div class="single-gallery grid-item">
            <figure class="gallery-img">
              @if($it['type'] === 'foto')
                <a href="{{ $it['url'] }}" data-fancybox="{{ $gallery }}">
                  <img src="{{ $it['url'] }}" alt="{{ $it['alt'] }}">
                </a>

              @elseif(!empty($it['ytId']))
                {{-- YouTube --}}
                <div class="ratio ratio-16x9">
                  <iframe
                    src="https://www.youtube.com/embed/{{ $it['ytId'] }}?rel=0&modestbranding=1"
                    title="{{ $it['alt'] }}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                  </iframe>
                </div>

              @else
                {{-- Local/absolute mp4 --}}
                <video class="w-100 rounded-4" controls preload="metadata" controlsList="nodownload noplaybackrate">
                  <source src="{{ $it['url'] }}" type="video/mp4">
                </video>
              @endif
            </figure>
          </div>
        @endforeach

      </div>
    </div>
  </div>
</div>
