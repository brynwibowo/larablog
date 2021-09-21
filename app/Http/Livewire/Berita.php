<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Content;
use Livewire\WithPagination;

class Berita extends Component
{
    use WithPagination; //harus disertakan jika menggunakan fungsi paginasi
    protected $paginationTheme = 'bootstrap'; //tema paginasi menggunakan bootstrap
    public $foo;
    public $page=1;
    public $cari='';
    public $protectKategori = ['#Gallery','#Profile','#Santri',];

    //fungsi untuk paginasi
    
    protected $queryString = [
        'foo',
        'cari' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function render()
    {
        $contents = Content::leftJoin('users','users.id','=','contents.author')
                        ->select('contents.judul','contents.deskripsi','contents.photo','contents.slug','users.name','contents.published_at')
                        ->whereNotIn('contents.kategori',$this->protectKategori)
                        ->where('contents.is_published','=',true)
                        ->orderBy('contents.id','DESC')->paginate(5);
        $santris = Content::leftJoin('users','users.id','=','contents.author')
                        ->select('contents.judul','contents.photo','contents.slug','users.name','contents.published_at')
                        ->where('contents.kategori','#Santri')
                        ->where('contents.is_published','=',true)
                        ->orderBy('contents.id','DESC')->paginate(5);

                    if ($this->cari != '') { //jika kolom search/cari diisi, memanggil data berdasarkan kata kunci dan kategori
                        $contents = Content::leftJoin('users','users.id','=','contents.author')
                        ->select('contents.judul','contents.deskripsi','contents.photo','contents.slug','users.name','contents.published_at')
                        ->whereNotIn('contents.kategori',$this->protectKategori)
                        ->where('contents.is_published','=',true)
                        ->where('contents.judul', 'like', '%' . $this->cari . '%')
                        ->orderBy('contents.id','DESC') //urutan bernilai ASC akan memanggil data dari yg terlama, DESC terbaru
                            ->paginate(5); //paginasi tiap 10 data
                    }

        
        return view('livewire.berita',['contents' => $contents, 'santris' => $santris])->layout('layouts.home');
        
    }
}
