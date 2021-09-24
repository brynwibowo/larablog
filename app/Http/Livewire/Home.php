<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PhotoSlide;
use App\Models\Content;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Home extends Component
{
    use WithPagination;
    public $protectKategori = ['#Gallery','#Profile','#Santri'];
    public $profile_judul;
    public $profile_isi;
    public function render()
    {
        $profil = Content::select('judul','deskripsi')
                ->where('kategori','#Profile')->first();
        $pcount = Content::select('judul','deskripsi')
        ->where('kategori','#Profile')->count();
        if($pcount > 0)
        {
            $this->profile_judul = $profil->judul;
            $this->profile_isi = $profil->deskripsi;
        }else{
            $this->profile_judul = "Pondok Pesantren Nurul Ummah Kebumen";
            $this->profile_isi = "Selamat datang di website resmi Pondok Pesantren Nurul Ummah Kebumen";
        }
        

        $photos = PhotoSlide::select('judul','teks','imageloc')->get();
        $albums = Content::select('judul','deskripsi','photo','slug')
                ->where('kategori','#Gallery')->orderBy('id','DESC')->paginate(6);
        $beritaz = Content::leftJoin('users','users.id','=','contents.author')
                ->select('contents.judul','contents.photo','contents.deskripsi','contents.slug','users.name','contents.published_at')
                ->whereNotIn('contents.kategori',$this->protectKategori)
                ->where('contents.is_published','=',true)
                ->orderBy('contents.id','DESC')->paginate(6);
        $santrim = Content::leftJoin('users','users.id','=','contents.author')
                ->select('contents.judul','contents.photo','contents.deskripsi','contents.slug','users.name','contents.published_at')
                ->where('contents.kategori',"#Santri")
                ->where('contents.is_published','=',true)
                ->orderBy('contents.id','DESC')->paginate(6);
        return view('livewire.home',[
            'photoslide'=> $photos,
            'albums' => $albums,
            'beritaz' => $beritaz,
            'santrim' => $santrim,
            ]) //memanggil view untuk ditampilkan
           ->layout('layouts.home'); //layout view yang digunakan 

    }
}
