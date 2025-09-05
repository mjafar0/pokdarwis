@extends('layouts.app-backend')
@section("page-title")
    Users
@endsection
@section('page-header')
    <div class="admin-page-header d-flex align-items-center justify-content-between">
        <div>
            <h1>Users</h1>
            <small class="text-muted">Mengelola user admin</small>
        </div>
        <div class="header-btn">
            <a href="" class="round-btn">+ Add User</a>
        </div>
    </div>
@endsection

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables/datatables.min.css') }}">
@endsection


@section('main')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="alert alert-light border d-flex align-items-center">
            <strong class="me-2">User admin</strong>
        </div>
        <div class="card-body">
        <table class="table table-sm" id="daftar-user-admin">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>            
        </table>
        </div>
    </div>
  </div>
@endsection

@section('page-breadcrumb')
<nav class="admin-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="">Settings</a></li>
      <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
  </nav>
@endsection

@section('page-scripts')
<script src="{{ asset('assets/vendors/datatables/datatables.min.js') }}" defer></script>
<script src="{{ asset('assets/js/settings/settings-user.js') }}" defer></script>
@endsection

