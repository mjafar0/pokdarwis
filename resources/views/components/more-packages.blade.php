@props([
  /**
   * items: Collection|array paket lain (masing-masing punya nama_paket & slug/id).
   * Contoh: PaketWisata::where(...)->get(['id','nama_paket','slug'])
   */
  'items' => collect(),
  'title' => 'MORE PACKAGES',
  'routeName' => 'paket.show',   // nama route detail
  'limit' => null,               // batasi jumlah item (null = semua)
  'showWhenEmpty' => false,      // true = tetap render wrapper meski kosong
  'bg' => null,
])

@php
    use Illuminate\Support\Str;

  $list = collect($items);
  if ($limit) $list = $list->take($limit);

  $bgSrc = $bg;
  if (!$bgSrc) {
      // coba dari items (ambil yang pertama punya cover_url/img)
      $candidate = $list->first(function ($p) {
          return data_get($p, 'cover_url') || data_get($p, 'img');
      });
      $bgSrc = data_get($candidate, 'cover_url') ?: data_get($candidate, 'img');
  }
  // fallback default
  $bgSrc = $bgSrc ?: 'assets/images/banner-img1.jpg';

  // absolut vs relatif
  $bgUrl = Str::startsWith($bgSrc, ['http://','https://','//'])
      ? $bgSrc
      : asset($bgSrc);
@endphp

@if($showWhenEmpty || $list->isNotEmpty())
  <div {{ $attributes->merge([
    'class' => 'package-list',
    'style' => "background-image:url('{$bgUrl}')"
    ]) }}>
    <div class="overlay"></div>
    <h4>{{ $title }}</h4>

    @if($list->isNotEmpty())
      <ul>
        @foreach($list as $p)
          @php
            // dukung array atau model
            $nama = data_get($p, 'nama_paket', 'Untitled');
            $model = is_object($p) ? $p : null;
            $url = $model ? route($routeName, $model)
                          : (data_get($p, 'slug') ? route($routeName, ['paket' => data_get($p,'slug')]) : '#');
          @endphp
          <li>
            <a href="{{ $url }}">
              <i aria-hidden="true" class="icon icon-arrow-right-circle"></i>
              {{ $nama }}
            </a>
          </li>
        @endforeach
      </ul>
    @endif
  </div>
@endif
