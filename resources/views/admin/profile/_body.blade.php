<style>
  .pf-wrap { --gap: 1.25rem; }
  .pf-card { border: 1px solid #e5e7eb; border-radius: 16px; overflow: hidden; background: #fff; box-shadow: 0 10px 22px rgba(16,24,40,.06); }
  .pf-cover { height: 140px; background: linear-gradient(135deg, #2563eb 0%, #22c55e 100%); position: relative; }
  .pf-avatar { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 8px 20px rgba(2,6,23,.15); position: absolute; left: 24px; bottom: -60px; background:#fff; }
  .pf-body { padding: 80px 24px 24px; }
  .pf-title { margin: 0; font-weight: 700; font-size: 1.375rem; color: #0f172a; }
  .pf-sub { color:#6b7280; margin-top: 4px; }
  .pf-badges .badge { background: #f1f5f9; color:#0f172a; border-radius: 999px; padding: .375rem .6rem; font-weight: 600; }
  .pf-actions .btn { border-radius: 999px; padding: .45rem .9rem; font-weight: 600; }
  .pf-section { border: 1px solid #e5e7eb; border-radius: 16px; background:#fff; padding: 20px; box-shadow: 0 6px 16px rgba(16,24,40,.05); }
  .pf-h5 { font-size: 1.05rem; font-weight: 700; margin-bottom: .75rem; color:#0f172a; }
  .pf-kv { margin: 0; padding: 0; list-style: none; }
  .pf-kv li { display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px dashed #e5e7eb; }
  .pf-kv li:last-child { border-bottom: 0; }
  .pf-k { width: 160px; min-width: 160px; color:#64748b; font-weight: 600; }
  .pf-v { color:#0f172a; }
  .pf-muted { color:#94a3b8; }
  .pf-empty { border: 2px dashed #cbd5e1; background: #f8fafc; border-radius: 16px; padding: 28px; text-align: center; }
  .pf-empty .btn { border-radius: 999px; }
  @media (min-width: 992px) {
    .pf-grid { display: grid; grid-template-columns: 360px 1fr; gap: var(--gap); }
  }
</style>

<div class="container py-4 pf-wrap">
  {{-- Penanda untuk debug: kalau ini terlihat, partial ter-render --}}
  <div class="small text-muted mb-2">[profile/_body loaded]</div>

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
          <img src="{{ $avatar }}" alt="Avatar" class="pf-avatar"
               onerror="this.onerror=null;this.src='{{ asset('assets/images/default.png') }}'">
        </div>
        <div class="pf-body">
          <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div>
              <h3 class="pf-title">{{ $pdw->name_pokdarwis }}</h3>
              <div class="pf-sub">{{ $pdw->lokasi ?: '— Lokasi belum diisi —' }}</div>
            </div>
            <div class="pf-badges d-flex gap-2">
              <span class="badge">Pokdarwis</span>
              @if($pdw->slug)
                <span class="badge">/tour/{{ $pdw->slug }}</span>
              @endif
            </div>
          </div>

          <div class="pf-actions d-flex flex-wrap gap-2 mt-3">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
              <i class="fas fa-pen me-1"></i> Edit Profile
            </a>
            <a href="{{ url('/tour/'.($pdw->slug ?? '')) }}" class="btn btn-outline-secondary" target="_blank">
              <i class="fas fa-eye me-1"></i> Lihat Halaman
            </a>
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
