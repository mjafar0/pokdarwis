@extends('layouts.app-backend')
@section('page-title','Upload • Paket')

@section('page-header')
  <nav class="admin-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="#">Upload</a></li>
      <li class="breadcrumb-item active" aria-current="page">Paket Wisata</li>
    </ol>
  </nav>

  <div class="mb-4"></div>

  <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-2">
      <h3 class="mb-0">Paket Saya</h3>
      <span class="badge bg-light text-secondary border">{{ number_format($pakets->total()) }} item</span>
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-outline-secondary" onclick="location.reload()">
        <i class="fa-solid fa-rotate"></i>
      </button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddPaket">
        <i class="fas fa-plus me-2"></i>Add Paket
      </button>
    </div>
  </div>
@endsection

@section('main')
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if($pakets->count() === 0)
    <div class="card border-0 shadow-sm">
      <div class="card-body text-center py-5">
        <img src="{{ asset('assets/images/site-logo.png') }}" class="mb-3 rounded-3" style="width:200px;height:120px;object-fit:cover;opacity:.3">
        <h5 class="mb-1">Belum ada paket</h5>
        <p class="text-muted mb-3">Klik tombol <b>“Add Paket”</b> untuk menambahkan paket pertamamu.</p>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddPaket">
          <i class="fa-solid fa-plus me-1"></i> Add Paket
        </button>
      </div>
    </div>
  @else
    <div class="row g-4">
      @foreach($pakets as $pk)
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="card h-100 border-0 shadow-sm paket-card">
            <div class="position-relative rounded-top overflow-hidden" style="aspect-ratio:16/10;background:#f7f7f9">
              <img src="{{ $pk->cover_url }}" alt="{{ $pk->nama_paket }}" class="w-100 h-100" style="object-fit:cover;">
              <span class="price-chip shadow-sm">Rp {{ number_format($pk->harga,0,',','.') }}</span>
            </div>

            <div class="card-body">
              <h5 class="card-title mb-1 text-truncate" title="{{ $pk->nama_paket }}">{{ $pk->nama_paket }}</h5>
              <div class="text-muted small mb-2">
                {{ $pk->waktu_penginapan }} · {{ $pk->pax }} pax · {{ $pk->lokasi }}
              </div>
              @if($pk->deskripsi)
                <p class="card-text text-muted small mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($pk->deskripsi), 110) }}</p>
              @else
                <p class="card-text text-muted small mb-0 fst-italic">Belum ada deskripsi.</p>
              @endif
            </div>

            <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">
              <div class="d-flex gap-2">
                <button
                  class="btn btn-outline-primary btn-sm flex-fill btn-edit"
                  data-update-url="{{ route('pokdarwis.paket.update', $pk) }}"
                  data-nama="{{ $pk->nama_paket }}"
                  data-harga="{{ $pk->harga }}"
                  data-durasi="{{ $pk->waktu_penginapan }}"
                  data-pax="{{ $pk->pax }}"
                  data-lokasi="{{ $pk->lokasi }}"
                  data-deskripsi="{{ $pk->deskripsi }}"
                  data-currency="{{ $pk->currency ?? 'IDR' }}"
                  data-img="{{ $pk->cover_url }}"
                  data-bs-toggle="modal" data-bs-target="#modalEditPaket">
                  <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                </button>

                <form action="{{ route('pokdarwis.paket.destroy',$pk) }}" method="POST" class="flex-fill"
                      onsubmit="return confirm('Hapus paket ini?');">
                  @csrf @method('DELETE')
                  <button class="btn btn-outline-danger btn-sm w-100">
                    <i class="fa-solid fa-trash me-1"></i> Hapus
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-4">
      {{ $pakets->onEachSide(1)->links() }}
    </div>
  @endif

  {{-- Modal Add Paket (scrollable) --}}
  <div class="modal fade has-scroll" id="modalAddPaket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fa-solid fa-box me-2"></i>Tambah Paket</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('pokdarwis.paket.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-8">
                <label class="form-label">Nama Paket <span class="text-danger">*</span></label>
                <input type="text" name="nama_paket" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                <input type="number" min="0" name="harga" class="form-control" required>
              </div>

              <div class="col-md-4">
                <label class="form-label">Durasi</label>
                <input type="text" name="waktu_penginapan" class="form-control" placeholder="3D/2N">
              </div>
              <div class="col-md-4">
                <label class="form-label">Pax</label>
                <input type="number" min="1" name="pax" class="form-control" value="1">
              </div>
              <div class="col-md-4">
                <label class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control">
              </div>

              <div class="col-md-4">
                <label class="form-label">Currency</label>
                <select name="currency" class="form-select">
                  <option value="IDR" selected>IDR</option>
                  <option value="USD">USD</option>
                </select>
              </div>

              <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="form-control"></textarea>
              </div>

              <div class="col-md-6">
                <label class="form-label">Cover</label>
                <input type="file" name="img" class="form-control" accept="image/*" onchange="previewAdd(this)">
                <div class="form-text">PNG/JPG/WEBP maks 3MB.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Preview</label>
                <div class="border rounded-3 bg-light d-flex align-items-center justify-content-center overflow-hidden" style="height:180px;">
                  <img id="addPreview" src="{{ asset('assets/images/site-logo.png') }}" style="max-height:100%;max-width:100%;object-fit:contain;">
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Modal Edit Paket (scrollable) --}}
  <div class="modal fade has-scroll" id="modalEditPaket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header">
          <h5 class="modal-title">Edit Paket</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="formEditPaket" action="#" method="POST" enctype="multipart/form-data">
          @csrf @method('PUT')
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-8">
                <label class="form-label">Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" min="0" name="harga" class="form-control" required>
              </div>

              <div class="col-md-4">
                <label class="form-label">Durasi</label>
                <input type="text" name="waktu_penginapan" class="form-control">
              </div>
              <div class="col-md-4">
                <label class="form-label">Pax</label>
                <input type="number" min="1" name="pax" class="form-control">
              </div>
              <div class="col-md-4">
                <label class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control">
              </div>

              <div class="col-md-4">
                <label class="form-label">Currency</label>
                <select name="currency" class="form-select">
                  <option value="IDR">IDR</option>
                  <option value="USD">USD</option>
                </select>
              </div>

              <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="form-control"></textarea>
              </div>

              <div class="col-md-6">
                <label class="form-label">Cover</label>
                <input type="file" name="img" class="form-control" accept="image/*" onchange="previewEdit(this)">
              </div>
              <div class="col-md-6">
                <label class="form-label d-block">Preview</label>
                <img id="editPreview" src="{{ asset('assets/images/site-logo.png') }}" style="max-height:100%;max-width:100%;object-fit:contain;">
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('styles')
<style>
  .paket-card{ transition:.2s ease }
  .paket-card:hover{ transform:translateY(-2px); box-shadow:0 .5rem 1rem rgba(0,0,0,.08)!important }
  .price-chip{
    position:absolute; right:.75rem; bottom:.75rem;
    background:#fff; border:1px solid rgba(0,0,0,.06);
    padding:.3rem .55rem; border-radius:.6rem; font-weight:600; font-size:.85rem;
  }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
  // Preview ADD
  function previewAdd(input){
    const img = document.getElementById('addPreview');
    if (input.files && input.files[0]) {
      const r = new FileReader();
      r.onload = e => img.src = e.target.result;
      r.readAsDataURL(input.files[0]);
    }
  }
  // Preview EDIT
  function previewEdit(input){
    const img = document.getElementById('editPreview');
    if (input.files && input.files[0]) {
      const r = new FileReader();
      r.onload = e => img.src = e.target.result;
      r.readAsDataURL(input.files[0]);
    }
  }

  // Populate Edit modal
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btn-edit').forEach(btn => {
      btn.addEventListener('click', function(){
        const f = document.getElementById('formEditPaket');
        f.action = this.dataset.updateUrl;

        f.querySelector('input[name="nama_paket"]').value       = this.dataset.nama || '';
        f.querySelector('input[name="harga"]').value            = this.dataset.harga || '';
        f.querySelector('input[name="waktu_penginapan"]').value = this.dataset.durasi || '';
        f.querySelector('input[name="pax"]').value              = this.dataset.pax || '';
        f.querySelector('input[name="lokasi"]').value           = this.dataset.lokasi || '';
        f.querySelector('textarea[name="deskripsi"]').value     = this.dataset.deskripsi || '';
        const curSel = f.querySelector('select[name="currency"]');
        if (curSel) curSel.value = this.dataset.currency || 'IDR';

        const prev = document.getElementById('editPreview');
        prev.src = this.dataset.img || "{{ asset('assets/images/site-logo.png') }}";
      });
    });
  });
</script>
@endpush

@push('styles')
<style>
  /* Biar body modal selalu bisa discroll dan tombol tetap terlihat */
  .has-scroll .modal-body{
    max-height: calc(100vh - 200px); /* header+footer ≈ 200px */
    overflow-y: auto;
  }

  /* Batasi tinggi kotak preview agar tidak “mendorong” tombol ke bawah */
  .preview-box{
    height: 220px;               /* bebas: 180–260px */
    background: #f7f7f9;
    border-radius: .5rem;
  }
  .preview-box img{
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;         /* gambar utuh */
    display: block;
    margin: 0 auto;
  }

  /* Sedikit ruang di sisi kanan supaya tidak “nempel” scrollbar */
  .has-scroll .modal-body > .row { margin-right: .25rem; }
</style>
@endpush

