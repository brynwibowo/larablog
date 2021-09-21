<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Content;
use Livewire\WithPagination;
use Auth;

class Previews extends Component
{
    use WithPagination;
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
    public $published = 0;

    public function mount($slug){
        $post = Content::leftJoin('users','users.id','=','contents.author')
                ->select('contents.*','users.name')
                ->where('contents.slug', $slug)
                ->where('contents.is_published','=',false)
                ->whereNotIn('contents.kategori',['#Gallery','#Profile',])->first();
        if ($post)
        {
        $this->ids = $post->id;
        $this->judul = $post->judul;
        $this->isikonten = $post->isikonten;
        $this->author = $post->name;
        $this->views = $post->views + 1;
        $foto = explode('/',$post->photo);
        $this->photo = "/storage/" . $foto[1];
        $time = strtotime($post->created_at);
        $this->date = date("d-M-Y",$time);
        $this->status = true;
        }else{
            $this->status = false;
        }
    }

    public function publikasi($ids)
    {
      if(Auth::user()->level == 'admin')
        {
        $verifiedData = [
            'is_published' => true,
            'published_at' => date('Y-m-d'),
        ];
        Content::find($ids)->update($verifiedData); //proses mengupdate password
        $this->published = true;
       }
    }
     

    public function render()
    {
        $konten = Content::leftJoin('users','users.id','=','contents.author')
                    ->select('contents.judul','contents.photo','contents.slug','users.name','contents.published_at')
                    ->whereNotIn('contents.kategori',$this->protectKategori)
                    ->where('contents.is_published','=',true)
                    ->orderBy('contents.id','DESC')->paginate(5);
        $santri_ = Content::leftJoin('users','users.id','=','contents.author')
                    ->select('contents.judul','contents.photo','contents.slug','users.name','contents.published_at')
                    ->where('contents.kategori','#Santri')
                    ->where('contents.is_published','=',true)
                    ->orderBy('contents.id','DESC')->paginate(5);

        if ($this->status)
        {
        return view('admin.preview',['konten' => $konten, 'santri_' => $santri_])->layout('layouts.home');
        }else{
            return view('404')->layout('layouts.alela-basic');
        }
    }
}
