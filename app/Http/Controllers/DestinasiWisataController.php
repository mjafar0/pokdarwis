<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use Illuminate\Http\Request;

class DestinasiWisataController extends Controller
{
    public function store (Request $request) {
        $request->validate([
            'name_destinasi' => 'required|string|max:255',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'fasilitas' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('wisata_img', 'public');
        }

        DestinasiWisata::create([
            'name_destinasi' => $request->name_destinasi,
            'pokdarwis_id' => auth()->id(),
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'fasilitas' => $request->fasilitas,
            'img' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Destinasi Wisata Berhasil Di Tambahkan');
    }
}
