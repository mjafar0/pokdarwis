<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Ade Winarni',
            'email' => 'ade@sttindonesia.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
        $user->assignRole(['admin']);

        $user = User::create([
            'name' => 'Wisatawan Satu',
            'email' => 'wisatawan@example.com',
            'password' => Hash::make('password123'),
            'role' => 'wisatawan'
        ]);
        $user->assignRole(['wisatawan']);

        $user = User::create([
            'name' => 'Pokdarwis Satu',
            'email' => 'pokdarwis@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pokdarwis'
        ]);
        $user->assignRole(['pokdarwis']);
    }
}
