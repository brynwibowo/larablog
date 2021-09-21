<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Kontak extends Component
{
    public function render()
    {
        return view('livewire.kontak')->layout('layouts.home');
    }
}
