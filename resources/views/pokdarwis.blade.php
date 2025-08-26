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
                <h3>WE ARE BEST FOR TOURS & TRAVEL SINCE 1985 !</h3>
              </div>
            </figure>
            <h2>HOW WE ARE BEST FOR TRAVEL !</h2>
            <p>Dictumst voluptas qui placeat omnis repellendus, est assumenda dolores facilisis, nostra, inceptos. Ullam laudantium deserunt duis platea. Fermentum diam, perspiciatis cupidatat justo quam voluptate, feugiat, quaerat. Delectus aute scelerisque blanditiis venenatis aperiam rem. Tempore porttitor orci eligendi velit vel scelerisque minus scelerisque? Dis! Aenean! Deleniti esse aperiam adipiscing, sapiente? </p>
            <p>Ratione conubia incididunt nullam! Sodales, impedit, molestias consectetuer itaque magni ut neque, lobortis expedita corporis voluptatem natus praesent mollis quidem auctor curae, mattis laboris diamlorem iure nullam esse? Pariatur primis.</p>         
          </div>
        </div>

        {{-- Konten Side Bar --}}
        <div class="col-lg-4">
          <div class="icon-box mb-3">
            <div class="box-icon"><i class="fas fa-umbrella-beach"></i></div>
            <div class="icon-box-content">
              <h3>PENGINAPAN</h3>
              <p>Penginapan Murah hanya Rp5000/Tahun</p>
            </div>
          </div>
          <div class="icon-box mb-3">
            <div class="box-icon"><i class="fas fa-user-tag"></i></div>
            <div class="icon-box-content">
              <h3>BEST TOUR GUIDES</h3>
              <p>Penjelasan singkat layanan 2.</p>
            </div>
          </div>
          <div class="icon-box">
            <div class="box-icon"><i class="fas fa-headset"></i></div>
            <div class="icon-box-content">
              <h3>24/7 SUPPORT</h3>
              <p>Penjelasan singkat layanan 3.</p>
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
          
                  <div class="row">
                     <div class="col-lg-8 ">
                        <div class="section-heading">
                           <h2 class="section-title">OUR PACKAGES</h2>
                           <p>Fusce hic augue velit wisi quibusdam pariatur, iusto primis, nec nemo, rutrum. Vestibulum cumque laudantium. Sit ornare mollitia tenetur, aptent.</p>
                        </div>
                     </div>
                  </div>
                  @forelse ($pakets as $p )  
                  <x-wisata-card
                      :title="$p->nama_paket"
                      :image="$p->cover_url ?? $p->img"  {{-- accessor cover_url disarankan --}}
                      :detail-link="route('paket.show', $p)" 
                      :description="\Illuminate\Support\Str::limit(strip_tags($p->deskripsi ?? ''), 120)"
                      :duration="$p->waktu_penginapan"
                      :pax="$p->pax"
                      :location="$p->lokasi"
                      :currency="$p->currency"
                      :price="$p->harga"
                      :book-link="route('paket.show', $p)"   {{-- Book now → detail paket --}}
                  />
                  @empty  
                  <div class="col-12">
                    <p class="text-muted">Belum ada paket wisata.</p>
                  </div>
                  @endforelse

                    {{-- <x-wisata-card
                        title="SUMMER HOLIDAY TO THE OXOLOTAN RIVER"
                        image="assets/images/guruntelagabiru.jpg"
                        detailLink="#"
                        description="Laoreet, voluptatum nihil dolor esse quaerat mattis explicabo maiores, est aliquet porttitor! Eaque, cras, aspernatur."
                        duration="5D/4N"
                        pax="10"
                        location="Malaysia"
                        currency="$"
                        price="520"
                        rating="4"
                        reviews="12"
                        bookLink="#"
                    /> --}}
                    {{-- <div class="section-btn-wrap text-center">
                        <a href="package.html" class="round-btn">VIEW ALL PACKAGES</a>
                    </div> --}}
                </div>
                @if(method_exists($pakets, 'links'))
                  <div class="mt-3">
                    {{ $pakets->links() }}
                  </div>
                @endif

                {{-- Produk Card --}}
                <x-product-card :items="$items">

                </x-product-card>

                <div class="col-lg-8 offset-lg-2 text-sm-center">
                        <div class="section-heading">
                           {{-- <h5 class="sub-title">PHOTO GALLERY</h5> --}}
                           <h2 class="section-title">PHOTO'S GALLERY</h2>
                           <p>Fusce hic augue velit wisi quibusdam pariatur, iusto primis, nec nemo, rutrum. Vestibulum cumque laudantium. Sit ornare mollitia tenetur, aptent.</p>
                        </div>
                     </div>

                <x-gallery-card :items="
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
                />
      

      </div>
    </div>
  </section>
@endsection
