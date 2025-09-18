<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\MediaKonten;
use App\Models\PaketWisata;
use App\Models\Pokdarwis;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{

    public function index()
    {
        $products = Product::inRandomOrder()->limit(8)->get();

        $items = $products->map(function ($p) {
            $path = $p->img;

            if ($path) {
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

        $featured = PaketWisata::with('pokdarwis:id,name_pokdarwis,slug')
            ->latest('id')
            ->take(6)
            ->get(['id','pokdarwis_id','nama_paket','slug','lokasi','waktu_penginapan','pax','img','harga']);


            //counter
            
            if (! function_exists('format_counter')) {
    function format_counter(int $n): array {
        if ($n >= 1_000_000_000_000) { // Triliun
            return [round($n / 1_000_000_000_000), 'T+'];
        }
        if ($n >= 1_000_000_000) { // Miliar
            return [round($n / 1_000_000_000), 'B+'];
        }
        if ($n >= 1_000_000) { // Juta
            return [round($n / 1_000_000), 'M+'];
        }
        if ($n >= 1_000) { // Ribu
            return [round($n / 1_000), 'K+'];
        }
        return [$n, ''];
    }
}
             // Total kunjungan = sum(manual + auto) dari semua pokdarwis
    $totalVisits = Pokdarwis::sum(DB::raw('COALESCE(visit_count_manual,0) + COALESCE(visit_count_auto,0)'));

    // Total anggota (jumlah pokdarwis)
    $totalMembers = Pokdarwis::count();

    // Total destinasi (jumlah paket wisata)
    $totalDestinations = PaketWisata::count();

    // Total produk
    $totalProducts = Product::count();

    // Total review
    $totalReviews = Review::count();

    // Format ke K / M
    [$visitValue, $visitSuffix] = format_counter($totalVisits);
    [$memberValue, $memberSuffix] = format_counter($totalMembers);
    [$destValue, $destSuffix] = format_counter($totalDestinations);
    [$prodValue, $prodSuffix]  = format_counter($totalProducts);
    [$revValue, $revSuffix]    = format_counter($totalReviews);

    $counterItems = [
        ['value' => $visitValue, 'suffix' => $visitSuffix, 'label' => 'Visited'],
        ['value' => $memberValue, 'suffix' => $memberSuffix, 'label' => 'Total Destination'],
        ['value' => $prodValue,  'suffix' => $prodSuffix,  'label' => 'Products'],
        ['value' => $revValue,   'suffix' => $revSuffix,   'label' => 'Reviews'],
    ];

    

        return view('home', compact('items', 'featured', 'counterItems'));
    }
}

// public function index()
// {
//     $products = Product::query()
//         ->select(['id','name_product','pokdarwis_id','harga_product','deskripsi','img'])
//         ->with(['pokdarwis:id,name_pokdarwis'])
//         ->whereHas('pokdarwis')
//         // ->where('pokdarwis_id', 6) 
//         ->inRandomOrder()
//         ->limit(6)
//         ->get();

//     $items = $products->map(function ($p) {
//         // gambar
//         $img = $p->img
//             ? (Str::startsWith($p->img, ['http://','https://','//'])
//                 ? $p->img
//                 : asset('storage/'.$p->img))
//             : asset('assets/images/noimage.jpg');


//         return [
//             'image'    => $img,
//             'cat'      => $p->pokdarwis->nama ?? 'Produk',
//             // 'catUrl'   => route('pdw.home', ['slug' => $p->pokdarwis->slug ?? '']), // atau '#'
//             'catUrl'   => '#',
//             'title'    => $p->name_product,
//             'titleUrl' => route('product.show', $p->id),
//             'desc'     => $p->deskripsi ?? '',
//             'rating'   => 5,
//         ];
//     });

//      return view('home', compact('items'));
//     // return view('home', ['items' => $items]);
// }