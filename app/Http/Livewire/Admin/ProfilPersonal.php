<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Profil;
use App\Exports\PersonalExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ProfilPersonal extends Component
{
    use WithPagination; //harus disertakan jika menggunakan paginasi
    protected $paginationTheme = 'bootstrap';
    public $ids;
    public $id_profil;
    public $name;
    public $sex;
    public $address;
    public $phone;
    public $position;
    public $status='-';
    public $bio='';
    public $search='';
    public $foo;
    public $page=1;
    public $kategoriOps="name";
    public $email;

    //properti berkaitan dengan fungsi pencarian
    protected $queryString = [
        'foo',
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];
    
    //fungsi menampilkan alert/notfikasi jika proses berhasil
    public function alertSuccess($msg)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => $msg]
        );
    }

    //fungsi menampilkan alert/notfikasi jika proses gagal
    public function alertError($msg)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'error',  'message' => $msg]
        );
    }

    //meriset nilai properti / mengosongkan nilai
    public function resetInputFields(){
        $this->ids = '';
        $this->name = '';
        $this->sex = '';
        $this->address = '';
        $this->phone = '';
        $this->position = '';
        $this->bio = '';
    }

    //membuka modal konfirmasi hapus user/pengguna
    public function openModalDelete($ids,$name)
    {
         $this->ids = $ids;
         $this->email = $name;
         $this->emit('showModalDelete');
    }

    //membuka modal untuk membuat pengguna baru
    public function create(){
        $this->resetInputFields();//mereset kolom form
        $this->emit('showCreateModal');//membuka modal
    }

    //fungsi ini memproses penyimpanan data baru/update data ke database
    public function store(){
       
           //akan dieksekusi jika membuat data user baru
        $this->validate([ //validasi data properti
            'name'=>'required',
            'sex'=>'required',
            'address'=>'required',
            'phone'=>'required|numeric|min:11',
            'position'=>'required',
        ]);

        $verifiedData = [ //verifikasi data yang akan ditambahkan ke database
            'name'=>$this->name,
            'sex'=>$this->sex,
            'address'=>$this->address,
            'phone'=> $this->phone,
            'position'=>$this->position,
            'status'=>$this->status,
            'bio'=>$this->bio,
        ];
        Profil::updateOrCreate(['id' => $this->ids], $verifiedData); //jika email sudah digunakan, data akan diupdate jika tidak akan menambahkan data baru
        
        if($this->ids != '' || $this->ids != null)
        {
            $this->alertSuccess($this->name . " berhasil diperbaharui!");
        }else{
            $this->alertSuccess($this->name . " berhasil ditambahkan!");
        } //menampilkan notifikasi
       

        //meriset properti / mengosongkan nilai
        $this->resetInputFields();

        $this->emit('profilAdded'); //menutup modal tambah pengguna

    }


    //fungsi memanggil data berdasarkan id dan mengambil data
    public function edit($ids){ 
    
        $profil = Profil::where('id',$ids)->first(); //memanggil data
        //mengambil data ke properti
        $this->ids = $profil->id;
        $this->name = $profil->name;
        $this->sex = $profil->sex;
        $this->address = $profil->address;
        $this->phone = $profil->phone;
        $this->position = $profil->position;
        $this->bio = $profil->bio;
        
        $this->emit('showCreateModal'); //membuka modal
        
    }

    //fungsi untuk menghapus data user/pengguna berdasarkan id
    public function delete($id){
        
        //Cek ketersediaan data
        if($id){
            $profil = Profil::find($id);
            Profil::where('id',$id)->delete(); //menghapus data
            $this->alertSuccess($this->email . ' berhasil dihapus!'); //menampilkan notifikasi
            $this->resetInputFields(); //meriset properti / mengosongkan
            $this->emit('profilDeleted'); //menutup modal konfirmasi delete
        }
    }


    public function render()
    {
        if(Auth::user()->level == 'admin')
       {  
           //akan dieksekusi jika level pengguna admin
        $profil = Profil::select('id','name','address','phone','position') //memanggil data
            ->orderBy('id','DESC')->paginate(10); //paginasi tiap 10 data
        if ($this->search != '') {
            //akan dieksekusi jika koolom pencarian terisi
            $profil = Profil::select('id','name','address','phone','position')
            ->where($this->kategoriOps, 'like', '%' . $this->search . '%') //pencarian berdasarkan kata kunci dan kategori
                            ->latest()
                            ->paginate(10); //paginasi setiap 10 data
        }
        return view('admin.profil-personal',['profils'=>$profil]) //menampilkan view page user
           ->layout('layouts.alela'); //layout yang digunakan
        }else{
            return back()->withInput(); //jika pengguna tidak punya akses akan dikembalikan ke halaman sebelumnya

        }
    }

    public function export_excel()
	{
		return Excel::download(new PersonalExport, 'data-personal_'.date("d-m-Y").'.xlsx');
	}
}
