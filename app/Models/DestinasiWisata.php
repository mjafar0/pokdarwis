<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinasiWisata extends Model
{
    protected $table = 'destinasi_wisata';

    protected $fillable = [
        'name_destinasi',
        'pokdarwis_id',
        'deskripsi',
        'lokasi',
        'fasilitas',
        'img'
    ];
}
