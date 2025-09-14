<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokdarwis extends Model
{
    use HasFactory;

    protected $table = 'pokdarwis';

    protected $fillable = [
        'user_id',
        'name_pokdarwis',
        'slug',
        'lokasi',
        'deskripsi',
        'kontak',
        'deskripsi',
        'img',
        'deskrips2',
        'phone',
        'email;',
        'facebook',
        'twitter',
        'instagram',
        'website',
    ];

    /**
     * Relasi balik ke User (One to One)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function paketWisata()
    {
        return $this->hasMany(PaketWisata::class, 'pokdarwis_id');
    }

    public function mediaKonten()
    {
        return $this->hasMany(\App\Models\MediaKonten::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function pakets()
    {
        return $this->hasMany(\App\Models\PaketWisata::class, 'pokdarwis_id');
    }
}
