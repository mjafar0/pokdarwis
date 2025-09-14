<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
            'name_product' ,
            'pokdarwis_id',
            'harga_product' ,
            'deskripsi' ,
            'detail_tambahan',
            'img'
    ];

    public function pokdarwis()
    {
        return $this->belongsTo(Pokdarwis::class);
    }

    public function getImageUrlAttribute()
    {
         $img = $this->img;

    if (!$img) {
        return asset('assets/images/noimage.jpg');
    }

    // Jika absolute URL
    if (Str::startsWith($img, ['http://','https://','//'])) {
        return $img;
    }

    // Jika file hasil upload di disk 'public' => 'products/...'
    if (Str::startsWith($img, ['products/', 'paket/'])) {
        return asset('storage/'.$img);
    }

    // Jika path ke public/ (contoh: 'assets/images/...') tetap dilayani
    return asset($img);
    }
    
}
