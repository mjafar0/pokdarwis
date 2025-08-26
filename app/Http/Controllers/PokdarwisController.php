<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\Pokdarwis;
use App\Models\Product;
use Illuminate\Http\Request;

class PokdarwisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('dashboard.pokdarwis');
        $pakets = PaketWisata::where('pokdarwis_id', 6) // filter sesuai kebutuhanmu
                    ->latest('id')
                    ->paginate(6);

        // kirim $pakets ke view pokdarwis.blade.php
        return view('pokdarwis', compact('pakets'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $pokdarwis = Pokdarwis::findOrFail($id);

        // paket wisata milik pokdarwis ini
        $pakets = $pokdarwis->paketWisata()
            ->latest('id')
            ->paginate(6);

        // produk (opsional) untuk <x-product-card>
        $products = Product::where('pokdarwis_id', $pokdarwis->id)
            ->inRandomOrder()->limit(6)->get();

        $items = $products->map(function ($p) {
            $img = $p->img
                ? (str_starts_with($p->img, 'http') ? $p->img : asset('storage/'.$p->img))
                : asset('assets/images/noimage.jpg');

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

        return view('pokdarwis', compact('pokdarwis','pakets','items'));
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $pokdarwis = Pokdarwis::findOrFail($id);

    //     // ambil produk milik pokdarwis ini
    //     $products = Product::where('pokdarwis_id', $pokdarwis->id)
    //         ->inRandomOrder()
    //         ->limit(6)
    //         ->get();

    //     // mapping ke format untuk <x-produkcard>
    //     $items = $products->map(function ($p) {
    //         return [
    //             'image'    => $p->img ? asset('storage/'.$p->img) : asset('assets/images/noimage.jpg'),
    //             'cat'      => 'Produk',
    //             'catUrl'   => '#',
    //             'title'    => $p->name_product,
    //             'titleUrl' => '#', // nanti bisa arahkan ke detail produk
    //             'desc'     => $p->deskripsi,
    //             'rating'   => 5,
    //         ];
    //     });

    //     return view('pokdarwis', compact('pokdarwis','items'));
        
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokdarwis $pokdarwis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokdarwis $pokdarwis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokdarwis $pokdarwis)
    {
        //
    }
}
