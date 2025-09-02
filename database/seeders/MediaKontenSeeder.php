<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaKontenSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('media_konten')->insert([
            // ===== GALERI WISATA (BERDASARKAN POKDARWIS) =====
            [
                'judul_konten'  => 'Galeri Gurun Telaga Biru',
                'tipe_konten'   => 'foto',
                'konten'        => 'wisata',
                'file_path'     => 'assets/images/guruntelagabiru.jpg',
                'product_id'    => null,
                'pokdarwis_id'  => 13,       // Gurun Telaga Biru
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'judul_konten'  => 'Galeri Gudem Bee Farm',
                'tipe_konten'   => 'foto',
                'konten'        => 'wisata',
                'file_path'     => 'assets/images/img11.jpg',
                'product_id'    => null,
                'pokdarwis_id'  => 7,        // Gudem Bee Farm
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'judul_konten'  => 'Galeri Air Terjun Bajaka',
                'tipe_konten'   => 'foto',
                'konten'        => 'wisata',
                'file_path'     => 'assets/images/img14.jpg',
                'product_id'    => null,
                'pokdarwis_id'  => 6,        // Air Terjun Bajaka
                'created_at'    => $now,
                'updated_at'    => $now,
            ],

            // ===== GALERI PRODUK (BERDASARKAN PRODUK & POKDARWIS PEMILIK) =====
            [
                'judul_konten'  => 'Madu Hutan MJ 250ml',
                'tipe_konten'   => 'foto',
                'konten'        => 'produk',
                'file_path'     => 'assets/images/maduhlebah.jpg',
                'product_id'    => 1,        // product id 1 -> pokdarwis_id 6
                'pokdarwis_id'  => 6,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'judul_konten'  => 'Kerupuk Ikan 500g',
                'tipe_konten'   => 'foto',
                'konten'        => 'produk',
                'file_path'     => 'assets/images/guruntelagabiru.jpg',
                'product_id'    => 2,        // product id 2 -> pokdarwis_id 1
                'pokdarwis_id'  => 1,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'judul_konten'  => 'Kaos Souvenir',
                'tipe_konten'   => 'foto',
                'konten'        => 'produk',
                'file_path'     => 'assets/images/img13.jpg',
                'product_id'    => 3,        // product id 3 -> pokdarwis_id 2
                'pokdarwis_id'  => 2,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ]);
    }
}
