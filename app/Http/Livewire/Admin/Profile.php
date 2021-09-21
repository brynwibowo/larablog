<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Content;
use Auth;
use Storage;
use Livewire\WithFileUploads;

class Profile extends Component
{
    //properti
    use WithFileUploads; //harus disertakan jika ingin upload file
    public $ids;
    public $judul;
    public $deskripsi;
    public $kategori='#Profile';
    public $photo;
    public $slug='profil';
    public $isikonten;
    public $author;
    public $views;
    public $isNotProfil = 0;
    public $isContentButton = 1;
    public $isContentEditor = 0;
    public $oldPhoto;
    
    
    //fungsi memanggil toast/notifikasi jika proses berhasil
    public function alertSuccess($msg)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => $msg]
        );
    }

    public function validasi()
    {
        if($this->ids != '') //jika nilai properti ids ada, properti photo tidak perlu divalidasi
        {
            if ($this->photo != '')
            {
                $this->validate([
                    'judul' =>  'required',
                    'deskripsi' => 'required',
                    'photo'=>'required|image|mimes:jpeg,png,jpg|max:1024',
                  ]);
            }else{
                $this->validate([
                    'judul' =>  'required',
                    'deskripsi' => 'required',
                  ]);
            }
        }else{
            
            $this->validate([
                'judul' =>  'required',
                'deskripsi' => 'required',
                'photo'=>'required|image|mimes:jpeg,png,jpg|max:1024',
              ]);
            
        }

            $this->emit('closeProfilModal');
            $this->isContentEditor = true;
            $this->isContentButton = false;
            
    }

    public function edit()
    {
        $profil = Content::where('kategori',$this->kategori)->first();
        $pcount = Content::where('kategori',$this->kategori)->count();
            if($pcount > 0)
            {
                $this->ids = $profil->id;
                $this->judul = $profil->judul;
                $this->oldPhoto = $profil->photo;
                $this->deskripsi = $profil->deskripsi;
                $this->isikonten = $profil->isikonten;
            }else{
                $this->ids = '';
                $this->judul = '';
                $this->oldPhoto = '';
                $this->deskripsi = '';
                $this->isikonten = '';
            }

            $this->emit('showCreateProfilModal');

    }

    //proses meyimpan data baru/update ke database
    public function store(){
       
        $this->validate([ //memvalidasi isi konten
            'isikonten'=>'required',
        ]);

        //jika properti ids kosong properti image langsung di upload ke storage 
        if ($this->ids != '')
        {
            $imageUpload = $this->oldPhoto;
            if($this->photo != '') //jika properti photo kosong maka kolom properti masih dengan value yang lama
            {
                $imageUpload = $this->photo->store('public'); //upload file ke storage jika properti photo ada
                Storage::delete($this->oldPhoto);
            }

        }else{
            $imageUpload = $this->photo->store('public');
        }
        
       
        //verifikasi data yang akan dimasukkan ke database
        $verifiedData = [
            'judul'=>$this->judul,
            'deskripsi'=>$this->deskripsi,
            'kategori'=>$this->kategori,
            'photo'=> $imageUpload,
            'slug'  => $this->slug,
            'isikonten'=>$this->isikonten,
            'author' => Auth::user()->id,
        ];

        //jika id belum ada maka proses create baru, jika sudah ada akan mengupdate data yang sudah ada
        Content::updateOrCreate(['id' => $this->ids], $verifiedData);

        //pesan untuk notifikasi disesuaikan dengan kondisi create baru atau update
        if($this->ids != '')
        {
            $message = $this->judul . " berhasil diperbaharui!";
        }else{
            $message = $this->judul . " berhasil ditambahkan!";
        }
       
        $this->isContentEditor = false;
        $this->isContentButton = true;
        //memanggil alert/notifikasi
        $this->alertSuccess($message);
        
    }

    //merender page konten
    public function render()
    {
      if(Auth::user()->level == 'admin')
       {  
        
        return view('admin.profile') //memanggil view untuk ditampilkan
           ->layout('layouts.alela'); //layout view yang digunakan
        }else{
            return back()->withInput();
        }
    }
}
