<?php

use App\Http\Controllers\AiGenerateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\DestinasiWisataController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//masih test, ubah Pokdarwis Return nya
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/pokdarwis', function () {
        return view('pokdarwis');
    })->name('pokdarwis');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified'])->prefix('pokdarwis')->name('pokdarwis.')->group(function () {
    Route::get('/dashboard/pokdarwis', function () {
        return view('pokdarwis');
    })->name('dashboard');

    Route::resource('destinasi', DestinasiWisataController::class);
    Route::resource('product', ProductController::class);
    Route::resource('gallery', GalleryController::class);

    Route::middleware(['auth'])->match(['get','post'], '/ai/promo', AiGenerateController::class)
    ->name('ai.promo');
});

Route::middleware(['auth'])->match(['get','post'], '/ai/promo', AiGenerateController::class)
    ->name('ai.promo');

    Route::middleware(['auth'])
    ->match(['get','post'], '/ai/promo', AiGenerateController::class)
    ->name('ai.promo');


// Route::get('/pokdarwis/gallery/create', [GalleryController::class, 'create'])->name('pokdarwis.gallery.create');
// Route::post('/pokdarwis/gallery', [GalleryController::class, 'store'])->name('pokdarwis.gallery.store');

require __DIR__.'/auth.php';
