<?php

namespace App\Http\Controllers;

use App\Models\MediaKonten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function create()
    {
        // $product = Product::where('pokdarwis_id', Auth::id())->get();
        $gallery = MediaKonten::whereHas('product', function ($q) {
            $q->where('pokdarwis_id', Auth::id());
        })->get();
        return view('pokdarwis', compact('gallery'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_konten' => 'required|string|max:255',
            'tipe_konten' => 'required|in:foto,video',
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4|max:5120',
        ]);

        $path = $request->file('file')->store('gallery', 'public');

        MediaKonten::create([
            'judul_konten' => $request->judul_konten,
            'tipe_konten' => $request->tipe_konten,
            'konten' => 'gallery',
            'file_path' => $path,
            'pokdarwis_id' => Auth::id(),
        ]);

        return redirect()->route('pokdarwis.gallery.create')
            ->with('success', 'Konten gallery berhasil diupload.');
    }
}
