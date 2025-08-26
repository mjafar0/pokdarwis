<?php

use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\PokdarwisController;
use App\Http\Controllers\ProductController;

// Halaman welcome (opsional, hapus kalau tidak dipakai)
Route::get('/welcome', function () {
    return view('welcome');
});

// Homepage → ambil produk acak (HomeController@index)
Route::get('/', [HomeController::class, 'index'])->name('home');

// alias /home ke halaman utama juga (supaya $items tetap ada)
Route::get('/home', [HomeController::class, 'index']);

// Halaman pokdarwis (masih statis sekarang)
// Route::get('/pokdarwis', function () {
//     return view('pokdarwis');
// })->name('pokdarwis');
Route::get('/pokdarwis', [PokdarwisController::class, 'index'])->name('pokdarwis');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

// Detail Paket & Paket Wisata
Route::get('/detailpaket', function () {
    return view('detailpaket');
})->name('detailpaket');

// Paket Wisata
Route::get('/paket', [PaketWisataController::class, 'index'])->name('paket.index');
Route::get('/paket/{paket:slug}', [PaketWisataController::class, 'show'])->name('paket.show');

// Tour Wisata
Route::get('/tour/{pokdarwis:slug}', [PokdarwisController::class, 'show'])
     ->name('pokdarwis.show');

Route::get('/tour/{id}', [PokdarwisController::class, 'show'])->name('pokdarwis.show');



Route::get('/pokdarwis/{id}', [PokdarwisController::class, 'show'])->name('pokdarwis.show');


// Produk (detail)
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

require __DIR__ . '/auth.php';












// Route::get('/paket', [PaketWisataController::class, 'index'])->name('paket.index');
// Route::get('/paket/{paket:slug}', [PaketWisataController::class, 'show'])->name('paket.show');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// //masih test, ubah Pokdarwis Return nya
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard/pokdarwis', function () {
//         return view('pokdarwis');
//     })->name('pokdarwis');
    
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// Route::middleware(['auth', 'verified'])->prefix('pokdarwis')->name('pokdarwis.')->group(function () {
//     Route::get('/dashboard/pokdarwis', function () {
//         return view('pokdarwis');
//     })->name('dashboard');

//     Route::resource('destinasi', DestinasiWisataController::class);
//     Route::resource('product', ProductController::class);
//     Route::resource('gallery', GalleryController::class);

//     Route::middleware(['auth'])->match(['get','post'], '/ai/promo', AiGenerateController::class)
//     ->name('ai.promo');
// });

// Route::middleware(['auth'])->match(['get','post'], '/ai/promo', AiGenerateController::class)
//     ->name('ai.promo');

//     Route::middleware(['auth'])
//     ->match(['get','post'], '/ai/promo', AiGenerateController::class)
//     ->name('ai.promo');


// // Route::get('/pokdarwis/gallery/create', [GalleryController::class, 'create'])->name('pokdarwis.gallery.create');
// // Route::post('/pokdarwis/gallery', [GalleryController::class, 'store'])->name('pokdarwis.gallery.store');

// require __DIR__.'/auth.php';
