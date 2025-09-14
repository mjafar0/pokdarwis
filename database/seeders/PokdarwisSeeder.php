<?php

namespace Database\Seeders;

use App\Models\Pokdarwis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PokdarwisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [ 'user_id' => 3, 'name_pokdarwis' => 'Gurun Telaga Biru' ],
            [ 'user_id' => 4, 'name_pokdarwis' => 'Gudem Bee Farm' ],
            [ 'user_id' => 5, 'name_pokdarwis' => 'Sumat' ],
            [ 'user_id' => 6, 'name_pokdarwis' => 'Lesung Emas' ],
            [ 'user_id' => 7, 'name_pokdarwis' => 'Manggar Abadi' ],
            [ 'user_id' => 8, 'name_pokdarwis' => 'Bajakah' ],
            [ 'user_id' => 9, 'name_pokdarwis' => 'Pemancingan Wong Dheso' ],
            [ 'user_id' => 10, 'name_pokdarwis' => 'Tekad Tani' ],
        ];

        foreach ($data as $item) {
            Pokdarwis::create([
                'user_id'        => $item['user_id'],
                'name_pokdarwis' => $item['name_pokdarwis'],
                'slug'           => Str::slug($item['name_pokdarwis']),
                'lokasi'         => 'Bintan',
                'deskripsi'      => null,
                'kontak'         => null,
            ]);
        }
        // Pokdarwis::create([
        //     'user_id' => 3,
        //     'name_pokdarwis' => 'Gurun Telaga Biru',
        //     'lokasi' => 'Bintan',
        //     'deskripsi' => 'Gurun Telaga Biru is ...',
        //     'kontak' => '083802020',
        // ]);
        
        // Pokdarwis::create([
        //     'user_id' => 4,
        //     'name_pokdarwis' => 'Gudem Bee Farm',
        //     'lokasi' => 'Bintan',
        //     'deskripsi' => 'Gudem Bee Farm is ...',
        //     'slug' => Str::slug('Gudem Bee Farm'),
        //     'kontak' => '0838020202',
        // ]);

        // Pokdarwis::create([
        //     'user_id' => 2,
        //     'name_pokdarwis' => 'Pokdarwis Satu',
        //     'lokasi' => 'Alamat Pokdarwis',
        //     'deskripsi' => 'Gudem Bee Farm adalah...',
        //     'kontak' => '083802020',
        // ]);
        
        // Pokdarwis::create([
        //     'user_id' => 3,
        //     'name_pokdarwis' => 'Pokdarwis Satu',
        //     'lokasi' => 'Alamat Pokdarwis',
        //     'deskripsi' => 'Gudem Bee Farm adalah...',
        //     'kontak' => '083802020',
        // ]);

        // Pokdarwis::create([
        //     'user_id' => 4,
        //     'name_pokdarwis' => 'Pokdarwis Satu',
        //     'lokasi' => 'Alamat Pokdarwis',
        //     'deskripsi' => 'Gudem Bee Farm adalah...',
        //     'kontak' => '083802020',
        // ]);

        // Pokdarwis::create([
        //     'user_id' => 5,
        //     'name_pokdarwis' => 'Pokdarwis Satu',
        //     'lokasi' => 'Alamat Pokdarwis',
        //     'deskripsi' => 'Gudem Bee Farm adalah...',
        //     'kontak' => '083802020',
        // ]);

        // Pokdarwis::create([
        //     'user_id' => 6,
        //     'name_pokdarwis' => 'Pokdarwis Empat',
        //     'lokasi' => 'Alamat Pokdarwis Weh',
        //     'deskripsi' => 'Gudem Bee Farm adalah...',
        //     'kontak' => '083802020',
        // ]);

    }
}
