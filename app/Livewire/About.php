<?php

namespace App\Livewire;

use App\Models\VisiMisi;
use Livewire\Component;

class About extends Component
{
    public $visi;
    public $misi;
    public $misiItems;
    public $tujuan;

    public function mount()
    {
        $data = VisiMisi::first();
        $this->visi = $data->visi;
        $this->misi = $data->misi;
        $this->misiItems = $this->parseMisiToArray($data->misi); // Ubah ke array
        $this->tujuan = $this->parseMisiToArray($data->tujuan);
    }
    
    /**
     * Parse HTML misi menjadi array.
     */
    private function parseMisiToArray($html)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Abaikan error jika HTML tidak valid
        $dom->loadHTML($html);
        libxml_clear_errors();
    
        $items = [];
        foreach ($dom->getElementsByTagName('li') as $li) {
            $items[] = trim($li->nodeValue);
        }
        return $items; // Kembalikan sebagai array
    }
    
    public function render()
    {
        $visimisi = VisiMisi::all();
        return view('livewire.about', compact('visimisi'));
    }
}
