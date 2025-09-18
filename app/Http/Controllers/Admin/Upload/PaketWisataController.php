<?php

namespace App\Http\Controllers\Admin\Upload;

use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaketWisataController extends Controller
{
    public function index()
    {
        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis, 403, 'Profil Pokdarwis belum terdaftar.');

        $pakets = PaketWisata::where('pokdarwis_id', $pokdarwis->id)
            ->latest('id')->paginate(12);

        return view('admin.upload.paket.index', compact('pakets'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'nama_paket'       => 'required|string|max:100',
            'deskripsi'        => 'nullable|string',
            'waktu_penginapan' => 'required|string|max:20',
            'pax'              => 'required|integer|min:1',
            'lokasi'           => 'required|string|max:100',
            'harga'            => 'required|numeric|min:0',
            'currency'         => 'nullable|string|max:10',
            'img'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis, 403);

        $path = $r->hasFile('img') ? $r->file('img')->store('paket','public') : null;

        PaketWisata::create([
            'pokdarwis_id'     => $pokdarwis->id,
            'nama_paket'       => $data['nama_paket'],
            'deskripsi'        => $data['deskripsi'] ?? null,
            'waktu_penginapan' => $data['waktu_penginapan'],
            'pax'              => $data['pax'],
            'lokasi'           => $data['lokasi'],
            'img'              => $path,
            'slug'             => Str::slug($data['nama_paket']).'-'.Str::random(6),
            'harga'            => $data['harga'],
            'currency'         => $data['currency'] ?? 'IDR',
        ]);

        return back()->with('success','Paket berhasil ditambahkan.');
    }

    public function update(Request $r, PaketWisata $paket)
    {
        $this->authorizePaket($paket);

        $data = $r->validate([
            'nama_paket'       => 'required|string|max:100',
            'deskripsi'        => 'nullable|string',
            'waktu_penginapan' => 'required|string|max:20',
            'pax'              => 'required|integer|min:1',
            'lokasi'           => 'required|string|max:100',
            'harga'            => 'required|numeric|min:0',
            'currency'         => 'nullable|string|max:10',
            'img'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($r->hasFile('img')) {
            // hapus lama jika file storage
            if ($paket->img && str_starts_with($paket->img, 'paket/')) {
                Storage::disk('public')->delete($paket->img);
            }
            $data['img'] = $r->file('img')->store('paket','public');
        }

        $paket->update($data);

        return back()->with('success','Paket berhasil diperbarui.');
    }

    public function destroy(PaketWisata $paket)
    {
        $this->authorizePaket($paket);

        if ($paket->img && str_starts_with($paket->img, 'paket/')) {
            Storage::disk('public')->delete($paket->img);
        }
        $paket->delete();

        return back()->with('success','Paket berhasil dihapus.');
    }

    protected function authorizePaket(PaketWisata $paket)
    {
        $pd = Auth::user()->pokdarwis;
        abort_unless($pd && $paket->pokdarwis_id == $pd->id, 403);
    }
}
