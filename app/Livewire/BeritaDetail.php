<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;

class BeritaDetail extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $berita = News::where('slug', $this->slug)->firstOrFail();
        return view('livewire.berita-detail', compact('berita'));
    }
}
