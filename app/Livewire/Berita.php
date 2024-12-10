<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;

class Berita extends Component
{
    public function render()
    {
        $berita = News::paginate(6);
        return view('livewire.berita', compact('berita'));
    }
}
