@props([
  'pokdarwis' => null,
  'paket' => null,
])

@php
  $coverUrl = $pokdarwis->cover_img
      ? (Illuminate\Support\Str::startsWith($pokdarwis->cover_img, ['http://','https://','//'])
          ? $pokdarwis->cover_img
          : asset('storage/'.$pokdarwis->cover_img))
      : asset('assets/images/default-cover.jpg'); // fallback
@endphp

<div class="inner-banner-wrap">
  <div class="inner-baner-container" 
       style="background-image:url('{{ $coverUrl }}');">
    <div class="container">
      <div class="inner-banner-content text-center text-white">
        @if($pokdarwis)
          <h2>{{ $pokdarwis->name_pokdarwis }}</h2>
          <p>{{ $pokdarwis->deskripsi }}</p>
        @else
          <h2>Pokdarwis</h2>
          <p>Deskripsi belum tersedia.</p>
        @endif
      </div>
    </div>
  </div>
</div>
