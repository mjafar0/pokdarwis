<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketFasilitas extends Model
{
    protected $table = 'paket_fasilitas';
    protected $fillable = ['paket_wisata_id','nama_item','tipe','sort_order'];

    public function paket()
    {
        return $this->belongsTo(PaketWisata::class, 'paket_wisata_id');
    }
    protected $casts = [
        'sort_order' => 'integer',
    ];
}
