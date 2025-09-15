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
            <a href="{!! route('settings-users-superadmin.index') !!}" class="round-btn">Close</a>
        </div>
    </div>
@endsection

@section('main')
{!! html()->form('post', route('settings-users-superadmin.store'))->open() !!}
<div class="card shadow-sm border-0">
    <div class="card-body">       
        {!! html()->label('name', 'Nama User') !!}
        {!! html()->text('name')->class('form-control') !!}

        {!! html()->label('email', 'Email') !!}
        {!! html()->email('email')->class('form-control') !!}

        {!! html()->label('password', 'Password') !!}
        {!! html()->password('password')->class('form-control') !!}
    </div>
    <div class="card-footer">
        {!! html()->submit('Simpan')->class('btn btn-primary') !!}
    </div>
</div>
{!! html()->form()->close() !!}
@endsection

@section('page-breadcrumb')
<nav class="admin-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="">Settings</a></li>
      <li class="breadcrumb-item"><a href="{!! route('settings-users-superadmin.index') !!}">Users</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
  </nav>
@endsection