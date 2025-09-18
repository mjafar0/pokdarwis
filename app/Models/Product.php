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

    if (Str::startsWith($img, ['http://','https://','//'])) {
        return $img;
    }

    if (Str::startsWith($img, ['products/','paket/','pokdarwis/','posts/'])) {
        return asset('storage/'.$img);   // → /storage/....
    }

    return asset($img); // fallback: file di public/

    }
    
}
