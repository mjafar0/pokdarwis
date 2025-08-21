<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiGenerate extends Model
{
    use HasFactory;

    protected $table = 'ai_generate';

    protected $fillable = [
        'prompt_text',
        'result_text',
        'pokdarwis_id',
        'created_at',
        'updated_at',
    ];

    // protected $table = 'ai_generate';

    // protected $fillable = [
    //     'prompt_text',
    //     'result_text',
    //     'pokdarwis_id',
    // ];

    // // result_text akan otomatis di-cast jadi array saat diambil
    // protected $casts = [
    //     'result_text' => 'array',
    // ];

    // public function pokdarwis()
    // {
    //     // kalau sebenarnya relasinya ke users, ini sudah aman
    //     return $this->belongsTo(\App\Models\User::class, 'pokdarwis_id');
    // }
}
