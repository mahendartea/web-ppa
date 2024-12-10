<?php

namespace App\Livewire;

use App\Models\News;
use App\Models\Galery;
use App\Models\Slider;
use Livewire\Component;

class Home extends Component
{
    public $selectedKategori = null;

    public function render()
    {
        // Query untuk galeri dengan filter kategori
        $galeriQuery = Galery::query();
        if ($this->selectedKategori) {
            $galeriQuery->where('kategori', $this->selectedKategori);
        }
        $galeri = $galeriQuery->latest()->take(6)->get();

        // Query untuk berita terbaru
        $news = News::latest()->take(3)->get();

        // Query untuk sliders
        $sliders = Slider::query()
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->whereDate('start_date', '<=', now())
                        ->whereDate('end_date', '>=', now());
                })
                    ->orWhere(function ($query) {
                        $query->whereNull('start_date');
                    });
            })
            ->whereNotNull('image') // Ensure the image is not null
            ->latest()
            ->get();

        return view('livewire.home', [
            'galeri' => $galeri,
            'news' => $news,
            'sliders' => $sliders,
        ]);
    }

    public function filterKategori($kategori = null)
    {
        $this->selectedKategori = $kategori;
    }
}
