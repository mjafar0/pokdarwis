@extends('layouts.app-backend')
@section("page-title")
    Users
@endsection
@section('page-header')
    {{-- <div class="admin-page-header d-flex align-items-center justify-content-between">
        <div>
            <h1>Users</h1>
            <small class="text-muted">Mengelola user admin</small>
        </div>
        <div class="header-btn">
            <a href="" class="round-btn">+ Add User</a>
        </div>
    </div> --}}
@endsection

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables/datatables.min.css') }}">
@endsection


@section('main')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="alert alert-light border d-flex align-items-center">
            <strong class="me-2">MASUKKAN DATA PAKET</strong>
        </div>
        <div class="card-body">
        
            <form action="{{ route('pokdarwis.paket.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf

            <div class="col-md-6">
                <label class="form-label">Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" required value="{{ old('nama_paket') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Durasi / Waktu Penginapan</label>
                <input type="text" name="waktu_penginapan" class="form-control" placeholder="3D/2N" value="{{ old('waktu_penginapan') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Pax</label>
                <input type="number" name="pax" class="form-control" min="1" value="{{ old('pax') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Harga</label>
                <input type="number" step="0.01" min="0" name="harga" class="form-control" required value="{{ old('harga') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Currency</label>
                <select name="currency" class="form-select">
                    <option value="IDR" {{ old('currency')=='IDR'?'selected':'' }}>IDR</option>
                    <option value="USD" {{ old('currency')=='USD'?'selected':'' }}>USD</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Cover (Gambar)</label>
                <input type="file" name="img" accept="image/*" class="form-control">
                <small class="text-muted">JPEG/PNG/WEBP maks 5MB.</small>
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi') }}</textarea>
            </div>

            {{-- Fasilitas --}}
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Include</label>
                    <div id="include-wrap">
                        <div class="input-group mb-2">
                            <input type="text" name="include_items[]" class="form-control" placeholder="Private Transport">
                            <button type="button" class="btn btn-outline-secondary add-include">+</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Exclude</label>
                    <div id="exclude-wrap">
                        <div class="input-group mb-2">
                            <input type="text" name="exclude_items[]" class="form-control" placeholder="Any Private Expenses">
                            <button type="button" class="btn btn-outline-secondary add-exclude">+</button>
                        </div>
                    </div>
                </div>
            </div>

            @push('scripts')
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                function addRow(wrapperId, inputName) {
                    const wrap = document.getElementById(wrapperId);
                    const row = document.createElement('div');
                    row.className = 'input-group mb-2';
                    row.innerHTML = `
                        <input type="text" name="${inputName}[]" class="form-control">
                        <button type="button" class="btn btn-outline-danger remove-row">&times;</button>
                    `;
                    wrap.appendChild(row);
                }

                document.body.addEventListener('click', function(e){
                    if (e.target.classList.contains('add-include')) addRow('include-wrap', 'include_items');
                    if (e.target.classList.contains('add-exclude')) addRow('exclude-wrap', 'exclude_items');
                    if (e.target.classList.contains('remove-row')) e.target.parentElement.remove();
                });
            });
            </script>
            @endpush

            <div class="col-12">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
            

        </div>
    </div>
  </div>
@endsection

@section('page-breadcrumb')
<nav class="admin-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="">Upload</a></li>
      <li class="breadcrumb-item active" aria-current="page">Upload Paket</li>
    </ol>
  </nav>
@endsection

@section('page-scripts')
<script src="{{ asset('assets/vendors/datatables/datatables.min.js') }}" defer></script>
<script src="{{ asset('assets/js/settings/settings-user.js') }}" defer></script>
@endsection

