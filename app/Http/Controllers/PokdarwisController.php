<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\Pokdarwis;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // <-- penting: agar bisa pakai Str::startsWith

class PokdarwisController extends Controller
{
    /**
     * List awal (opsional).
     */
    public function index()
    {
        // contoh: default ambil paket milik pokdarwis id=6
        $pakets = PaketWisata::where('pokdarwis_id', 6)
            ->latest('id')
            ->paginate(3);

        // menu pokdarwis untuk navbar TOUR
        $pokdarwisMenu = Pokdarwis::orderBy('name_pokdarwis')
            ->get(['id','name_pokdarwis','slug']);

        return view('pokdarwis', compact('pakets', 'pokdarwisMenu'));
    }

    /**
     * Halaman detail pokdarwis tertentu.
     */
    public function show($id)
    {
        $pokdarwis = Pokdarwis::findOrFail($id);

        // Paket wisata milik pokdarwis ini
        $pakets = PaketWisata::where('pokdarwis_id', $pokdarwis->id)
            ->latest('id')
            ->paginate(3);

        // Produk milik pokdarwis ini untuk <x-product-card>
        $products = Product::where('pokdarwis_id', $pokdarwis->id)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $items = $products->map(function ($p) {
            $path = $p->img;

            if ($path) {
                // jika sudah absolute URL biarkan; jika relatif,
                // tentukan apakah dari /public/assets atau dari storage
                $img = Str::startsWith($path, ['http://','https://','//'])
                    ? $path
                    : (Str::startsWith($path, 'assets/')
                        ? asset($path)                 // file di public/assets/...
                        : asset('storage/'.$path));    // file di storage/app/public/...
            } else {
                $img = asset('assets/images/noimage.jpg');
            }

            return [
                'image'    => $img,
                'cat'      => 'Produk',
                'catUrl'   => '#',
                'title'    => $p->name_product,
                'titleUrl' => '#',
                'desc'     => $p->deskripsi,
                'rating'   => 5,
            ];
        });

        // menu pokdarwis untuk navbar TOUR
        $pokdarwisMenu = Pokdarwis::orderBy('name_pokdarwis')
            ->get(['id','name_pokdarwis','slug']);

            $galleryItems = $pokdarwis->mediaKonten->map(function ($m) {
        $src = Str::startsWith($m->file_path, ['http://','https://','//'])
            ? $m->file_path
            : (Str::startsWith($m->file_path, 'assets/')
                ? asset($m->file_path)
                : asset('storage/'.$m->file_path));

        return [
            'src' => $src,
            'alt' => $m->judul_konten ?? 'Media',
        ];
    });

        return view('pokdarwis', compact('pokdarwis','pakets','items','pokdarwisMenu','galleryItems'));
        
    }

    public function create() {}
    public function store(Request $request) {}
    public function edit(Pokdarwis $pokdarwis) {}
    public function update(Request $request, Pokdarwis $pokdarwis) {}
    public function destroy(Pokdarwis $pokdarwis) {}
}
