<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class PaketWisata extends Model
{
      protected $table = 'paket_wisata';

    protected $fillable = [
        'pokdarwis_id','nama_paket','deskripsi','waktu_penginapan','pax',
        'lokasi','img','slug','harga','currency',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'pax'   => 'integer',
    ];

    // Route model binding pakai slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi (opsional kalau ada model Pokdarwis)
    public function pokdarwis()
    {
        return $this->belongsTo(Pokdarwis::class,'pokdarwis_id');
    }

    // Accessor: URL gambar siap pakai di view/komponen
    public function getCoverUrlAttribute()
    {
        $img = $this->img ?: 'assets/images/img1.jpg';
        return Str::startsWith($img, ['http://','https://','//'])
            ? $img
            : asset($img);
    }

    // Accessor harga terformat
    public function getHargaFormattedAttribute()
    {
        return number_format((float)$this->harga, 2, '.', ',');
    }

    public function fasilitas()
    {
        return $this->hasMany(PaketFasilitas::class);
    }

    // helper
    public function fasilitasInclude()
    {
        return $this->hasMany(PaketFasilitas::class)->where('tipe','include')->orderBy('sort_order');
    }
    public function fasilitasExclude()
    {
        return $this->hasMany(PaketFasilitas::class)->where('tipe','exclude')->orderBy('sort_order');
    }
}
