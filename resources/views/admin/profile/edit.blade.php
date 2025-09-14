@extends('layouts.app-backend')

@section('page-title', 'Edit Profile')

@section('page-header')
  <h2 class="mb-0">Edit Profile Pokdarwis</h2>
@endsection

@section('page-breadcrumb')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Profile</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
  </nav>
@endsection

@section('main')
<style>
  .card-rounded { border:1px solid #e5e7eb; border-radius:16px; box-shadow:0 10px 22px rgba(16,24,40,.06); }
  .section-title { font-weight:700; font-size:1.05rem; color:#0f172a; margin-bottom:1rem; }
  .help { font-size:.85rem; color:#64748b; }
  .avatar-preview { width:120px;height:120px;border-radius:50%;object-fit:cover;border:1px solid #e5e7eb; }
  .label-icon i { width:18px; text-align:center; margin-right:.4rem; color:#475569; }
</style>

<div class="container py-4">
  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">

      {{-- ========== Kolom Kiri: Info Utama + Avatar ========== --}}
      <div class="col-lg-7">
        <div class="card card-rounded">
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            {{-- Avatar (live preview) --}}
            @php
              $imgNow = $pokdarwis->img ? asset('storage/'.$pokdarwis->img) : asset('assets/images/default.png');
            @endphp
            <div class="mb-4">
              <div class="d-flex align-items-center gap-3">
                <img id="previewImg" src="{{ $imgNow }}" alt="avatar" class="avatar-preview">
                <div>
                  <label class="form-label mb-1">Foto Profil</label>
                  <input type="file" name="img" id="f_img" class="form-control" accept="image/*">
                  <div class="help">Maks 2MB. Format: JPG/PNG/WEBP.</div>
                </div>
              </div>
            </div>

            <hr>

            {{-- Nama --}}
            <div class="mb-3">
              <label class="form-label">Nama Pokdarwis</label>
              <input type="text" name="name_pokdarwis" class="form-control"
                     value="{{ old('name_pokdarwis', $pokdarwis->name_pokdarwis) }}" required>
            </div>

            {{-- Slug (opsional) --}}
            {{-- <div class="mb-3">
              <label class="form-label">Slug (URL)</label>
              <input type="text" name="slug" class="form-control"
                     value="{{ old('slug', $pokdarwis->slug) }}">
              <div class="help">Biarkan kosong untuk auto-generate dari nama.</div>
            </div> --}}

            {{-- Lokasi --}}
            <div class="mb-3">
              <label class="form-label">Lokasi</label>
              <input type="text" name="lokasi" class="form-control"
                     value="{{ old('lokasi', $pokdarwis->lokasi) }}">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
              <label class="form-label">Deskripsi</label>
              <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $pokdarwis->deskripsi) }}</textarea>
            </div>

            {{-- Deskripsi 2 --}}
            <div class="mb-0">
              <label class="form-label">Deskripsi Tambahan (UI Wisatawan)</label>
              <textarea name="deskripsi2" rows="3" class="form-control">{{ old('deskripsi2', $pokdarwis->deskripsi2) }}</textarea>
            </div>
          </div>
        </div>
      </div>

      {{-- ========== Kolom Kanan: Kontak & Media Sosial ========== --}}
      <div class="col-lg-5">

        {{-- Kontak --}}
        <div class="card card-rounded mb-4">
          <div class="card-body">
            <div class="section-title">Kontak</div>

            <div class="mb-3">
              <label class="form-label">Kontak (PIC)</label>
              <input type="text" name="kontak" class="form-control"
                     value="{{ old('kontak', $pokdarwis->kontak) }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Phone</label>
              <input type="text" name="phone" class="form-control"
                     value="{{ old('phone', $pokdarwis->phone) }}">
            </div>

            <div class="mb-0">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control"
                     value="{{ old('email', $pokdarwis->email) }}">
            </div>
          </div>
        </div>

        {{-- Media Sosial --}}
        <div class="card card-rounded">
          <div class="card-body">
            <div class="section-title">Media Sosial</div>

            <div class="mb-3">
              <label class="form-label label-icon"><i class="fab fa-facebook-f"></i> Facebook (URL)</label>
              <input type="url" name="facebook" class="form-control"
                     value="{{ old('facebook', $pokdarwis->facebook) }}">
            </div>

            <div class="mb-3">
              <label class="form-label label-icon"><i class="fab fa-twitter"></i> Twitter (URL)</label>
              <input type="url" name="twitter" class="form-control"
                     value="{{ old('twitter', $pokdarwis->twitter) }}">
            </div>

            <div class="mb-3">
              <label class="form-label label-icon"><i class="fab fa-instagram"></i> Instagram (URL)</label>
              <input type="url" name="instagram" class="form-control"
                     value="{{ old('instagram', $pokdarwis->instagram) }}">
            </div>

            <div class="mb-0">
              <label class="form-label label-icon"><i class="fas fa-globe"></i> Website (URL)</label>
              <input type="url" name="website" class="form-control"
                     value="{{ old('website', $pokdarwis->website) }}">
            </div>
          </div>
        </div>

      </div>
    </div>

    {{-- Tombol Simpan --}}
    <div class="text-end mt-4">
      <a href="{{ route('profile.index') }}" class="btn btn-secondary">Batal</a>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

  </form>
</div>

{{-- ===== JS Preview: hanya untuk foto ===== --}}
<script>
  (function(){
    const fImg = document.getElementById('f_img');
    const preview = document.getElementById('previewImg');
    if (!fImg || !preview) return;
    fImg.addEventListener('change', (e)=>{
      const file = e.target.files && e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = ev => { preview.src = ev.target.result; };
      reader.readAsDataURL(file);
    });
  })();
</script>
@endsection
