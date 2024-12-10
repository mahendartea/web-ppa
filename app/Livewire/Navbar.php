<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        $menu = Menu::all();
        return view('livewire.navbar', compact('menu'));
    }
}
