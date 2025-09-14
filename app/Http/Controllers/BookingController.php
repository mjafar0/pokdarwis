<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokdarwis;
use App\Models\PaketWisata;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking'); // tanpa pokdarwis -> fallback banner
    }

    public function forPokdarwis(Pokdarwis $pokdarwis)
    {
        return view('booking', compact('pokdarwis'));
    }

    public function forPackage(Pokdarwis $pokdarwis, PaketWisata $paket)
    {
        abort_unless($paket->pokdarwis_id === $pokdarwis->id, 404);
        return view('booking', compact('pokdarwis', 'paket'));
    }
}
