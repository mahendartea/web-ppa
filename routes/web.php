<?php

use App\Livewire\Aksi;
use App\Livewire\Home;
use App\Livewire\About;
use App\Livewire\Agenda;
use App\Livewire\Berita;
use App\Livewire\BeritaDetail;
use App\Livewire\Galery;
use App\Livewire\InformasiPublik;
use App\Livewire\Registerasi;
use App\Livewire\SeputarPartai;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::get('/register', Registerasi::class)->name('registerasi');
Route::get('/tentang', About::class)->name('tentang');
Route::get('/agenda', Agenda::class)->name('agenda');
Route::get('/aksi', Aksi::class)->name('aksi');
Route::get('/galeri', Galery::class)->name('galeri');
Route::get('/seputar-partai', SeputarPartai::class)->name('seputar-partai');
Route::get('/berita', Berita::class)->name('berita');
Route::get('/berita/{slug}', BeritaDetail::class)->name('berita.detail');
Route::get('/informasi-publik', InformasiPublik::class)->name('informasi-publik');
