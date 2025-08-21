<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use App\Models\MediaKonten;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinasiWisataController extends Controller
{
    public function index()
    {
        $destinasi = DestinasiWisata::where('pokdarwis_id', Auth::id())->get();
        return view('/', compact('destinasi'));
    }

    public function create()
    {
        return view('/');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_destinasi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'media.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('destinasi', 'public');
        }

        $destinasi = DestinasiWisata::create([
            'name_destinasi' => $request->name_destinasi,
            'pokdarwis_id' => Auth::id(),
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'fasilitas' => $request->fasilitas,
            'img' => $path,
        ]);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $mediaPath = $file->store('produk-media', 'public');

                MediaKonten::create([
                    'judul_konten' => $file->getClientOriginalName(),
                    'tipe_konten' => 'foto',
                    'konten' => 'produk',
                    'file_path' => $mediaPath,
                    'destinasi_wisata_id' => $destinasi->id,
                ]);
            }
        }

        return redirect()->route('pokdarwis')
                         ->with('success', 'Destinasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $destinasi = DestinasiWisata::where('pokdarwis_id', Auth::id())->findOrFail($id);
        return view('pokdarwis.destinasi.edit', compact('destinasi'));
    }

    public function update(Request $request, $id)
    {
        $destinasi = DestinasiWisata::where('pokdarwis_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name_destinasi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('destinasi', 'public');
            $destinasi->img = $path;
        }

        $destinasi->update($request->only(['name_destinasi', 'lokasi', 'deskripsi', 'fasilitas']));

        return redirect()->route('pokdarwis.destinasi.index')->with('success', 'Destinasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $destinasi = DestinasiWisata::where('pokdarwis_id', Auth::id())->findOrFail($id);
        $destinasi->delete();
        return redirect()->route('pokdarwis.destinasi.index')->with('success', 'Destinasi berhasil dihapus');
    }

    // public function wisatawanIndex()
    // {
    //     // Ambil semua destinasi yang sudah di-upload pokdarwis
    //     $destinasi = DestinasiWisata::all();

    //     return view('dashboard', compact('destinasi'));
    // }
}
