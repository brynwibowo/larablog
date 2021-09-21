<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Content;
use Livewire\WithPagination;

class PostsGallery extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; //tema paginasi menggunakan bootstrap
    public $foo;
    public $page=1;
    public $ids;
    public $judul;
    public $deskripsi;
    public $kategori;
    public $photo;
    public $slug;
    public $isikonten;
    public $author;
    public $views;
    public $date;
    public $status=0;
    public $search='';
    public $protectKategori = ['#Gallery','#Profile','#Santri'];

    protected $queryString = [
        'foo',
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount($slug){
        $post = Content::where('slug', $slug)
                        ->where('kategori','#Gallery')->first();
        if ($post)
        {
        $this->judul = $post->judul;
        $this->isikonten = $post->isikonten;
        $this->author = $post->author;
        $this->views = $post->views + 1;
        $foto = explode('/',$post->photo);
        $this->photo = "/storage/" . $foto[1];
        $view = Content::find($post->id);
        $view->update(['views' => $this->views]);
        $time = strtotime($post->created_at);
        $this->date = date("d-M-Y",$time);
        $this->status = true;
        }else{
            $this->status = false;
        }
    }

    public function render()
    {
        $album = Content::select('judul','photo','slug','created_at')
                    ->where('kategori','#Gallery')
                    ->orderBy('id','DESC')->paginate(5);

                    if ($this->search != '') { //jika kolom search/cari diisi, memanggil data berdasarkan kata kunci dan kategori
                        $album = Content::select('judul','photo','slug','created_at')
                        ->where('kategori','#Gallery')
                        ->where('judul', 'like', '%' . $this->search . '%')
                        ->orderBy('id','DESC') //urutan bernilai ASC akan memanggil data dari yg terlama, DESC terbaru
                                        ->latest()
                                        ->paginate(5); //paginasi tiap 5 data
                    }
        if ($this->status)
        {
        return view('livewire.posts-gallery',['album' => $album])->layout('layouts.home');
        }else{
            return view('404')->layout('layouts.basic');
        }
    }
}
