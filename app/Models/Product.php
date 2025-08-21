<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
