<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'Berita Pertama',
                'slug' => 'berita-pertama',
                'content' => 'Konten berita pertama dalam bahasa Indonesia.',
                'caption' => 'Caption untuk berita pertama',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Berita Kedua',
                'slug' => 'berita-kedua',
                'content' => 'Konten berita kedua dalam bahasa Indonesia.',
                'caption' => 'Caption untuk berita kedua',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Berita Ketiga',
                'slug' => 'berita-ketiga',
                'content' => 'Konten berita ketiga dalam bahasa Indonesia.',
                'caption' => 'Caption untuk berita ketiga',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Tambahkan lebih banyak berita sesuai kebutuhan
        ];

        \App\Models\News::insert($news);
    }
}
