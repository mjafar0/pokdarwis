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
        $path = $this->img;
        if (!$path) return asset('assets/images/noimage.jpg');

        return Str::startsWith($path, ['http://','https://','//'])
            ? $path
            : asset('storage/'.$path);
    }
}
