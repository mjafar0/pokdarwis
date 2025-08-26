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

        // Jika sudah URL penuh
        if (Str::startsWith($img, ['http://', 'https://', '//'])) {
            return $img;
        }

        // Jika kamu simpan file di /public/assets/images/...
        if (Str::startsWith($img, ['assets/'])) {
            return asset($img);
        }

        // Default: file upload di storage/app/public/...
        return asset('storage/'.$img);
    }
}
