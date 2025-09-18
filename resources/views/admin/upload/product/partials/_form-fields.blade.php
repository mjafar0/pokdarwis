@php($edit = $edit ?? ($isEdit ?? false))

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
    <input type="file" name="img" class="form-control" accept="image/*"
           data-preview="{{ $edit ? 'previewEdit' : 'previewAdd' }}">
    <div class="small text-muted mt-1">JPEG/PNG/WEBP maks 5MB.</div>
  </div>

  <div class="col-md-6">
    <label class="form-label d-block">Preview</label>
    <img id="{{ $edit ? 'previewEdit' : 'previewAdd' }}"
         src="{{ $edit ? '' : asset('assets/images/noimage.jpg') }}"
         class="rounded border bg-light"
         style="width:100%;max-height:180px;object-fit:cover;">
  </div>
</div>
