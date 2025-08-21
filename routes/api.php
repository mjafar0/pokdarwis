<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Routing\Route;

Route::post('/login', [AuthenticatedSessionController::class, 'apiLogin']);
