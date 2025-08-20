<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;

class WisataController extends Controller
{
    public function index()
    {
        // Ambil semua destinasi beserta relasi pokdarwis (kalau mau)
        $destinasi = DestinasiWisata::with('pokdarwis')->get();

        // Kirim ke view
        return view('dashboard', compact('destinasi'));
    }
}