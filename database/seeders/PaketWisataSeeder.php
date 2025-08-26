<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaketWisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pakets = [
            [
                'pokdarwis_id'    => 6,
                'nama_paket'      => 'EXPERIENCE THE GREAT HOLIDAY ON BEACH',
                'deskripsi'       => 'Jelajahi keindahan pantai dengan pasir putih dan laut biru yang mempesona.',
                'waktu_penginapan'=> '7D/6N',
                'pax'             => 10,
                'lokasi'          => 'Malaysia',
                'img'             => 'assets/images/img4.jpg',
                'slug'            => Str::slug('EXPERIENCE THE GREAT HOLIDAY ON BEACH'),
                'harga'           => 750.00,
                'currency'        => 'USD',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'pokdarwis_id'    => 6,
                'nama_paket'      => 'SUMMER HOLIDAY TO THE OXOLOTAN RIVER',
                'deskripsi'       => 'Nikmati liburan musim panas di sungai eksotis dengan pemandangan hijau alami.',
                'waktu_penginapan'=> '5D/4N',
                'pax'             => 10,
                'lokasi'          => 'Malaysia',
                'img'             => 'assets/images/img5.jpg',
                'slug'            => Str::slug('SUMMER HOLIDAY TO THE OXOLOTAN RIVER'),
                'harga'           => 520.00,
                'currency'        => 'USD',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'pokdarwis_id'    => 6,
                'nama_paket'      => 'ADVENTURE IN KYOTO TEMPLE',
                'deskripsi'       => 'Wisata budaya dan sejarah ke kuil tua di Kyoto, Jepang.',
                'waktu_penginapan'=> '3D/2N',
                'pax'             => 15,
                'lokasi'          => 'Japan',
                'img'             => 'assets/images/img3.jpg',
                'slug'            => Str::slug('ADVENTURE IN KYOTO TEMPLE'),
                'harga'           => 300.00,
                'currency'        => 'USD',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ];

        DB::table('paket_wisata')->insert($pakets);
    }
}
