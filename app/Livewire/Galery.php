<?php

namespace App\Livewire;

use App\Models\Galery as ModelsGalery;
use Livewire\Component;

class Galery extends Component
{
    public $selectedCategory = 'all';

    public function filterCategory($category)
    {
        $this->selectedCategory = $category;
    }

    public function render()
    {
        $query = ModelsGalery::query();

        if ($this->selectedCategory !== 'all') {
            $query->where('kategori', $this->selectedCategory);
        }

        $galeri = $query->paginate(6);

        $categories = ModelsGalery::distinct()->pluck('kategori');

        return view('livewire.galery', compact('galeri', 'categories'));
    }
}
