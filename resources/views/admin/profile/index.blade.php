@extends('layouts.app-backend')

@section('page-title', 'My Profile')

@section('page-breadcrumb')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">My Profile</li>
    </ol>
  </nav>
@endsection

@php
  use Illuminate\Support\Str;
  use App\Models\Pokdarwis;

  // Ambil dari controller jika ada; fallback auth->pokdarwis
  $pdw = ($pokdarwis ?? null) ?: (auth()->check() ? Pokdarwis::where('user_id', auth()->id())->first() : null);

  // Build avatar URL (http/https | public/assets | storage)
  $avatar = $pdw?->img;
  if ($avatar) {
      $avatar = Str::startsWith($avatar, ['http://','https://','//'])
        ? $avatar
        : (Str::startsWith($avatar, 'assets/')
            ? asset($avatar)
            : asset('storage/'.$avatar));
  } else {
      $avatar = asset('assets/images/default.png');
  }
@endphp

{{-- Isi dua-duanya supaya kompatibel dengan layout manapun --}}
@section('main')
  @include('admin.profile._body', ['pdw' => $pdw, 'avatar' => $avatar])
@endsection

@section('page-content')
  @include('admin.profile._body', ['pdw' => $pdw, 'avatar' => $avatar])
@endsection
