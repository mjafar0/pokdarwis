<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Pokdarwis;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ambil 1 pokdarwis untuk jadi author default
        $pokdarwisId = Pokdarwis::inRandomOrder()->value('id') ?? 1;

        $posts = [
            // [
            //     'title'   => 'Best Journey to Peaceful Places',
            //     'excerpt' => 'Laboris hac erat dolor, posuere volutpat fringilla gravida metus nonummy...',
            //     'content' => '<p>Ini konten panjang artikel tentang perjalanan damai.</p>',
            //     'cover'   => 'assets/images/img4.jpg',
            // ],
            // [
            //     'title'   => 'Travel with Friends is the Best',
            //     'excerpt' => 'Vivamus feugiat, quam vel luctus dignissim, erat dui tincidunt nulla...',
            //     'content' => '<p>Konten lengkap artikel tentang liburan bersama teman.</p>',
            //     'cover'   => 'assets/images/img5.jpg',
            // ],
            // [
            //     'title'   => 'Santorini Island Weekend',
            //     'excerpt' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada...',
            //     'content' => '<p>Artikel penuh tentang akhir pekan di Santorini.</p>',
            //     'cover'   => 'assets/images/img6.jpg',
            // ],
            [
                'title'   => 'Padang Island Weekend',
                'excerpt' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada...',
                'content' => '<p>Artikel penuh tentang akhir pekan di Santorini.</p>',
                'cover'   => 'assets/images/guruntelagabiru.jpg',
            ],
            [
                'title'   => 'Bukittinggi Island Weekend',
                'excerpt' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada...',
                'content' => '<p>Artikel penuh tentang akhir pekan di Santorini.</p>',
                'cover'   => 'assets/images/img6.jpg',
            ],
            [
                'title'   => 'Hokkaido Island Weekend',
                'excerpt' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada...',
                'content' => '<p>Artikel penuh tentang akhir pekan di Santorini.</p>',
                'cover'   => 'assets/images/img6.jpg',
            ],
        ];

        foreach ($posts as $p) {
            Post::create([
                'pokdarwis_id'    => $pokdarwisId,
                'title'           => $p['title'],
                'slug'            => Str::slug($p['title']).'-'.Str::random(5),
                'excerpt'         => $p['excerpt'],
                'content'         => $p['content'],
                'cover'           => $p['cover'],
                'status'          => 'published',
                'published_at'    => now(),
                'meta_title'      => $p['title'],
                'meta_description'=> Str::limit($p['excerpt'], 160),
            ]);
        }
    }
}