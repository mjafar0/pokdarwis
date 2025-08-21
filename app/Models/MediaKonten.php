<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaKonten extends Model
{
    protected $table = 'media_konten';

    protected $fillable = [
        'judul_konten',
        'tipe_konten',
        'konten',
        'file_path',
        'product_id',
        'destinasi_wisata_id',
        'img'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
