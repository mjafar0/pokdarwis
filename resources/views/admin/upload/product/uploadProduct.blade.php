@extends('layouts.app-backend')
@section('page-title','Upload • Produk')

@section('page-header')
  <h3 class="mb-0">Upload Produk</h3>
@endsection

@section('main')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('pokdarwis.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.upload.product.partials._form')
        <div class="mt-3 d-flex gap-2">
          <button class="btn btn-primary">Simpan</button>
          <a href="{{ route('pokdarwis.product.index') }}" class="btn btn-light">Kembali ke Daftar</a>
        </div>
      </form>
    </div>
  </div>
@endsection
