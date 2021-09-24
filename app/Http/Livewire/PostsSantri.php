<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Content;
use Livewire\WithPagination;

class PostsSantri extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
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
    public $protectKategori = ['#Gallery','#Profile','#Santri'];

    public function mount($slug){
        $post = Content::leftJoin('users','users.id','=','contents.author')
                        ->select('contents.*','users.name')
                        ->where('contents.slug', $slug)
                        ->where('contents.is_published','=',true)
                        ->where('contents.kategori','#Santri')->first();
        if ($post)
        {
        $this->judul = $post->judul;
        $this->isikonten = $post->isikonten;
        $this->author = $post->name;
        $this->views = $post->views + 1;
        $foto = explode('/',$post->photo);
        $this->photo = "/storage/" . $foto[1];
        $view = Content::find($post->id);
        $view->update(['views' => $this->views]);
        $time = strtotime($post->published_at);
        $this->date = date("d-M-Y",$time);
        $this->status = true;
        }else{
            $this->status = false;
        }
    }

    public function render()
    {
        $contenty = Content::leftJoin('users','users.id','=','contents.author')
                    ->select('contents.judul','contents.photo','contents.slug','users.name','contents.published_at')
                    ->whereNotIn('contents.kategori',$this->protectKategori)
                    ->where('contents.is_published','=',true)
                    ->orderBy('contents.id','DESC')->paginate(5);
        $santriy = Content::leftJoin('users','users.id','=','contents.author')
                    ->select('contents.judul','contents.photo','contents.slug','users.name','contents.published_at')
                    ->where('contents.kategori','#Santri')
                    ->where('contents.is_published','=',true)
                    ->orderBy('contents.views','DESC')->paginate(5);
        if ($this->status)
        {
        return view('livewire.posts-santri',['contenty' => $contenty,'santriy' => $santriy])->layout('layouts.home');
        }else{
            return view('404')->layout('layouts.basic');
        }
    }
}
