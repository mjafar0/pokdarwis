<style>
  :root { --pf-gap: 1.25rem; }

  .pf-wrap { }
  .pf-card {
    border: 1px solid #e5e7eb; border-radius: 16px; overflow: hidden; background: #fff;
    box-shadow: 0 10px 22px rgba(16,24,40,.06);
  }
  .pf-cover {
    height: 140px; background: linear-gradient(135deg, #2563eb 0%, #22c55e 100%); position: relative;
  }
  .pf-avatar {
    width: 120px; height: 120px; border-radius: 50%; object-fit: cover;
    border: 4px solid #fff; box-shadow: 0 8px 20px rgba(2,6,23,.15);
    position: absolute; left: 24px; bottom: -60px; background:#fff;
  }
  .pf-body { padding: 80px 24px 24px; }

  .pf-title {
    margin: 0; font-weight: 700; font-size: 1.375rem; color: #0f172a;
    line-height: 1.25;
    max-width: 34ch; /* cegah terlalu panjang */
    overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
  }

  .pf-sub {
    color:#475569; margin-top: 6px; font-size:.95rem; display:flex; align-items:center; gap:.5rem;
    line-height: 1.2;
  }
  .pf-sub i { color:#2563eb; opacity:.9; } /* ikon lokasi lebih kontras */

  .pf-badges .badge { background: #f1f5f9; color:#0f172a; border-radius: 999px; padding: .375rem .6rem; font-weight: 600; }
  .pf-actions .btn { border-radius: 999px; padding: .45rem .9rem; font-weight: 600; }

  .pf-section {
    border: 1px solid #e5e7eb; border-radius: 16px; background:#fff; padding: 20px;
    box-shadow: 0 6px 16px rgba(16,24,40,.05);
  }
  .pf-h5 { font-size: 1.05rem; font-weight: 700; margin-bottom: .75rem; color:#0f172a; }

  .pf-kv { margin: 0; padding: 0; list-style: none; }
  .pf-kv li { display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px dashed #e5e7eb; }
  .pf-kv li:last-child { border-bottom: 0; }
  .pf-k { width: 160px; min-width: 160px; color:#64748b; font-weight: 600; }
  .pf-v { color:#0f172a; word-break: break-word; }

  .pf-muted { color:#94a3b8; }
  .pf-empty {
    border: 2px dashed #cbd5e1; background: #f8fafc; border-radius: 16px; padding: 28px; text-align: center;
  }
  .pf-empty .btn { border-radius: 999px; }

  /* Grid responsif */
  .pf-grid { display: grid; grid-template-columns: 1fr; gap: var(--pf-gap); }

  /* Enhancements kecil untuk alignment judul/lokasi vs tombol */
  .pf-head { display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:.75rem; }
  .pf-main { min-width: 240px; }

  /* ====== RESPONSIVE ====== */
  @media (min-width: 576px) {
    .pf-title { font-size: 1.5rem; max-width: 42ch; }
    .pf-sub { font-size: 1rem; }
  }
  @media (min-width: 768px) {
    .pf-avatar { width: 128px; height: 128px; bottom: -64px; }
    .pf-body { padding: 88px 24px 24px; }
  }
  @media (min-width: 992px) {
    .pf-grid { grid-template-columns: 360px 1fr; }
    .pf-cover { height: 160px; }
    .pf-avatar { width: 132px; height: 132px; bottom: -66px; }
    .pf-body { padding: 96px 24px 24px; }
  }
  @media (min-width: 1200px) {
    .pf-title { font-size: 1.6rem; }
    .pf-avatar { width: 140px; height: 140px; bottom: -70px; }
    .pf-body { padding: 104px 28px 28px; }
  }

  /* Preferensi user: reduce motion */
  @media (prefers-reduced-motion:no-preference) {
    .pf-card, .pf-section { transition: box-shadow .2s ease, transform .2s ease; }
    .pf-card:hover, .pf-section:hover { box-shadow: 0 12px 28px rgba(16,24,40,.09); transform: translateY(-1px); }
  }

  .pf-card{
  border:1px solid rgba(0,0,0,.06);
  border-radius:18px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 6px 24px rgba(0,0,0,.06);
  transition:transform .2s ease, box-shadow .2s ease;
}
.pf-card:hover{
  transform:translateY(-2px);
  box-shadow:0 10px 28px rgba(0,0,0,.1);
}

/* Cover & avatar */
.pf-cover{
  position:relative;
  height:120px; /* tinggi cover */
  background:linear-gradient(135deg,#E8F3FF, #F7F9FF);
}
.pf-cover__bg{
  position:absolute; inset:0;
  background-image: radial-gradient(40% 60% at 20% 20%, rgba(0,117,255,.08) 0, transparent 60%),
                    radial-gradient(50% 70% at 90% 10%, rgba(255,184,0,.10) 0, transparent 60%);
}
.pf-avatar{
  width:96px; height:96px;
  object-fit:cover; object-position:center;
  border-radius:50%;
  position:absolute; left:24px; bottom:-48px;
  border:4px solid #fff; /* ring putih */
  box-shadow:0 8px 24px rgba(0,0,0,.15);
}

/* Body */
.pf-body{ padding:64px 24px 24px 24px; } /* 64px krn avatar overlap */
.pf-head .pf-title{
  font-size:1.25rem; font-weight:700; margin:0;
}
.pf-sub{ color:#6b7280; font-size:.95rem; }

/* Chip/Badge link */
.pf-chip{
  display:inline-block;
  padding:.35rem .6rem;
  background:#F3F4F6;
  border:1px solid #E5E7EB;
  border-radius:999px;
  font-size:.85rem;
  color:#374151; text-decoration:none;
}
.pf-chip:hover{ background:#EEF2FF; border-color:#E0E7FF; }

/* Stats */
.pf-stats{
  list-style:none; padding:0; margin:0;
  display:flex; gap:16px; flex-wrap:wrap;
}
.pf-stat{
  min-width:120px;
  padding:.9rem 1rem;
  border:1px solid #EEF2F7;
  background:#FAFBFF;
  border-radius:14px;
}
.pf-stat__num{
  font-size:1.25rem; font-weight:800; line-height:1;
}
.pf-stat__label{
  font-size:.85rem; color:#6b7280; margin-top:.25rem;
}

/* Buttons */
.pf-btn--pill{
  border-radius:999px;
  padding:.6rem 1.15rem;
  font-weight:600;
}

/* Responsif kecil */
@media (max-width: 576px){
  .pf-avatar{ left:16px; bottom:-44px; width:88px; height:88px; }
  .pf-body{ padding:60px 16px 16px 16px; }
  .pf-stat{ min-width:calc(50% - 8px); }
}

</style>


<div class="container py-4 pf-wrap">

  @php
      $seed   = (int) ($pokdarwis->visit_count_manual ?? 0);
  $clicks = (int) ($pokdarwis->visit_count_auto ?? 0);
  $total  = $seed + $clicks;
    @endphp


  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @unless($pdw)
    <div class="pf-empty">
      <h5 class="mb-2">Belum ada profil Pokdarwis</h5>
      <p class="pf-muted mb-3">Lengkapi profil untuk menampilkan informasi Anda kepada wisatawan.</p>
      <a href="{{ route('profile.edit') }}" class="btn btn-primary">
        <i class="fas fa-user-plus me-1"></i> Buat/Isi Profil
      </a>
    </div>
  @endunless

  @if($pdw)
    <div class="pf-grid">

      <div class="pf-card mb-3 mb-lg-0">
  <div class="pf-cover">
    <div class="pf-cover__bg"></div>
    <img class="pf-avatar"
         src="{{ $avatar }}"
         alt="Avatar {{ $pdw->name_pokdarwis }}"
         onerror="this.onerror=null;this.src='{{ asset('assets/images/default.png') }}'">
  </div>

  <div class="pf-body">
    <div class="pf-head d-flex flex-wrap align-items-center justify-content-between gap-2">
      <div class="pf-ident">
        <h3 class="pf-title mb-1">{{ $pdw->name_pokdarwis }}</h3>
        <div class="pf-sub"><i class="fa-solid fa-location-dot me-1"></i>{{ $pdw->lokasi ?: '— Lokasi belum diisi —' }}</div>
      </div>

      {{-- Badge opsional --}}
      {{-- @if($pdw->slug)
        <a class="pf-chip" href="{{ url('/tour/'.$pdw->slug) }}" target="_blank" rel="noopener">/tour/{{ $pdw->slug }}</a>
      @endif --}}
    </div>

    <ul class="pf-stats mt-4">
      <li class="pf-stat">
        <div class="pf-stat__num">{{ number_format($total,0,',','.') }}</div>
        <div class="pf-stat__label">Kunjungan Wisatawan</div>
      </li>
    </ul>

    <div class="pf-actions d-flex flex-wrap gap-2 mt-3">
      <a href="{{ route('profile.edit') }}"
         class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-sm pf-btn--pill">
        <i class="fa-solid fa-user-pen"></i>
        <span>Edit Profile</span>
      </a>
      {{-- Tombol lihat halaman (opsional)
      <a href="{{ url('/tour/'.($pdw->slug ?? '')) }}" class="btn btn-outline-secondary pf-btn--pill" target="_blank">
        <i class="fas fa-eye me-1"></i> Lihat Halaman
      </a>
      --}}
    </div>
  </div>
</div>


      <div class="d-flex flex-column gap-3">
        <div class="pf-section">
          <div class="pf-h5">Tentang</div>
          <p class="mb-2"><strong>Deskripsi</strong></p>
          <p class="{{ $pdw->deskripsi ? '' : 'pf-muted' }}">{{ $pdw->deskripsi ?: '— Belum diisi —' }}</p>
          <p class="mb-2 mt-3"><strong>Deskripsi Tambahan (UI Wisatawan)</strong></p>
          <p class="{{ $pdw->deskripsi2 ? '' : 'pf-muted' }}">{{ $pdw->deskripsi2 ?: '— Belum diisi —' }}</p>
        </div>

        <div class="pf-section">
          <div class="pf-h5">Kontak & Sosial</div>
          <ul class="pf-kv">
            <li><div class="pf-k">Kontak</div><div class="pf-v">{{ $pdw->kontak ?: '—' }}</div></li>
            <li><div class="pf-k">Phone</div><div class="pf-v">{{ $pdw->phone ?: '—' }}</div></li>
            <li><div class="pf-k">Email</div><div class="pf-v">{{ $pdw->email ?: '—' }}</div></li>
            <li><div class="pf-k">Facebook</div><div class="pf-v">{{ $pdw->facebook ?: '—' }}</div></li>
            <li><div class="pf-k">Twitter</div><div class="pf-v">{{ $pdw->twitter ?: '—' }}</div></li>
            <li><div class="pf-k">Instagram</div><div class="pf-v">{{ $pdw->instagram ?: '—' }}</div></li>
            <li><div class="pf-k">Website</div><div class="pf-v">{{ $pdw->website ?: '—' }}</div></li>
          </ul>
        </div>
      </div>

    </div>
  @endif
</div>
