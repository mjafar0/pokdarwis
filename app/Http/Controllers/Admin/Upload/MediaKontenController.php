<?php

namespace App\Http\Controllers\Admin\Upload;

use App\Http\Controllers\Controller;
use App\Models\MediaKonten;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MediaKontenController extends Controller
{
    public function index(Request $r)
    {
        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis, 403, 'Profil Pokdarwis belum terdaftar.');

        $query = MediaKonten::where('pokdarwis_id', $pokdarwis->id)
                 ->latest('id');

        if ($r->filled('tipe'))   $query->where('tipe_konten', $r->tipe);      // foto|video
        if ($r->filled('konten')) $query->where('konten', $r->konten);        // produk|wisata

        $items = $query->paginate(12);

        $products = Product::where('pokdarwis_id', $pokdarwis->id)
                    ->orderBy('name_product')->get(['id','name_product']);

        return view('admin.upload.konten.index', compact('items','products'));
    }

    public function store(Request $r)
    {
        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis, 403);

        $data = $r->validate([
            'judul_konten' => ['required','string','max:100'],
            'tipe_konten'  => ['required', Rule::in(['foto','video'])],
            'konten'       => ['required', Rule::in(['produk','wisata'])],
            'product_id'   => ['nullable','integer','exists:products,id'],
            // untuk foto: image; untuk video: mp4/URL (pilih salah satu)
            'file'         => ['nullable','file','mimetypes:image/jpeg,image/png,image/webp,video/mp4','max:51200'], // 50MB
            'video_url'    => ['nullable','url'],
        ]);

        // tentukan file_path
        $path = null;
        if ($r->tipe_konten === 'foto') {
            if ($r->hasFile('file')) {
                $path = $r->file('file')->store('konten', 'public');
            }
        } else { // video
            if ($r->hasFile('file')) {
                $path = $r->file('file')->store('konten', 'public'); // simpan MP4
            } elseif ($r->filled('video_url')) {
                $path = $r->video_url; // simpan url (YouTube/Vimeo)
            }
        }

        MediaKonten::create([
            'judul_konten' => $data['judul_konten'],
            'tipe_konten'  => $data['tipe_konten'],
            'konten'       => $data['konten'],
            'product_id'   => $data['product_id'] ?? null,
            'pokdarwis_id' => $pokdarwis->id,
            'file_path'    => $path,
        ]);

        return back()->with('success','Konten berhasil ditambahkan.');
    }

    public function update(Request $r, $id)
    {
        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis, 403);

        $item = MediaKonten::where('pokdarwis_id',$pokdarwis->id)->findOrFail($id);

        $data = $r->validate([
            'judul_konten' => ['required','string','max:100'],
            'tipe_konten'  => ['required', Rule::in(['foto','video'])],
            'konten'       => ['required', Rule::in(['produk','wisata'])],
            'product_id'   => ['nullable','integer','exists:products,id'],
            'file'         => ['nullable','file','mimetypes:image/jpeg,image/png,image/webp,video/mp4','max:51200'],
            'video_url'    => ['nullable','url'],
        ]);

        $path = $item->file_path;

        if ($data['tipe_konten'] === 'foto') {
            if ($r->hasFile('file')) {
                if ($path && !str_starts_with($path,'http')) Storage::disk('public')->delete($path);
                $path = $r->file('file')->store('konten','public');
            }
        } else {
            if ($r->hasFile('file')) {
                if ($path && !str_starts_with($path,'http')) Storage::disk('public')->delete($path);
                $path = $r->file('file')->store('konten','public');
            } elseif ($r->filled('video_url')) {
                $path = $r->video_url;
            }
        }

        $item->update([
            'judul_konten' => $data['judul_konten'],
            'tipe_konten'  => $data['tipe_konten'],
            'konten'       => $data['konten'],
            'product_id'   => $data['product_id'] ?? null,
            'file_path'    => $path,
        ]);

        return back()->with('success','Konten berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis, 403);

        $item = MediaKonten::where('pokdarwis_id',$pokdarwis->id)->findOrFail($id);

        if ($item->file_path && !str_starts_with($item->file_path,'http')) {
            Storage::disk('public')->delete($item->file_path);
        }
        $item->delete();

        return back()->with('success','Konten dihapus.');
    }
}
