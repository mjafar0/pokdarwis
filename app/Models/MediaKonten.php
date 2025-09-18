<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MediaKonten extends Model
{

    
    // protected $table = 'media_konten';
    // protected $fillable = [
    //     'judul_konten','tipe_konten','konten','file_path','product_id','destinasi_wisata_id'
    // ];

    // // url siap pakai untuk <img src="...">
    // public function getUrlAttribute(): string
    // {
    //     $p = $this->file_path ?? '';
    //     if (!$p) return asset('assets/images/noimage.jpg');
    //     if (Str::startsWith($p, ['http://','https://','//'])) return $p;
    //     if (Str::startsWith($p, ['assets/'])) return asset($p);
    //     return asset('storage/'.$p); // disimpan di storage/app/public/...
    // }

    // /* (opsional) relasi */
    // public function product()  { return $this->belongsTo(Product::class); }
    // public function destinasi(){ return $this->belongsTo(DestinasiWisata::class, 'destinasi_wisata_id'); }

    // /* (opsional) scopes */
    // public function scopeKonten($q, string $jenis) { return $q->where('konten', $jenis); }
    // public function scopeFoto($q)  { return $q->where('tipe_konten', 'foto'); }
    // public function scopeVideo($q) { return $q->where('tipe_konten', 'video'); }

     protected $table = 'media_konten';
     
     protected $fillable = [
        'judul_konten', 'tipe_konten', 'konten',
        'file_path', 'product_id', 'pokdarwis_id',
    ];

    // relasi opsional
    public function product() { return $this->belongsTo(Product::class); }

    // URL file (assets/*, storage/*, atau http…)
    public function getUrlAttribute(): string
    {
        $p = $this->file_path ?? '';
        if (!$p) return asset('assets/images/noimage.jpg');
        if (Str::startsWith($p, ['http://','https://','//'])) return $p;
        if (Str::startsWith($p, ['assets/'])) return asset($p);
        return asset('storage/'.$p);
    }

    public function scopePhotos($q)
    {
        return $q->where('tipe_konten', 'foto');
    }


    // optional: thumbnail (pakai file yang sama dahulu)
    public function getThumbUrlAttribute(): string
    {
        return $this->url;
    }

    public function toGalleryItem(): array
    {
        return [
            'src'  => $this->url,
            'alt'  => $this->judul_konten ?: 'Photo',
            'type' => 'foto',
        ];
    }

    // scopes
    public function scopeForPokdarwis($q, $id) { return $q->where('pokdarwis_id', $id); }

}