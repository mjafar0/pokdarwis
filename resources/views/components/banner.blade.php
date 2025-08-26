@props([
    /**
     * slides: array of banner items
     * [
     *   [
     *     'image'       => 'assets/images/banner-img1.jpg',
     *     'title'       => 'JOURNEY TO EXPLORE WORLD',
     *     'text'        => 'Ac mi duis mollis...',
     *     'primaryHref' => 'about.html',
     *     'primaryText' => 'LEARN MORE',
     *     'secondaryHref'=> 'booking.html',
     *     'secondaryText'=> 'BOOK NOW',
     *   ],
     *   ...
     * ]
     */
    'slides' => [],
])

@php
    // Demo default jika tidak ada slides
    if (empty($slides)) {
        $slides = [
            [
                'image'        => 'assets/images/banner-img1.jpg',
                'title'        => 'JOURNEY TO EXPLORE WORLD',
                'text'         => 'Ac mi duis mollis. Sapiente? Scelerisque quae...',
                'primaryHref'  => 'pokdarwis.html',
                'primaryText'  => 'EXPLORE',
            ],
            [
                'image'        => 'assets/images/img7.jpg',
                'title'        => 'BEAUTIFUL PLACE TO VISIT',
                'text'         => 'Ac mi duis mollis. Sapiente? Scelerisque quae...',
                'primaryHref'  => 'pokdarwis.html',
                'primaryText'  => 'EXPLORE',
            ],
        ];
    }

    $toUrl = function($path) {
        return \Illuminate\Support\Str::startsWith($path, ['http://','https://','//'])
            ? $path
            : asset($path);
    };
@endphp

<section {{ $attributes->merge(['class' => 'home-banner-section home-banner-slider']) }}>
    @foreach($slides as $slide)
        @php
            $img          = $toUrl($slide['image'] ?? 'assets/images/banner.jpg');
            $title        = $slide['title'] ?? '';
            $text         = $slide['text'] ?? '';
            $primaryHref  = $slide['primaryHref'] ?? '#';
            $primaryText  = $slide['primaryText'] ?? '';
            $secondaryHref= $slide['secondaryHref'] ?? '#';
            $secondaryText= $slide['secondaryText'] ?? '';
        @endphp

        <div class="home-banner d-flex flex-wrap align-items-center" style='background-image: url("{{ $img }}");'>
            <div class="overlay"></div>
            <div class="container">
                <div class="banner-content text-center">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <h2 class="banner-title">{{ $title }}</h2>
                            <p>{{ $text }}</p>
                            <div class="banner-btn">
                                @if($primaryText)
                                    <a href="{{ $primaryHref }}" class="round-btn">{{ $primaryText }}</a>
                                @endif
                                @if($secondaryText)
                                    <a href="{{ $secondaryHref }}" class="outline-btn outline-btn-white">{{ $secondaryText }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section>