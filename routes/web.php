<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\PokdarwisController;
use App\Http\Controllers\ProductController;
use App\Models\Pokdarwis;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

// Index
Route::get('/pokdarwis', [PokdarwisController::class, 'index'])->name('pokdarwis');

// Detail pakai slug
Route::get('/tour/{pokdarwis:slug}', [PokdarwisController::class, 'show'])
    ->name('pokdarwis.show');

// (opsional tapi sangat membantu) redirect kalau ada yang ngetik ID:
Route::get('/tour/{id}', function ($id) {
    $pd = Pokdarwis::findOrFail($id);
    return redirect()->route('pokdarwis.show', ['pokdarwis' => $pd->slug]);
})->whereNumber('id');

// Paket Wisata
Route::get('/paket', [PaketWisataController::class, 'index'])->name('paket.index');
Route::get('/paket/{paket:slug}', [PaketWisataController::class, 'show'])->name('paket.show');

// Produk
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Gallery (cukup satu)
Route::get('/gallery', [GalleryController::class, 'index'])
     ->name('gallery');

// Blog
Route::get('/blogarchive', [BlogController::class, 'index'])->name('posts.index');
Route::get('/blogarchive/{slug}', [BlogController::class, 'show'])->name('posts.show');


require __DIR__.'/auth.php';












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
