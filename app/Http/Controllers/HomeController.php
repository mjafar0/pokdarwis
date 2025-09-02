<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\MediaKonten;
use App\Models\PaketWisata;
use App\Models\Pokdarwis;
class HomeController extends Controller
{

    public function index()
    {
        $products = Product::inRandomOrder()->limit(8)->get();

        $items = $products->map(function ($p) {
            $img = $p->img
                ? (str_starts_with($p->img, 'http') ? $p->img : asset('storage/'.$p->img))
                : asset('assets/images/noimage.jpg');

            return [
                'image'     => $p->image_url,
                'cat'       => 'Produk',
                'catUrl'    => '#',
                'title'     => $p->name_product,
                'titleUrl'  => '#',   // ganti ke route detail produk jika ada
                'desc'      => $p->deskripsi,
                'rating'    => 5,
            ];
        });

        $featured = PaketWisata::with('pokdarwis:id,name_pokdarwis,slug')
            ->latest('id')
            ->take(6)
            ->get(['id','pokdarwis_id','nama_paket','slug','lokasi','waktu_penginapan','pax','img','harga']);

        return view('home', compact('items', 'featured'));
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
}
