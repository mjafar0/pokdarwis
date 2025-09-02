@extends('layouts.app-backend')

@section('page-header')
        <h1>Users</h1>
@endsection

@section('page-description')
        Mengelola user superadmin
@endsection

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables/datatables.min.css') }}">
@endsection


@section('main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">User Superadmin</h5>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script src="{{ asset('assets/vendors/datatables/datatables.min.js') }}" defer></script>
<script src="{{ asset('assets/js/settings/settings-user.js') }}" defer></script>
@endsection

