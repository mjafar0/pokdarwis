<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\Pokdarwis;
use App\Models\Product;
use App\Models\Review;
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

    //Counter Helper
    if (! function_exists('formatCounter')) {
    function formatCounter(int $n): array
    {
        $n = max(0, $n);
        if ($n >= 1_000_000_000_000) {
            // triliunan
            return [floor($n / 1_000_000_000_000), 'T+'];
        }

        if ($n >= 1_000_000_000) {
            // miliaran
            return [floor($n / 1_000_000_000), 'B+']; // B = Billion
        }
        if ($n >= 1_000_000) {
            // jutaan → 25M+
            return [floor($n / 1_000_000), 'M+'];
        }

        if ($n >= 1_000) {
            // ribuan → 25K+
            return [floor($n / 1_000), 'K+'];
        }

        // di bawah ribuan → tampil angka asli + "+"
        return [$n, ''];
    }
}

    // ==== COUNTER SECTION ====
    $visits = (int)($pokdarwis->visit_count_manual ?? 0) + (int)($pokdarwis->visit_count_auto ?? 0);
    [$vValue, $vSuffix] = formatCounter($visits);

    $activeMembers = Pokdarwis::count();
    [$amValue, $amSuffix] = formatCounter((int)$activeMembers);

    $reviews = 220; // TODO: ganti ke query review real
    [$rvValue, $rvSuffix] = formatCounter((int)$reviews);

    $reviewCount = Review::where('pokdarwis_id', $pokdarwis->id)->count();
    [$rvValue, $rvSuffix] = formatCounter((int)$reviewCount);

    $productCount = Product::where('pokdarwis_id', $pokdarwis->id)->count();
    [$prValue, $prSuffix] = formatCounter((int)$productCount);


    $counterItems = [
        ['value' => $vValue,  'suffix' => $vSuffix,  'label' => 'Visited'],
        ['value' => $amValue, 'suffix' => $amSuffix, 'label' => 'Total Destination'],
        ['value' => $prValue, 'suffix' => $prSuffix, 'label' => 'Products'],
        ['value' => $rvValue, 'suffix' => $rvSuffix, 'label' => 'Reviews'],
    ];

    //Reviews
    $reviews = Review::where('pokdarwis_id', $pokdarwis->id)
    ->latest('id')
    ->take(9) // cukup utk 3 kolom x 3 baris / 3 slide
    ->get();

    $avgRating = round((float) Review::where('pokdarwis_id',$pokdarwis->id)->avg('rating'),1);
    $reviewCount = Review::where('pokdarwis_id',$pokdarwis->id)->count();


    // Map ke format <x-review-card>
    $reviewItems = $reviews->map(function($r){
        return [
            'image' => $r->user?->avatar
                        ? (str_starts_with($r->user->avatar,'http') ? $r->user->avatar : asset('storage/'.$r->user->avatar))
                        : asset('assets/images/noimage.jpg'),
            'name'  => $r->user->name ?? 'Anonim',
            'role'  => 'Traveller',
            'rating'=> (float)$r->rating,
            'text'  => $r->comment,
        ];
    });

    

    //Cover, Video, Content
    // ====== BARU: resolve media milik Pokdarwis ======
    $coverUrl        = $this->fileUrl($pokdarwis->cover_img, asset('assets/images/cover-default.jpg'));
    $contentVideoUrl = $this->fileUrl($pokdarwis->content_video);
    $contentImgUrl   = $this->fileUrl($pokdarwis->content_img);

    // Gallery dari relasi mediaKonten (tetap ada)
    $galleryItems = $pokdarwis->mediaKonten->map(function ($m) {
        $src = Str::startsWith($m->file_path, ['http://','https://','//'])
            ? $m->file_path
            : (Str::startsWith($m->file_path, 'assets/')
                ? asset($m->file_path)
                : asset('storage/'.$m->file_path));

        return [
            'type' => Str::of($m->file_path)->lower()->endsWith(['.mp4','.mov','.webm']) ? 'video' : 'image',
            'src'  => $src,
            'alt'  => $m->judul_konten ?? 'Media',
        ];
    })->values();

    // Opsional: masukkan content_img / content_video ke awal gallery
    if ($contentImgUrl) {
        $galleryItems->prepend(['type' => 'image', 'src' => $contentImgUrl, 'alt' => 'Content Image']);
    }
    if ($contentVideoUrl) {
        $galleryItems->prepend(['type' => 'video', 'src' => $contentVideoUrl, 'alt' => 'Content Video']);
    }


    $galleryPhotos = $pokdarwis->mediaKonten()
        ->photos()
        ->latest('id')
        ->get()
        ->map->toGalleryItem();

        return view('pokdarwis', compact('pokdarwis','pakets','items','pokdarwisMenu','galleryItems', 'counterItems', 'reviews','avgRating','reviewCount','coverUrl', 'galleryPhotos'));
        
    }

    private function fileUrl(?string $path, ?string $fallback = null): ?string
    {
        if (!$path) return $fallback;
        return Str::startsWith($path, ['http://','https://','//'])
            ? $path
            : (Str::startsWith($path, 'assets/')
                ? asset($path)                 // /public/assets/...
                : asset('storage/'.$path));    // storage/app/public/...
    }
    

    public function create() {}
    public function store(Request $request) {}
    public function edit(Pokdarwis $pokdarwis) {}
    public function update(Request $request, Pokdarwis $pokdarwis) {}
    public function destroy(Pokdarwis $pokdarwis) {}
}
