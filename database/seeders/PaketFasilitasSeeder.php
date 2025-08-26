<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            // === INCLUDE ===
            [
                'paket_wisata_id' => 4,
                'nama_item'       => 'Specialized bilingual guide',
                'tipe'            => 'include',
                'sort_order'      => 1,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'paket_wisata_id' => 4,
                'nama_item'       => 'Private Transport',
                'tipe'            => 'include',
                'sort_order'      => 2,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'paket_wisata_id' => 4,
                'nama_item'       => 'Entrance Fees',
                'tipe'            => 'include',
                'sort_order'      => 3,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'paket_wisata_id' => 4,
                'nama_item'       => 'Breakfast And Lunch Box',
                'tipe'            => 'include',
                'sort_order'      => 4,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],

            // === EXCLUDE ===
            [
                'paket_wisata_id' => 4,
                'nama_item'       => 'Guide Service Fee',
                'tipe'            => 'exclude',
                'sort_order'      => 1,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'paket_wisata_id' => 4,
                'nama_item'       => 'Room Service Fees',
                'tipe'            => 'exclude',
                'sort_order'      => 2,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'paket_wisata_id' => 4,
                'nama_item'       => 'Driver Service Fee',
                'tipe'            => 'exclude',
                'sort_order'      => 3,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'paket_wisata_id' => 4,
                'nama_item'       => 'Any Private Expenses',
                'tipe'            => 'exclude',
                'sort_order'      => 4,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ];

        DB::table('paket_fasilitas')->insert($data);
    }
}
