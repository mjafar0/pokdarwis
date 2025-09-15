<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;

//settings
use App\Http\Controllers\Admin\Settings\UsersAdminController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


//setting - pengguna - user superadmin
Route::middleware(['role:admin'])->get('/settings/users/superadmin', [UsersAdminController::class, 'index'])->name('settings-users-superadmin.index');
Route::middleware(['role:admin'])->get('/settings/users/superadmin/create', [UsersAdminController::class, 'create'])->name('settings-users-superadmin.create');
Route::middleware(['role:admin'])->get('/settings/users/superadmin/{id}', [UsersAdminController::class, 'show'])->name('settings-users-superadmin.show');
Route::middleware(['role:admin'])->post('/settings/users/superadmin', [UsersAdminController::class, 'store'])->name('settings-users-superadmin.store');
Route::middleware(['role:admin'])->get('/settings/users/superadmin/{id}/edit', [UsersAdminController::class, 'edit'])->name('settings-users-superadmin.edit');
Route::middleware(['role:admin'])->put('/settings/users/superadmin/{id}', [UsersAdminController::class, 'update'])->name('settings-users-superadmin.update');
Route::middleware(['role:admin'])->delete('/settings/users/superadmin/{id}', [UsersAdminController::class, 'destroy'])->name('settings-users-superadmin.destroy');

//setting - pengguna - user pokdarwis
Route::middleware(['role:admin'])->get('/settings/users/pokdarwis', [UsersController::class, 'index'])->name('settings-users-pokdarwis.index');
Route::middleware(['role:admin'])->get('/settings/users/pokdarwis/create', [UsersController::class, 'create'])->name('settings-users-pokdarwis.create');
Route::middleware(['role:admin'])->get('/settings/users/pokdarwis/{id}', [UsersController::class, 'show'])->name('settings-users-pokdarwis.show');
Route::middleware(['role:admin'])->post('/settings/users/pokdarwis', [UsersController::class, 'store'])->name('settings-users-pokdarwis.store');
Route::middleware(['role:admin'])->get('/settings/users/pokdarwis/{id}/edit', [UsersController::class, 'edit'])->name('settings-users-pokdarwis.edit');
Route::middleware(['role:admin'])->put('/settings/users/pokdarwis/{id}', [UsersController::class, 'update'])->name('settings-users-pokdarwis.update');
Route::middleware(['role:admin'])->delete('/settings/users/pokdarwis/{id}', [UsersController::class, 'destroy'])->name('settings-users-pokdarwis.destroy');

//setting - pengguna - user wisatawan
Route::middleware(['role:admin'])->get('/settings/users/wisatawan', [UsersController::class, 'index'])->name('settings-users-wisatawan.index');
Route::middleware(['role:admin'])->get('/settings/users/wisatawan/create', [UsersController::class, 'create'])->name('settings-users-wisatawan.create');
Route::middleware(['role:admin'])->get('/settings/users/wisatawan/{id}', [UsersController::class, 'show'])->name('settings-users-wisatawan.show');
Route::middleware(['role:admin'])->post('/settings/users/wisatawan', [UsersController::class, 'store'])->name('settings-users-wisatawan.store');
Route::middleware(['role:admin'])->get('/settings/users/wisatawan/{id}/edit', [UsersController::class, 'edit'])->name('settings-users-wisatawan.edit');
Route::middleware(['role:admin'])->put('/settings/users/wisatawan/{id}', [UsersController::class, 'update'])->name('settings-users-wisatawan.update');
Route::middleware(['role:admin'])->delete('/settings/users/wisatawan/{id}', [UsersController::class, 'destroy'])->name('settings-users-wisatawan.destroy');
