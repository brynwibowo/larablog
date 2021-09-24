<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Contact;
use Auth;
use Livewire\WithPagination;

class Contacts extends Component
{
    use WithPagination; //harus disertakan jika menggunakan paginasi
    protected $paginationTheme = 'bootstrap';
    //properti
    public $ids;
    public $name;
    public $email;
    public $subject;
    public $text;
    public $judul;
    public $search='';
    public $foo;
    public $page=1;
    public $kategoriOps="name";
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

    public function resetInputFields(){
        $this->ids = '';
        $this->name = '';
        $this->email = '';
        $this->text = '';
        $this->judul = '';
    }

    public function delete($id){
        
        //Cek ketersediaan data
        if($id){
            $msg = Contact::find($id);
            Contact::where('id',$id)->delete(); //menghapus data
            $this->alertSuccess('Pesan dari '.$this->name . ' berhasil dihapus!'); //menampilkan notifikasi
            $this->resetInputFields(); //meriset properti / mengosongkan
            $this->emit('messageDeleted'); //menutup modal konfirmasi delete
        }
    }

    //membuka modal konfirmasi hapus konten
    public function openModalDelete($ids,$name)
    {
        $this->ids = $ids;
        $this->judul = "pesan dari " . $name;
        $this->name = $name;
        $this->emit('showModalDelete');
    }

    public function openModalDetail($ids)
    {
        $this->resetInputFields(); //meriset properti / mengosongkan
        //memanggil data berdasarkan id
        $msg = Contact::where('id',$ids)->first();
    
        //mengambil data ke properti
        $this->name = $msg->name;
        $this->email = $msg->email;
        $this->subject = $msg->subject;
        $this->text = $msg->message;
        
        //membuka page form konten
        $this->emit('showModalDetail');
    }

    public function render()
    {
        if(Auth::user()->level == 'admin')
       {  
           //akan dieksekusi jika level pengguna admin
        $msg = Contact::select('id','name','email','subject','created_at')->orderBy('id',$this->urutan)->paginate(10); //paginasi tiap 10 data
        if ($this->search != '') {
            //akan dieksekusi jika koolom pencarian terisi
            $msg = Contact::select('id','name','email','subject','created_at')
                            ->where($this->kategoriOps, 'like', '%' . $this->search . '%') //pencarian berdasarkan kata kunci dan kategori
                            ->latest()
                            ->paginate(10); //paginasi setiap 10 data
        }
        return view('admin.contacts',['messages'=>$msg]) //menampilkan view page user
           ->layout('layouts.alela'); //layout yang digunakan
        }else{
            return back()->withInput(); //jika pengguna tidak punya akses akan dikembalikan ke halaman sebelumnya

        }
    }
}
