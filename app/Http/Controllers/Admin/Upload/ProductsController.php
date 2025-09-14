<?php

namespace App\Http\Controllers\Admin\Upload;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function index()
    {
        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis, 403, 'Profil Pokdarwis belum terdaftar.');

        $products = Product::where('pokdarwis_id', $pokdarwis->id)
            ->latest('id')
            ->paginate(12);

        return view('admin.upload.product.index', compact('products'));
    }

    // CREATE (ADD)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_product'    => 'required|string|max:255',
            'harga_product'   => 'required|numeric|min:0',
            'deskripsi'       => 'nullable|string',
            'detail_tambahan' => 'nullable|string',
            'img'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis, 403, 'Profil Pokdarwis belum terdaftar.');

        $data['pokdarwis_id'] = $pokdarwis->id;

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('pokdarwis.product.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function create()
    {
        return view('admin.upload.product.uploadProduct'); // form input
    }

    //Update
    public function update(Request $request, Product $product)
    {
        // pastikan produk milik pokdarwis yang login
        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis && $product->pokdarwis_id === $pokdarwis->id, 403);

        $data = $request->validate([
            'name_product'     => 'sometimes|required|string|max:255',
            'harga_product'    => 'sometimes|required|numeric|min:0',
            'deskripsi'        => 'sometimes|nullable|string',
            'detail_tambahan'  => 'sometimes|nullable|string',
            'img'              => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // jika ada gambar baru, simpan & hapus lama (kalau dari disk public/products)
        if ($request->hasFile('img')) {
            if ($product->img && str_starts_with($product->img, 'products/')) {
                Storage::disk('public')->delete($product->img);
            }
            $data['img'] = $request->file('img')->store('products', 'public');
        } else {
            unset($data['img']); // jangan menimpa img jika tidak diubah
        }

        $product->update($data);

        return back()->with('success', 'Produk berhasil diperbarui.');
    }

     // DELETE
    public function destroy(Product $product)
    {
        abort_unless($product->pokdarwis_id === optional(Auth::user()->pokdarwis)->id, 403);

        if ($product->img && Str::startsWith($product->img, 'products/')) {
            Storage::disk('public')->delete($product->img);
        }

        $product->delete();

        return redirect()->route('pokdarwis.product.index')->with('success', 'Produk dihapus.');
    }
}
