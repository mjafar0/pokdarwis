<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];

    public function pokdarwis()
    {
        return $this->belongsTo(Pokdarwis::class);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }
}

