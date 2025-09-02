<?php

namespace App\Http\Controllers;

use App\Models\MediaKonten;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pokdarwis;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $q = MediaKonten::query();

        // ---- FILTERS (ambil dari query string) ----
        if ($request->filled('pokdarwis_id')) {
            $q->where('pokdarwis_id', $request->integer('pokdarwis_id'));
        }
        if ($request->filled('tipe')) {            // 'foto' | 'video'
            $q->where('tipe_konten', $request->get('tipe'));
        }
        if ($request->filled('s')) {               // search judul
            $q->where('judul_konten', 'like', '%'.$request->get('s').'%');
        }

        // pagination
        $perPage = min(60, max(12, (int)$request->get('per_page', 24)));
        $page = $q->latest('id')->paginate($perPage)->withQueryString();

        // mapping ke format <x-gallery-card>
        $items = $page->map(function ($m) {
            return [
                'src'   => $this->fileUrl($m->file_path),
                'alt'   => $m->judul_konten ?? 'Media',
                'title' => $m->judul_konten,
            ];
        });

        // dropdown pokdarwis
        $pokdarwisMenu = Pokdarwis::orderBy('name_pokdarwis')
            ->get(['id','name_pokdarwis']);

        // kirim juga nilai filter agar sticky di form
        $filters = [
            'pokdarwis_id' => $request->get('pokdarwis_id'),
            'tipe'         => $request->get('tipe'),
            's'            => $request->get('s'),
            'per_page'     => $perPage,
        ];

        return view('gallery', compact('items','page','pokdarwisMenu','filters'));
    }

    private function fileUrl(?string $path): string
    {
        if (!$path) return asset('assets/images/noimage.jpg');
        if (Str::startsWith($path, ['http://','https://','//'])) return $path;
        if (Str::startsWith($path, 'assets/'))               return asset($path);
        return asset('storage/'.$path);
    }
}
