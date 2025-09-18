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
    /** semua prefix folder yang kita anggap ada di disk 'public' */
    private array $publicPrefixes = ['products/', 'paket/', 'pokdarwis/', 'posts/'];

    public function index()
    {
        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis, 403, 'Profil Pokdarwis belum terdaftar.');

        $products = Product::where('pokdarwis_id', $pokdarwis->id)
            ->latest('id')
            ->paginate(12);

        // kirim juga $pokdarwis biar dipakai di blade (untuk AI prompt, dsb)
        return view('admin.upload.product.index', compact('products', 'pokdarwis'));
    }

    // CREATE (ADD)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_product'    => 'required|string|max:255',
            'harga_product'   => 'required|numeric|min:0',
            'deskripsi'       => 'nullable|string',
            'detail_tambahan' => 'nullable|string',
            'img'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $pokdarwis = Auth::user()->pokdarwis;
        abort_unless($pokdarwis, 403, 'Profil Pokdarwis belum terdaftar.');
        $data['pokdarwis_id'] = $pokdarwis->id;

        if ($request->hasFile('img')) {
            // simpan ke storage/app/public/products → "products/xxxxx.jpg"
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

    // UPDATE
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
            'img'              => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('img')) {
            // hapus file lama jika ada
            $old = $product->img;
            if ($old) {
                // a) file lama ada di disk 'public' (storage/app/public/...)
                if (Str::startsWith($old, $this->publicPrefixes) && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
                // b) kalau dulu sempat disimpan ke public/ (akibat move(public_path(...)))
                $publicPath = public_path($old);
                if (Str::startsWith($old, $this->publicPrefixes) && is_file($publicPath)) {
                    @unlink($publicPath);
                }
            }

            // simpan baru ke disk 'public'
            $data['img'] = $request->file('img')->store('products', 'public');
        } else {
            unset($data['img']); // jangan menimpa kolom img jika tidak mengubah
        }

        $product->update($data);

        return back()->with('success', 'Produk berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Product $product)
    {
        abort_unless($product->pokdarwis_id === optional(Auth::user()->pokdarwis)->id, 403);

        $old = $product->img;
        if ($old) {
            if (Str::startsWith($old, $this->publicPrefixes) && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $publicPath = public_path($old);
            if (Str::startsWith($old, $this->publicPrefixes) && is_file($publicPath)) {
                @unlink($publicPath);
            }
        }

        $product->delete();

        return redirect()->route('pokdarwis.product.index')->with('success', 'Produk dihapus.');
    }
}
