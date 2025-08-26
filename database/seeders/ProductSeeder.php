<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $rows = [
            [
                'pokdarwis_id' => 1,
                'name_product' => 'Madu Hutan 250ml',
                'deskripsi'    => 'Madu hutan murni dari Pokdarwis Gudem Bee Farm.',
                'img'          => 'assets/images/img11.jpg',
                'created_at'   => $now, 'updated_at' => $now,
            ],
            [
                'pokdarwis_id' => 1,
                'name_product' => 'Kerupuk Ikan 500g',
                'deskripsi'    => 'Camilan khas pesisir, renyah dan gurih.',
                'img'          => 'assets/images/img12.jpg',
                'created_at'   => $now, 'updated_at' => $now,
            ],
            [
                'pokdarwis_id' => 2,
                'name_product' => 'Kaos Souvenir',
                'deskripsi'    => 'Kaos katun dengan desain lokal.',
                'img'          => 'assets/images/img13.jpg',
                'created_at'   => $now, 'updated_at' => $now,
            ],
            [
                'pokdarwis_id' => 2,
                'name_product' => 'Topi Bordir',
                'deskripsi'    => 'Topi bordir motif lokal.',
                'img'          => 'assets/images/img14.jpg',
                'created_at'   => $now, 'updated_at' => $now,
            ],
            [
                'pokdarwis_id' => 3,
                'name_product' => 'Kerajinan Tangan',
                'deskripsi'    => 'Kerajinan Flora',
                'img'          => 'assets/images/img13.jpg',
                'created_at'   => $now, 'updated_at' => $now,
            ],
            [
                'pokdarwis_id' => 3,
                'name_product' => 'Kerajinan Tangan ',
                'deskripsi'    => 'Kerajinan Tangan Fauna',
                'img'          => 'assets/images/img14.jpg',
                'created_at'   => $now, 'updated_at' => $now,
            ],
        ];

        DB::table('products')->insert($rows);
    }
}
