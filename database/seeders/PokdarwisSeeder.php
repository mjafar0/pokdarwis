<?php

namespace Database\Seeders;

use App\Models\Pokdarwis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PokdarwisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pokdarwis::create([
            'user_id' => 1,
            'name_pokdarwis' => 'Pokdarwis Satu',
            'lokasi' => 'Alamat Pokdarwis',
            'deskripsi' => 'Gudem Bee Farm adalah...',
            'kontak' => '083802020',
        ]);
    }
}
