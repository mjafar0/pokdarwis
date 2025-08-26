<?php

namespace App\Providers;

use App\Models\Pokdarwis;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Daftar Pokdarwis dikirim ke Component Navbar
        View::composer('components.navbar', function ($view) {
        $pokdarwisMenu = Pokdarwis::orderBy('name_pokdarwis')
            ->get(['id','name_pokdarwis']);   // tambahkan 'slug' kalau kamu punya kolom slug
        $view->with('pokdarwisMenu', $pokdarwisMenu);
    });
    }
}
