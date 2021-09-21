<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Content;
use Livewire\WithPagination;

class Gallery extends Component
{
    use WithPagination; //harus disertakan jika menggunakan fungsi paginasi
    protected $paginationTheme = 'bootstrap'; //tema paginasi menggunakan bootstrap
    public $foo;
    public $page=1;

    //fungsi untuk paginasi
    
    protected $queryString = [
        'foo',
        'page' => ['except' => 1],
    ];

    public function render()
    {
        $gallery = Content::select('judul','deskripsi','photo','slug')
                ->where('kategori','#Gallery')->orderBy('id','DESC')->paginate(9);
                
        return view('livewire.gallery',['gallery' => $gallery,])->layout('layouts.home');
        
    }
}
