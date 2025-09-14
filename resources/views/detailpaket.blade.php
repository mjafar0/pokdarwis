@extends('layouts.detailPaketLayout')
@section('title', $paket->nama_paket)


@section('banner')
    <x-banner2 :pokdarwis="$paket->pokdarwis"> 
    
    </x-banner2>
@endsection

@section('main')
<div class="inner-package-detail-wrap">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 primary right-sidebar">

        <div class="single-packge-wrap">
          {{-- Head: judul + harga --}}
          <div class="single-package-head d-flex align-items-center">
            <div class="package-title">
              <h2>{{ $paket->nama_paket }}</h2>
              <div class="rating-start-wrap">
                <div class="rating-start">
                  {{-- kalau belum ada rating, pakai 80% sebagai placeholder --}}
                  <span style="width: 80%"></span>
                </div>
              </div>
            </div>
            <div class="package-price">
              <h6 class="price-list">
                <span>{{ $paket->currency }} {{ number_format((float)$paket->harga, 0, ',', '.') }}</span>
                / per person
              </h6>
            </div>
          </div>

          {{-- Meta: durasi, pax, kategori(?), lokasi --}}
          <div class="package-meta">
            <ul>
              <li><i class="fas fa-clock"></i> {{ $paket->waktu_penginapan }}</li>
              <li><i class="fas fa-user-friends"></i> pax: {{ $paket->pax }}</li>
              {{-- <li><i class="fas fa-swimmer"></i> Category : {{ $paket->kategori ?? '—' }}</li> --}}
              <li><i class="fas fa-map-marker-alt"></i> {{ $paket->lokasi }}</li>
            </ul>
          </div>

          {{-- Gambar utama --}}
          <figure class="single-package-image">
            <img src="{{ $paket->cover_url }}" alt="{{ $paket->nama_paket }}">
          </figure>

          <div class="package-content-detail">
            {{-- Overview / Deskripsi --}}
            <article class="package-overview">
              <h3>OVERVIEW :</h3>
              @if(filled($paket->deskripsi))
                <p>{!! nl2br(e($paket->deskripsi)) !!}</p>
              @else
                <p class="text-muted">Belum ada deskripsi.</p>
              @endif
            </article>

            {{-- Include & Exclude dari tabel paket_fasilitas --}}
            {{-- @if($paket->fasilitasInclude->isNotEmpty() || $paket->fasilitasExclude->isNotEmpty()) --}}
            @if($paket->fasilitasInclude->count() > 0 || $paket->fasilitasExclude->count() > 0)
            <article class="package-include bg-light-grey">
                <h3>INCLUDE & EXCLUDE :</h3>
                <ul>
                    @php
                        $max = max($paket->fasilitasInclude->count(), $paket->fasilitasExclude->count());
                    @endphp

                    @for($i = 0; $i < $max; $i++)
                        @if(isset($paket->fasilitasInclude[$i]))
                            <li><i class="fas fa-check"></i> {{ $paket->fasilitasInclude[$i]->nama_item }}</li>
                        @endif

                        @if(isset($paket->fasilitasExclude[$i]))
                            <li><i class="fas fa-times"></i> {{ $paket->fasilitasExclude[$i]->nama_item }}</li>
                        @endif
                    @endfor
                </ul>
            </article>
            @endif

            {{-- @endif --}}
          </div>
        </div>

      </div>

      {{-- Sidebar kanan --}}
      <div class="col-lg-4">
        <div class="sidebar">

          {{-- Related Images (fallback: pakai gambar cover berulang jika belum ada data galeri) --}}
          <div class="related-package">
            <h3>RELATED IMAGES</h3>
            <p>Dokumentasi terkait destinasi ini.</p>
            @php
              // kalau kamu sudah punya relasi galeri, ganti isi array ini
              $relatedImages = $relatedImages ?? [$paket->cover_url, $paket->cover_url, $paket->cover_url];
            @endphp
            <div class="related-package-slide">
              @foreach($relatedImages as $img)
                <div class="related-package-item">
                  <img src="{{ $img }}" alt="{{ $paket->nama_paket }}">
                </div>
              @endforeach
            </div>
          </div>

          {{-- Peta (isi sesuai komponenmu). Kalau belum ada lat/lng di tabel, kirim alamat saja / biarkan default --}}
          <x-package-map :address="$paket->lokasi" />
          {{-- atau jika komponenmu butuh lat/lng: :lat="$paket->lat" :lng="$paket->lng" --}}

        {{-- More Package --}}
        <x-more-packages
            :items="$others"
            :limit="5"
            :bg="$paket->cover_url ?? $paket->img"  
            class="mt-4"
        />

      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('footer')
  <x-footer></x-footer>
@endsection
