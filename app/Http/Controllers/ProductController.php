<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\MediaKonten;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::where('pokdarwis_id', Auth::id())->get();
        return view('/', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'harga_product' => 'required|decimal:0,2',
            'deskripsi' => 'nullable|string',
            'detail_tambahan' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'media.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('destinasi', 'public');
        }

        $product = Product::create([
            'name_product' => $request->name_product,
            'pokdarwis_id' => Auth::id(),
            'deskripsi' => $request->deskripsi,
            'harga_product' => $request->harga_product,
            'detail_tambahan' => $request->detail_tambahan,
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
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect()->route('pokdarwis')
                         ->with('success', 'Product berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
