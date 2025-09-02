<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\GalleryController;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
use App\Models\PaketWisata;

Route::post('/login', [AuthenticatedSessionController::class, 'apiLogin']);


//Pokdarwis / Tours
Route::get('/tours', function () {
    return PaketWisata::select('nama_paket','slug','lokasi','waktu_penginapan','pax','img','harga')
           ->latest('id')
           ->paginate(12);
});

Route::get('/tours/{paket:slug}', function (\App\Models\PaketWisata $paket) {
    // boleh tambah relasi kalau perlu
    $paket->load(['fasilitas' => fn($q) => $q->orderBy('tipe')->orderBy('sort_order')]);
    return $paket;
});

//Gallery
Route::get('/gallery', [GalleryController::class, 'index']);       // list (dengan filter & paginate)
Route::get('/gallery/{media}', [GalleryController::class, 'show']);