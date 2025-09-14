<?php

namespace App\Http\Controllers\Admin\Upload;

use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:pokdarwis']);
    }

    // GET /pokdarwis/upload/paket
    public function create()
    {
        return view('admin.upload.paket.uploadPaket');
    }

    // POST /pokdarwis/upload/paket
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket'       => ['required','string','max:255'],
            'deskripsi'        => ['nullable','string'],
            'waktu_penginapan' => ['nullable','string','max:50'], // contoh: 3D2N
            'pax'              => ['nullable','integer','min:1'],
            'lokasi'           => ['nullable','string','max:255'],
            'harga'            => ['required','numeric','min:0'],
            'currency'         => ['nullable','string','max:10'], // default IDR
            'img'              => ['nullable','image','mimes:jpg,jpeg,png,webp','max:3072'],
        ]);

        // ambil pokdarwis milik user (tabel pokdarwis punya user_id)
        $pokdarwis = Auth::user()->pokdarwis; 
        abort_unless($pokdarwis, 403, 'Profil Pokdarwis belum terdaftar.');

        $data = $request->only([
            'nama_paket','deskripsi','waktu_penginapan','pax','lokasi','harga','currency'
        ]);
        $data['currency'] = $data['currency'] ?? 'IDR';
        $data['pokdarwis_id'] = $pokdarwis->id;

        if ($request->hasFile('img')) {
            // simpan ke storage/app/public/paket
            $data['img'] = $request->file('img')->store('paket', 'public');
        }

        PaketWisata::create($data);

        return back()->with('success', 'Paket wisata berhasil diupload.');
    }
}
