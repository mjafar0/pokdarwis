@extends('layouts.app-backend')
@section('page-title','Upload • Produk')

@section('page-breadcrumb')
@endsection

@section('page-header')
  <nav class="admin-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="#">Upload</a></li>
      <li class="breadcrumb-item active" aria-current="page">Produk</li>
    </ol>
  </nav>

  <div class="mb-4"></div>

  <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-2">
      <h3 class="mb-0">Produk Saya</h3>
      <span class="badge bg-light text-secondary border">{{ number_format($products->total()) }} item</span>
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-outline-secondary" onclick="location.reload()">
        <i class="fa-solid fa-rotate"></i>
      </button>
      <button type="button" class="btn btn-primary"
        data-bs-toggle="modal" data-bs-target="#modalAddProduct">
        <i class="fas fa-plus me-2"></i>Add Product
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

  @if($products->count() === 0)
    <div class="card border-0 shadow-sm">
      <div class="card-body text-center py-5">
        <img src="{{ asset('assets/images/site-logo.png') }}" class="mb-3 rounded-3" style="width:200px;height:120px;object-fit:cover;opacity:.3">
        <h5 class="mb-1">Belum ada produk</h5>
        <p class="text-muted mb-3">Klik tombol <b>“Add Product”</b> untuk menambahkan produk pertamamu.</p>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
          <i class="fa-solid fa-plus me-1"></i> Add Product
        </button>
      </div>
    </div>
  @else
    <div class="row g-4">
      @foreach($products as $p)
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="card h-100 border-0 shadow-sm product-card">
            <div class="position-relative rounded-top overflow-hidden" style="aspect-ratio:16/10;background:#f7f7f9">
              <img src="{{ $p->image_url }}" alt="{{ $p->name_product }}" class="w-100 h-100" style="object-fit:cover;">
              <span class="price-chip shadow-sm">Rp {{ number_format($p->harga_product,0,',','.') }}</span>
            </div>

            <div class="card-body">
              <h5 class="card-title mb-1 text-truncate" title="{{ $p->name_product }}">{{ $p->name_product }}</h5>
              @if($p->deskripsi)
                <p class="card-text text-muted small mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($p->deskripsi), 110) }}</p>
              @else
                <p class="card-text text-muted small mb-0 fst-italic">Belum ada deskripsi.</p>
              @endif
            </div>

            <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">
              <div class="d-flex gap-2">
                <button
                  class="btn btn-outline-primary btn-sm flex-fill btn-edit"
                  data-id="{{ $p->id }}"
                  data-name="{{ $p->name_product }}"
                  data-harga="{{ $p->harga_product }}"
                  data-deskripsi="{{ $p->deskripsi }}"
                  data-detail="{{ $p->detail_tambahan }}"
                  data-img="{{ $p->image_url }}"
                  data-update-url="{{ route('pokdarwis.product.update', $p) }}"
                  data-bs-toggle="modal" data-bs-target="#modalEdit">
                  <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                </button>

                <form action="{{ route('pokdarwis.product.destroy',$p) }}" method="POST" class="flex-fill"
                      onsubmit="return confirm('Hapus produk ini?');">
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
      {{ $products->onEachSide(1)->links() }}
    </div>
  @endif
  

  {{-- Modal Add Product --}}
  <div class="modal fade" id="modalAddProduct" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fa-solid fa-box me-2"></i>Tambah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('pokdarwis.product.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-8">
                <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                <input type="text" name="name_product" class="form-control" placeholder="Contoh: Madu Hutan 250ml" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                <input type="number" min="0" name="harga_product" class="form-control" placeholder="25000" required>
              </div>

              <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="form-control" placeholder="Ceritakan singkat tentang produk..."></textarea>
              </div>

              <div class="col-12">
                <label class="form-label">Detail Tambahan</label>
                <textarea name="detail_tambahan" rows="2" class="form-control" placeholder="Komposisi, ukuran, catatan, dll. (opsional)"></textarea>
              </div>

              <div class="col-md-6">
                <label class="form-label">Gambar Produk</label>
                <input type="file" name="img" class="form-control" accept="image/*" onchange="previewAdd(this)">
                <div class="form-text">PNG/JPG/WEBP maks 3MB.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Preview</label>
                <div class="preview-box">
                  <img id="imgPreviewAdd" src="{{ asset('assets/images/site-logo.png') }}" alt="preview"
                      style="max-height:100%;max-width:100%;object-fit:contain;">
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary">
              <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

  {{-- Modal Edit Product --}}
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header">
        <h5 class="modal-title">Edit Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="formEdit" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $e)
                  <li>{{ $e }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="row g-3">
            <div class="col-md-8">
              <label class="form-label">Nama Produk</label>
              <input type="text" name="name_product" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Harga (Rp)</label>
              <input type="number" min="0" name="harga_product" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">Deskripsi</label>
              <textarea name="deskripsi" rows="3" class="form-control"></textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Detail Tambahan</label>
              <textarea name="detail_tambahan" rows="2" class="form-control"></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">Gambar</label>
              <input type="file" name="img" class="form-control" accept="image/*" onchange="previewEdit(this)">
            </div>
            <div class="col-md-6">
              <label class="form-label d-block">Preview</label>
              <div class="preview-box">
                <img id="imgPreviewEdit" src="{{ asset('assets/images/site-logo.png') }}" alt="preview"
                    style="max-height:100%;max-width:100%;object-fit:contain;">
              </div>
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
    .product-card{ transition: .2s ease; }
    .product-card:hover{ transform: translateY(-2px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.08)!important; }
    .price-chip{
      position:absolute; right:.75rem; bottom:.75rem;
      background:#fff; border:1px solid rgba(0,0,0,.06);
      padding:.3rem .55rem; border-radius:.6rem; font-weight:600; font-size:.85rem;
    }
  </style>
@endpush

@push('scripts')
<script>
  // isi form edit saat tombol Edit diklik
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-edit').forEach(btn => {
      btn.addEventListener('click', function () {
        const f = document.getElementById('formEdit');
        f.action = this.dataset.updateUrl;
        f.querySelector('input[name="name_product"]').value       = this.dataset.name || '';
        f.querySelector('input[name="harga_product"]').value      = this.dataset.harga || '';
        f.querySelector('textarea[name="deskripsi"]').value       = this.dataset.deskripsi || '';
        f.querySelector('textarea[name="detail_tambahan"]').value = this.dataset.detail || '';
        document.getElementById('imgPreviewEdit').src             = this.dataset.img || "{{ asset('assets/images/site-logo.png') }}";
      });
    });
  });

  // Preview khusus ADD
  function previewAdd(input) {
    const img = document.getElementById('imgPreviewAdd');
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = e => img.src = e.target.result;
      reader.readAsDataURL(input.files[0]);
    } else {
      img.src = "{{ asset('assets/images/site-logo.png') }}";
    }
  }

  // Preview khusus EDIT
  function previewEdit(input) {
    const img = document.getElementById('imgPreviewEdit');
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = e => img.src = e.target.result;
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endpush

@push('styles')
<style>
  /* tinggi aman untuk body modal (Add & Edit) */
  #modalAddProduct .modal-body,
  #modalEdit .modal-body{
    max-height: calc(100vh - 180px);   /* sesuaikan jika header/footer tinggi */
    overflow-y: auto;
  }

  /* Footer nempel di bawah saat scroll */
  #modalAddProduct .modal-footer,
  #modalEdit .modal-footer{
    position: sticky;
    bottom: 0;
    background: #fff;
    z-index: 10;
  }

  /* kotak preview seragam */
  .preview-box{
    height: 200px;                      /* boleh 220–300 sesuai selera */
    background: #f7f7f9;
    border-radius: .5rem;
    overflow: hidden;
    display: flex; align-items: center; justify-content: center;
  }
</style>
@endpush