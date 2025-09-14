@props([
//   'subtitle' => 'UNCOVER PLACE',
  'title'    => 'POPULAR DESTINATION',
  'text'     => 'Fusce hic augue velit wisi quibusdam pariatur, iusto primis, nec nemo, rutrum. Vestibulum cumque laudantium. Sit ornare mollitia tenetur, aptent.',

  /**
   * items: array destinasi.
   * Tiap item: [
   *   'image'   => 'assets/images/img1.jpg' | 'https://...',
   *   'cat'     => 'ITALY',
   *   'catUrl'  => 'destination.html',
   *   'title'   => 'SAN MIGUEL',
   *   'titleUrl'=> 'package-detail.html',
   *   'desc'    => 'teks deskripsi',
   *   'rating'  => 5 (0..5),
   * ]
   */

  'items'    => [],
  'ctaHref'  => 'destination.html',
//   'ctaText'  => 'More Product',
])

@php
  // Demo default jika belum ada items
  if (empty($items)) {
    $items = [
      ['image'=>'assets/images/img1.jpg','cat'=>'ITALY','catUrl'=>'destination.html','title'=>'SAN MIGUEL','titleUrl'=>'package-detail.html','desc'=>'Fusce hic augue velit wisi ips quibusdam pariatur, iusto.','rating'=>5],
      ['image'=>'assets/images/img2.jpg','cat'=>'Dubai','catUrl'=>'destination.html','title'=>'BURJ KHALIFA','titleUrl'=>'package-detail.html','desc'=>'Fusce hic augue velit wisi ips quibusdam pariatur, iusto.','rating'=>5],
      ['image'=>'assets/images/img3.jpg','cat'=>'Japan','catUrl'=>'destination.html','title'=>'KYOTO TEMPLE','titleUrl'=>'package-detail.html','desc'=>'Fusce hic augue velit wisi ips quibusdam pariatur, iusto.','rating'=>5],
    ];
  }

  $toUrl = function ($path) {
    $isAbs = \Illuminate\Support\Str::startsWith($path, ['http://','https://','//']);
    return $isAbs ? $path : asset($path);
  };
@endphp

<section {{ $attributes->merge(['class' => 'home-destination']) }}>
  <div class="container">
    <div class="row">
                     <div class="col-lg-8 offset-lg-2 text-sm-center">
                        <div class="section-heading">
                           {{-- <h5 class="sub-title">OFFER & DISCOUNT</h5> --}}
                           <h2 class="section-title">SPECIAL PRODUCT</h2>
                           <p>Fusce hic augue velit wisi quibusdam pariatur, iusto primis, nec nemo, rutrum. Vestibulum cumque laudantium. Sit ornare mollitia tenetur, aptent.</p>
                        </div>
                     </div>
                  </div>

      <div class="row">
        @foreach($items as $it)
          @php
            $img     = $toUrl(data_get($it,'image','assets/images/img1.jpg'));
            $cat     = data_get($it,'cat','-');
            $catUrl  = data_get($it,'catUrl','#');
            $ttl     = data_get($it,'title','Untitled');
            $ttlUrl  = data_get($it,'titleUrl','#');
            $desc    = data_get($it,'desc','');
            $rating  = (float) data_get($it,'rating',5);
            $rWidth  = max(0, min(100, ($rating/5)*100));
          @endphp

          <div class="col-lg-4 col-md-6">
            <article class="destination-item" style="background-image: url('{{ $img }}');">

              <div class="destination-content">
                <div class="rating-start-wrap">
                  <div class="rating-start">
                    <span style="width: {{ $rWidth }}%"></span>
                  </div>
                </div>

                <span class="cat-link">
                  <a href="{{ $catUrl }}">{{ $cat }}</a>
                </span>

                <h3>
                  <a href="{{ $ttlUrl }}">{{ $ttl }}</a>
                </h3>

                <p>{{ $desc }}</p>
              </div>
            </article>
          </div>
        @endforeach
      </div>

      <div class="section-btn-wrap text-center">
        {{-- <a href="{{ $ctaHref }}" class="round-btn">{{ $ctaText }}</a> --}}
      </div>
  </div>
</section>
