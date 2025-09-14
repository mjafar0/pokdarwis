{{-- resources/views/pokdarwis.blade.php --}}
@extends('layouts.pokdarwisLayout')
@section('title', $pokdarwis->name_pokdarwis)

@section('banner')
  <!-- ***Inner Banner html start form here*** -->
  <x-banner2 :pokdarwis="$pokdarwis" />
  <!-- ***Inner Banner html end here*** -->
@endsection

@section('main')      
  <section class="inner-about-wrap py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8">
          <div class="about-content">
            <figure class="about-image mb-4">
              <img src="{{ asset('assets/images/guruntelagabiru.jpg') }}" alt="" class="img-fluid">
              <div class="about-image-content">
                <h3>WE ARE BEST FOR TOURS & TRAVEL !</h3>
                {{-- <h3>{{ $pokdarwis->name_pokdarwis }}</h3> --}}
              </div>
            </figure>
            <h2>{{ $pokdarwis->name_pokdarwis }}</h2>
            {{-- <p>{{ $pokdarwis->deskripsi }}</p> --}}
            <p>Dictumst voluptas qui placeat omnis repellendus, est assumenda dolores facilisis, nostra, inceptos. Ullam laudantium deserunt duis platea. Fermentum diam, perspiciatis cupidatat justo quam voluptate, feugiat, quaerat. Delectus aute scelerisque blanditiis venenatis aperiam rem. Tempore porttitor orci eligendi velit vel scelerisque minus scelerisque? Dis! Aenean! Deleniti esse aperiam adipiscing, sapiente? </p>
            <p>Ratione conubia incididunt nullam! Sodales, impedit, molestias consectetuer itaque magni ut neque, lobortis expedita corporis voluptatem natus praesent mollis quidem auctor curae, mattis laboris diamlorem iure nullam esse? Pariatur primis.</p>         
          </div>
        </div>

        {{-- Konten Side Bar --}}
        <div class="col-lg-4">
          <div class="icon-box mb-3">
            <div class="box-icon"><i class="fas fa-umbrella-beach"></i></div>
            <div class="icon-box-content">
              <h3>COMFORTABLE STAYS</h3>
              <p>Affordable and cozy accommodations to make your journey worry-free.</p>
            </div>
          </div>
          <div class="icon-box mb-3">
            <div class="box-icon"><i class="fas fa-user-tag"></i></div>
            <div class="icon-box-content">
              <h3>BEST TOUR GUIDES</h3>
              <p>Friendly and knowledgeable guides to ensure a rich and authentic experience.</p>
            </div>
          </div>
          <div class="icon-box">
            <div class="box-icon"><i class="fas fa-headset"></i></div>
            <div class="icon-box-content">
              <h3>24/7 SUPPORT</h3>
              <p>Our team is always ready to assist you anytime, anywhere.</p>
            </div>
          </div>
        </div>
        {{-- Konten Side Bar --}}
        
        {{-- Wisata Card --}}
        <x-video-wisata
           bg="assets/images/guruntelagabiru.jpg"
           video="https://www.youtube.com/watch?v=2OYar8OHEOU"
           title="ARE YOU READY TO TRAVEL? REMEMBER US !!"
           {{-- primaryHref="{{ url('package') }}"
           primaryText="View Packages" --}}
           {{-- secondaryHref="{{ url('about') }}"
           secondaryText="Learn More" --}}
        />
        <div class="container">
          
                  @if($pakets->count() > 0)
                  <div class="row">
                      <div class="col-lg-8">
                          <div class="section-heading">
                              <h2 class="section-title">OUR PACKAGES</h2>
                              <p>
                                  Discover journeys crafted to inspire, combining relaxation, adventure, and authentic local culture. 
                                  Each package is designed to give you lasting memories with every experience.
                              </p>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      @foreach ($pakets as $p)  
                          <x-wisata-card
                              :title="$p->nama_paket"
                              :image="$p->cover_url ?? $p->img"
                              :detail-link="route('paket.show', $p)" 
                              :description="\Illuminate\Support\Str::limit(strip_tags($p->deskripsi ?? ''), 120)"
                              :duration="$p->waktu_penginapan"
                              :pax="$p->pax"
                              :location="$p->lokasi"
                              :currency="$p->currency"
                              :price="$p->harga"
                              :book-link="route('paket.show', $p)"
                          />
                      @endforeach
                  </div>
                  @endif
                
                {{-- Pagination --}}
                @if ($pakets->hasPages())
                <div class="post-navigation-wrap">
                  <nav aria-label="Pagination">
                    <ul class="pagination">

                      {{-- Prev --}}
                      @php $prevUrl = $pakets->previousPageUrl(); @endphp
                      <li class="{{ $pakets->onFirstPage() ? 'disabled' : '' }}">
                        <a
                          href="{{ $pakets->onFirstPage() ? 'javascript:void(0)' : $prevUrl }}"
                          aria-label="Halaman sebelumnya"
                          aria-disabled="{{ $pakets->onFirstPage() ? 'true' : 'false' }}"
                          rel="prev"
                          title="Sebelumnya"
                        >
                          <i class="fas fa-arrow-left" aria-hidden="true"></i>
                          <span class="sr-only">Prev</span>
                        </a>
                      </li>

                      {{-- Numbered pages with ellipses --}}
                      @php
                        $current = $pakets->currentPage();
                        $last    = $pakets->lastPage();
                        $start   = max($current - 1, 2);      // blok tengah mulai dari 2
                        $end     = min($current + 1, $last);  // blok tengah berakhir di last
                      @endphp

                      {{-- Page 1 --}}
                      <li class="{{ $current === 1 ? 'active' : '' }}">
                        <a href="{{ $pakets->url(1) }}" aria-current="{{ $current === 1 ? 'page' : 'false' }}">1</a>
                      </li>

                      {{-- Left ellipses --}}
                      @if ($start > 2)
                        <li class="ellipsis" role="separator" aria-hidden="true"><a href="javascript:void(0)">…</a></li>
                      @endif

                      {{-- Middle: current ±1 --}}
                      @for ($page = $start; $page <= $end; $page++)
                        @if ($page >= 2 && $page <= $last - 1)
                          <li class="{{ $page === $current ? 'active' : '' }}">
                            <a href="{{ $pakets->url($page) }}" aria-current="{{ $page === $current ? 'page' : 'false' }}">{{ $page }}</a>
                          </li>
                        @endif
                      @endfor

                      {{-- Right ellipses --}}
                      @if ($end < $last - 1)
                        <li class="ellipsis" role="separator" aria-hidden="true"><a href="javascript:void(0)">…</a></li>
                      @endif

                      {{-- Last page (jika >1) --}}
                      @if ($last > 1)
                        <li class="{{ $current === $last ? 'active' : '' }}">
                          <a href="{{ $pakets->url($last) }}" aria-current="{{ $current === $last ? 'page' : 'false' }}">{{ $last }}</a>
                        </li>
                      @endif

                      {{-- Next --}}
                      @php $nextUrl = $pakets->nextPageUrl(); @endphp
                      <li class="{{ $pakets->hasMorePages() ? '' : 'disabled' }}">
                        <a
                          href="{{ $pakets->hasMorePages() ? $nextUrl : 'javascript:void(0)' }}"
                          aria-label="Halaman berikutnya"
                          aria-disabled="{{ $pakets->hasMorePages() ? 'false' : 'true' }}"
                          rel="next"
                          title="Berikutnya"
                        >
                          <i class="fas fa-arrow-right" aria-hidden="true"></i>
                          <span class="sr-only">Next</span>
                        </a>
                      </li>

                    </ul>
                  </nav>
                </div>
              @endif
                
                <section class="single-package mb-5">
                </section>
                {{-- @if(method_exists($pakets, 'links'))
                  <div class="mt-5">
                    {{ $pakets->links() }}
                  </div>
                @endif --}}
                
                @if($items->count() > 0)
                <div class="row">
                    <div class="col-lg-8">
                        <div class="section-heading">
                            <h2 class="section-title">OUR PRODUCTS</h2>
                            <p>
                                Discover a wide range of local products that showcase creativity, quality, and the spirit of the community. 
                                From everyday essentials to specialty items, each product is carefully made to bring value and authenticity 
                                to your experience.
                            </p>
                        </div>
                    </div>
                </div>

                <x-product-card
                    class="pt-0 mt-2"      
                    subtitle="UNCOVER PLACE"
                    title="POPULAR PRODUCT"
                    text="Produk-produk pilihan dari berbagai Pokdarwis."
                    :items="$items"
                />
                @endif

                @if ($galleryItems->count()>0)
                <div class="col-lg-8 offset-lg-2 text-sm-center">
                        <div class="section-heading">
                           {{-- <h5 class="sub-title">PHOTO GALLERY</h5> --}}
                           <h2 class="section-title">PHOTO'S GALLERY</h2>
                           <p>Take a closer look through our photo collection, capturing the beauty of destinations, the warmth of communities, and the unique experiences we offer. Every picture tells a story worth remembering.</p>
                        </div>
                     </div>

                     <x-gallery-card :items="$galleryItems" gallery="pokdarwis-{{ $pokdarwis->id }}" class="my-5" />
                @endif
                <div class="grid blog-inner row">
                
                      {{-- <x-gallery-card :items="
                    [
                        ['src' => 'assets/images/guruntelagabiru.jpg','alt'=>'Pantai'],
                        ['src' => 'assets/images/img11.jpg','alt'=>'Gunung'],
                        ['src' => 'assets/images/img12.jpg','alt'=>'Hutan'],
                        ['src' => 'assets/images/img13.jpg','alt'=>'Danau'],
                        ['src' => 'assets/images/guruntelagabiru.jpg','alt'=>'Pantai'],
                        ['src' => 'assets/images/img11.jpg','alt'=>'Gunung'],
                        ['src' => 'assets/images/img12.jpg','alt'=>'Hutan'],
                        ['src' => 'assets/images/img13.jpg','alt'=>'Danau'],
                    ]" gallery="wisata-gallery" class="my-5" 
                /> --}}
      </div>
    </div>
  </section>
@endsection
