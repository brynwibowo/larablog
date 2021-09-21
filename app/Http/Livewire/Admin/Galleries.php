<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Content;
use Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Auth;
use Livewire\WithPagination;

class Galleries extends Component
{
    use WithFileUploads; //harus disertakan jika ingin upload file
    use WithPagination; //harus disertakan jika menggunakan fungsi paginasi
    protected $paginationTheme = 'bootstrap'; //tema paginasi menggunakan bootstrap
    //properti
    public $ids;
    public $judul;
    public $deskripsi;
    public $kategori='#Gallery';
    public $photo;
    public $slug;
    public $isikonten;
    public $author;
    public $views;
    public $isContentList = 1;
    public $isContentForm = 0;
    public $isContentEditor = 0;
    public $isNotProfil = 1;
    public $oldPhoto;
    public $search='';
    public $foo;
    public $page=1;
    public $kategoriOps="judul";
    public $urutan = "DESC";
    
    //fungsi untuk paginasi
    protected $queryString = [
        'foo',
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    //fungsi memanggil toast/notifikasi jika proses berhasil
    public function alertSuccess($msg)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => $msg]
        );
    }
  
    //untuk meriset properti ke nilai null
    public function resetInputFields(){
        $this->judul = '';
        $this->deskripsi = '';
        $this->photo = '';
        $this->slug = '';
        $this->isikonten = '';
        $this->author = '';
        $this->views = '';
        $this->ids = '';
    }

    //fungsi ini dipanggil jika klik tombol add/tambah konten
    public function create(){
        $this->resetInputFields();//mereset kolom form
        $this->openContentForm();//membuka form content
    }
 
     //untuk membuka form konten
     public function openContentForm()
     {
         $this->isContentList = false;
         $this->isContentForm = true;
         $this->isContentEditor = false;
     }

     //membuka / menampilkan list data konten
     public function openContentList()
     {
         $this->isContentList = true; //membuka page konten list dan menutup page form dan text editor
         $this->isContentForm = false;
         $this->isContentEditor = false;
         $this->resetInputFields();
         $this->oldPhoto = '';
     }

     //membuka text editor
     public function openContentEditor()
     {
        if($this->ids != '') //jika nilai properti ids ada, properti photo tidak perlu divalidasi
        {
            if ($this->photo != '')
            {
                $this->validate([
                    'judul'=>'required',
                    'deskripsi'=>'required',
                    'photo'=>'required|image|mimes:jpeg,png,jpg|max:1024',
                  ]);
            }else{
            $this->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            ]);
           }
        }else{
            $this->validate([
                'judul'=>'required',
                'deskripsi'=>'required',
                'photo'=>'required|image|mimes:jpeg,png,jpg|max:1024',
              ]);
        }

         $this->isContentList = false; //menutup page konten list
         $this->isContentForm = false; //menutup page konten form
         $this->isContentEditor = true; //membuka text editor
     }

     //membuka modal konfirmasi hapus konten
     public function openModalDelete($ids,$judul)
     {
         $this->ids = $ids;
         $this->judul = $judul;
         $this->emit('showModalDelete');
     }
     
     //membuat slug dari judul
     public function generateSlug()
     {
         $this->slug = SlugService::createSlug(Content::class, 'slug', $this->judul);
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
       
        //memanggil alert/notifikasi
        $this->alertSuccess($message);
        
        //Membuka page data list konten
        $this->openContentList();

        //memanggil fungsi mengosongkan isi properti
        $this->resetInputFields();
    }


    //fungsi edit mengambil data dari database berdasarkan id
    public function edit($ids){
        //memanggil data berdasarkan id
        $content = Content::where('id',$ids)->first();
    
        //mengambil data ke properti
        $this->ids = $content->id;
        $this->judul = $content->judul;
        $this->deskripsi = $content->deskripsi;
        $this->kategori = '#Gallery';
        $this->isikonten = $content->isikonten;
        $this->oldPhoto = $content->photo;
        
        //membuka page form konten
        $this->openContentForm();
        
    }

    //fungsi delete untuk menghapus data konten berdasarkan id
    public function delete($id){
        
        //cek id apakah data tersedia
        if($id){
            $content = Content::find($id);
            $photo = $content->photo;
            Storage::delete($photo); //menghapus photo yang ada di storage
            Content::where('id',$id)->delete(); //menghapus database berdasarkan id
            $this->emit('galleryDeleted'); //menutup modal delete
            $this->alertSuccess($this->judul .' berhasil dihapus...'); //menampilkan notifikasi berhasil menghapus data
            $this->resetInputFields(); //mengosongkan properti
        }
    }

    //merender page konten
    public function render()
    {
      if(Auth::user()->level == 'admin')
       {  
        //akan dieksekusi jika level pengguna admin
        //memanggil data untuk ditampilkan di page konten
        $contents = Content::select('id','judul','slug','views','created_at')
            ->where('kategori','#Gallery') //data hanya menampilkan kategoru gallery
            ->orderBy('id',$this->urutan)->paginate(10); //paginasi tiap 10 data

        if ($this->search !== null) { //jika kolom search/cari diisi, memanggil data berdasarkan kata kunci dan kategori
            $contents = Content::select('id','judul','slug','views','created_at')
            ->where('kategori','#Gallery') //data hanya menampilkan kategoru gallery
            ->where($this->kategoriOps, 'like', '%' . $this->search . '%')
            ->orderBy('id',$this->urutan) //urutan bernilai ASC akan memanggil data dari yg terlama, DESC terbaru
                            ->latest()
                            ->paginate(10); //paginasi tiap 10 data
        }
        return view('admin.galleries',['contents'=>$contents]) //memanggil view untuk ditampilkan
           ->layout('layouts.alela'); //layout view yang digunakan
        }else{

            return back()->withInput();

        }
    }
}
