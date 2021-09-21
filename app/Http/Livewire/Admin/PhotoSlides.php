<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PhotoSlide;
use Storage;
use Auth;
use Livewire\WithPagination;

class PhotoSlides extends Component
{
    use WithFileUploads; //harus disertakan jika ingin upload file
    use WithPagination; //harus disertakan jika menggunakan fungsi paginasi
    protected $paginationTheme = 'bootstrap'; //tema paginasi menggunakan bootstrap
    //properti
    public $ids;
    public $judul='';
    public $teks='';
    public $imageloc;
    public $oldPhoto;
    public $search='';
    public $foo;
    public $page=1;
    
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
        $this->teks = '';
        $this->imageloc = '';
        $this->ids = '';
    }

    //fungsi ini dipanggil jika klik tombol add/tambah konten
    public function create(){
        $this->resetInputFields();//mereset kolom form
        $this->emit('showPhotoSlideForm');//membuka form content
    }
 
     
     //membuka modal konfirmasi hapus konten
     public function openModalDelete($ids,$judul)
     {
         $this->ids = $ids;
         $this->judul = $judul;
         $this->emit('showModalDelete');
     }
     

    //proses meyimpan data baru/update ke database
    public function store(){
       
        //jika properti ids kosong properti image langsung di upload ke storage 
        if ($this->ids != '')
        {
            $imageUpload = $this->oldPhoto;
            if($this->imageloc != '') //jika properti photo kosong maka kolom properti masih dengan value yang lama
            {
                $this->validate([ //memvalidasi isi konten
                    'imageloc'=>'required|image|mimes:jpeg,png,jpg|max:1536',
                ]);
                $imageUpload = $this->imageloc->store('public'); //upload file ke storage jika properti photo ada
                Storage::delete($this->oldPhoto);
            }

        }else{
            $this->validate([ //memvalidasi isi konten
                'imageloc'=>'required|image|mimes:jpeg,png,jpg|max:1536',
            ]);
            $imageUpload = $this->imageloc->store('public');
        }

        //verifikasi data yang akan dimasukkan ke database
        $verifiedData = [
            'judul'=>$this->judul,
            'teks'=>$this->teks,
            'imageloc'=>$imageUpload,
        ];

        //jika id belum ada maka proses create baru, jika sudah ada akan mengupdate data yang sudah ada
        PhotoSlide::updateOrCreate(['id' => $this->ids], $verifiedData);

        //pesan untuk notifikasi disesuaikan dengan kondisi create baru atau update
        if($this->ids != '')
        {
            $message = "Gambar slide berhasil diperbaharui!";
        }else{
            $message = "Gambar slide berhasil ditambahkan!";
        }
       
        //memanggil alert/notifikasi
        $this->alertSuccess($message);
        
        //Menutup form modal
        $this->emit('photoSlideAdded');

        //memanggil fungsi mengosongkan isi properti
        $this->resetInputFields();
    }


    //fungsi edit mengambil data dari database berdasarkan id
    public function edit($ids){
        //memanggil data berdasarkan id
        $photo = PhotoSlide::where('id',$ids)->first();
    
        //mengambil data ke properti
        $this->ids = $photo->id;
        $this->judul = $photo->judul;
        $this->teks = $photo->teks;
        $this->oldPhoto = $photo->imageloc;
        
        //membuka page form konten
        $this->emit('showPhotoSlideForm');
        
    }

    //fungsi delete untuk menghapus data konten berdasarkan id
    public function delete($id){
        
        //cek id apakah data tersedia
        if($id){
            $photo = PhotoSlide::find($id);
            $foto = $photo->imageloc;
            Storage::delete($foto); //menghapus photo yang ada di storage
            PhotoSlide::where('id',$id)->delete(); //menghapus database berdasarkan id
            $this->emit('photoSlideDeleted'); //menutup modal delete
            $this->alertSuccess('Gambar slide berhasil dihapus...'); //menampilkan notifikasi berhasil menghapus data
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
        $photo = PhotoSlide::select('id','judul','teks','imageloc')
            ->orderBy('id','DESC')->paginate(10); //paginasi tiap 10 data

        if ($this->search !== null) { //jika kolom search/cari diisi, memanggil data berdasarkan kata kunci
            $photo = PhotoSlide::select('id','judul','teks','imageloc')
            ->where('judul', 'like', '%' . $this->search . '%')
            ->orderBy('id','DESC') //urutan bernilai ASC akan memanggil data dari yg terlama, DESC terbaru
                            ->latest()
                            ->paginate(10); //paginasi tiap 10 data
        }
        return view('admin.photoslide',['contents'=>$photo]) //memanggil view untuk ditampilkan
           ->layout('layouts.alela'); //layout view yang digunakan
        }else{
            return back()->withInput();

        }
    }
}
