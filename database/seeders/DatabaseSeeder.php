<?php

namespace Database\Seeders;

use App\Models\Menu;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\News::factory(10)->create();

        User::factory()->create([
            "name" => "Test User",
            "email" => "admin@example.com",
            "password" => Hash::make("password"),
        ]);

        $menus = [
            [
                "name" => "Tentang",
                "slug" => Str::slug("Tentang"),
                "icon" => "about",
                "color" => "#1D4ED8",
                "urutan" => 1,
                "link" => "/tentang",
                "description" => "Halaman tentang partai.",
                "is_active" => true,
            ],
            [
                "name" => "Agenda",
                "slug" => Str::slug("agenda"),
                "icon" => "agenda",
                "color" => "#10B981",
                "urutan" => 2,
                "link" => "/agenda",
                "description" => "Agenda partai.",
                "is_active" => true,
            ],
            [
                "name" => "Aksi",
                "slug" => Str::slug("aksi"),
                "icon" => "briefcase",
                "color" => "#F59E0B",
                "urutan" => 3,
                "link" => "/aksi",
                "description" => "Halaman Aksi dan Kegiatan",
                "is_active" => true,
            ],
            [
                "name" => "Galeri",
                "slug" => Str::slug("galeri"),
                "icon" => "newspaper",
                "color" => "#EF4444",
                "urutan" => 4,
                "link" => "/galeri",
                "description" => "Kumpulan Galeri",
                "is_active" => true,
            ],
            [
                "name" => "Seputar Partai",
                "slug" => Str::slug("seputar-partai"),
                "icon" => "info-circle",
                "color" => "#3B82F6",
                "urutan" => 5,
                "link" => "/seputar-partai",
                "description" => "Seputar Partai",
                "is_active" => true,
            ],
            [
                "name" => "Berita",
                "slug" => Str::slug("berita"),
                "icon" => "phone",
                "color" => "#6B7280",
                "urutan" => 6,
                "link" => "/berita",
                "description" => "Berita partai",
                "is_active" => true,
            ],
            [
                "name" => "Informasi Publik",
                "slug" => Str::slug("informasi-publik"),
                "icon" => "info",
                "color" => "#F59E0B",
                "urutan" => 7,
                "link" => "/informasi-publik",
                "description" => "Informasi Publik",
                "is_active" => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        //        $this->call([
        //            NewsSeeder::class,
        //        ]);
    }
}
