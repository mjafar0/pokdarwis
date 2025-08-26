@props(['pokdarwis' => null])

<div class="inner-banner-wrap">
  <div class="inner-baner-container" 
       style="background-image:url('{{ asset('assets/images/guruntelagabiru.jpg') }}');">
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
