<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokdarwis_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'cover',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'view_count',
    ];

    // 🔧 cast supaya published_at jadi Carbon (date object)
    protected $casts = [
        'published_at' => 'datetime',
        'view_count'   => 'integer',
    ];

    public function pokdarwis()
    {
        return $this->belongsTo(Pokdarwis::class);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    protected static function booted()
    {
        static::creating(function ($m) {
            if (empty($m->slug)) {
                $base = Str::slug(Str::limit($m->title, 60, ''));
                $m->slug = $base.'-'.Str::random(6);
            }
            if ($m->status === 'published' && empty($m->published_at)) {
                $m->published_at = now();
            }
        });

        static::updating(function ($m) {
            if ($m->isDirty('status') && $m->status === 'published' && empty($m->published_at)) {
                $m->published_at = now();
            }
        });
    }

    public function getCoverUrlAttribute()
    {
        $cover = $this->cover ?: 'assets/images/noimage.jpg';

    // Kalau sudah URL penuh, langsung pakai
    if (Str::startsWith($cover, ['http://','https://','//'])) {
        return $cover;
    }
    // Kalau path hasil upload (mis. posts/xxx.jpg) -> storage/...
    if (!Str::startsWith($cover, ['assets/','storage/'])) {
        return asset('storage/'.$cover);
    }
    // Aset di public/ (assets/...) atau sudah storage/
    return asset($cover);

    }

}

