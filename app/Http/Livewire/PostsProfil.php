<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Content;

class PostsProfil extends Component
{
    public $profile_judul;
    public $profile_image;
    public $profile_isi;

    public function render()
    {
        $profil = Content::select('judul','photo','isikonten')
                ->where('kategori','#Profile')->first();
        $pcount = Content::select('judul','photo','isikonten')
                ->where('kategori','#Profile')->count();
                if($pcount > 0)
                {
                    $this->profile_judul = $profil->judul;
                    $img = explode('/',$profil->photo);
                    $this->profile_image = $img[1];
                    $this->profile_isi = $profil->isikonten;
                }else{
                    $this->profile_judul = 'Untuk sementara konten ini belum tersedia';
                    $this->profile_image = '';
                    $this->profile_isi = '';
                }

        return view('livewire.posts-profil')->layout('layouts.home');;
    }
}
