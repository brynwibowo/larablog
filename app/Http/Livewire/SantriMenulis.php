<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Content;
use Livewire\WithPagination;

class SantriMenulis extends Component
{
    use WithPagination; //harus disertakan jika menggunakan fungsi paginasi
    protected $paginationTheme = 'bootstrap'; //tema paginasi menggunakan bootstrap
    public $foo;
    public $page=1;
    public $search='';
    public $protectKategori = ['#Gallery','#Profile','#Santri',];

    //fungsi untuk paginasi
    protected $queryString = [
        'foo',
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function render()
    {
        $santri = Content::leftJoin('users','users.id','=','contents.author')
                    ->select('contents.judul','contents.deskripsi','contents.photo','contents.slug','users.name','contents.published_at')
                    ->where('contents.kategori','#Santri')
                    ->where('contents.is_published','=',true)
                    ->orderBy('contents.id','DESC')->paginate(5);
        $content = Content::leftJoin('users','users.id','=','contents.author')
                    ->select('contents.judul','contents.photo','contents.slug','users.name','contents.published_at')
                    ->whereNotIn('contents.kategori',$this->protectKategori)
                    ->where('contents.is_published','=',true)
                    ->orderBy('contents.id','DESC')->paginate(5);

                    if ($this->search != '') { //jika kolom search/cari diisi, memanggil data berdasarkan kata kunci dan kategori
                        $santri = Content::leftJoin('users','users.id','=','contents.author')
                        ->select('contents.judul','contents.deskripsi','contents.photo','contents.slug','users.name','contents.published_at')
                        ->where('contents.kategori','#Santri')
                        ->where('contents.is_published','=',true)
                        ->where('contents.judul', 'like', '%' . $this->search . '%')
                        ->orderBy('contents.id','DESC') //urutan bernilai ASC akan memanggil data dari yg terlama, DESC terbaru
                            ->paginate(5); //paginasi tiap 10 data
                    }

        
        return view('livewire.santri-menulis',['content' => $content, 'santri' => $santri])->layout('layouts.home');
        
    }
}
