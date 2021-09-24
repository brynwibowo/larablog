<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class Users extends Component
{
    use WithPagination; //harus disertakan jika menggunakan paginasi
    protected $paginationTheme = 'bootstrap';
    //properti
    public $ids;
    public $name;
    public $email;
    public $password;
    public $confirmPassword;
    public $level;
    public $oldEmail;
    public $isChangeProfil=0;
    public $search='';
    public $foo;
    public $page=1;
    public $kategoriOps="name";
    public $modalTitle;
    
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
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->confirmPassword = '';
        $this->level = '';
        $this->ids = '';
        $this->modalTitle='';
    }

    //membuka modal konfirmasi hapus user/pengguna
    public function openModalDelete($ids,$email)
    {
         $this->ids = $ids;
         $this->email = $email;
         $this->emit('showModalDelete');
    }

    //membuka modal untuk membuat pengguna baru
    public function create(){
        $this->resetInputFields();//mereset kolom form
        $this->emit('showCreateModal');//membuka modal
    }

    //fungsi ini memproses penyimpanan data baru/update data ke database
    public function store(){
       if ($this->ids != '')
       {
           //akan dieksekusi jika ingin mengupdate data user
           if($this->isChangeProfil)
           {
               //akan dieksekusi jika ingin mengubah profil user
                if($this->oldEmail == $this->email)
                {
                    //akan dieksekusi jika email masih menggunakan email yang lama
                    $this->validate([ //validasi roperti
                        'name'=>'required',
                        'email'=>'required|email',
                        'level'=>'required',
                    ]);
            
                    $verifiedData = [ //verifikasi data yang akan diupdate ke database
                        'name'=>$this->name,
                        'level'=> $this->level,
                    ];
                    User::find($this->ids)->update($verifiedData); //proses update kedatabase
                    $this->alertSuccess($this->email . " berhasil diperbaharui!"); //menampilkan notifikasi 
                }else{
                    //akan dieksekusi jika email diubah dengan yang baru
                    $this->validate([ //validasi properti
                        'name'=>'required',
                        'email'=>'required|email',
                        'level'=>'required',
                    ]);
            
                    $verifiedData = [ //verifikasi data yang akan diupdate ke database
                        'name'=>$this->name,
                        'email'=>$this->email,
                        'level'=> $this->level,
                    ];
                    //cek apakah email yang diubah sudah dipakai oleh pengguna lain?
                    $count = User::where('email','=',$this->email)->count();
                    if($count > 0)
                    {
                        //jika email sudah dipakai pengguna lain akan merespon menampilkan notifikasi email sudah terpakai
                        $this->alertError($this->email . " Email sudah digunakan!");
                    }else{
                        //jika email belum terpakai, proses update data dilanjutkan
                        User::find($this->ids)->update($verifiedData);
                        $this->alertSuccess($this->email . " berhasil diperbaharui!");
                    }
                }
           }else{

            //akan dieksekusi jika ingin mengubah password user
            $this->validate([ //validasi password
                'password'=>'required|string|min:8|same:confirmPassword',
                'confirmPassword'=>'required',
            ]);
    
            $verifiedData = [ //verifikasi dan enkripsi password yang akan diupdate
                'password'=>Hash::make($this->password),
            ];
            User::find($this->ids)->update($verifiedData); //proses mengupdate password
            $this->alertSuccess("Password berhasil diperbaharui!"); //menampilkan notifikasi
           }

       }else{
           //akan dieksekusi jika membuat data user baru
        $this->validate([ //validasi data properti
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|string|min:8|same:confirmPassword',
            'confirmPassword'=>'required',
            'level'=>'required',
        ]);

        $verifiedData = [ //verifikasi data yang akan ditambahkan ke database
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'level'=> $this->level,
        ];
        User::updateOrCreate(['email' => $this->email], $verifiedData); //jika email sudah digunakan, data akan diupdate jika tidak akan menambahkan data baru
        $this->alertSuccess($this->email . " berhasil ditambahkan!"); //menampilkan notifikasi
       }

        //meriset properti / mengosongkan nilai
        $this->resetInputFields();

        $this->emit('userAdded'); //menutup modal tambah pengguna
        $this->emit('userUpdated'); //menutup modal update pengguna

    }


    //fungsi memanggil data berdasarkan id dan mengambil data
    public function edit($ids,$token){ //dua parameter id dan token
    
        if($token) 
        {
            //jika token bernilai true akan mengupdate name, enail dan level
        $user = User::select('id','name','email','level')->where('id',$ids)->first(); //memanggil data
        //mengambil data ke properti
        $this->ids = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->level = $user->level;
        $this->oldEmail = $user->email;
        $this->modalTitle ="Update Profil Users";
        $this->isChangeProfil = true; //memberi nilai true untuk mengubah profil
        }else{
            $user = User::select('id')->where('id',$ids)->first(); //memanggil data
            $this->ids = $user->id;
            $this->modalTitle ="Update Password Users";
            $this->isChangeProfil = false; //memberi nilai false untuk mengubah password
           }

        $this->emit('showUpdateModal'); //membuka modal update user
        
    }

    //fungsi untuk menghapus data user/pengguna berdasarkan id
    public function delete($id){
        
        //Cek ketersediaan data
        if($id){
            $user = User::find($id);
            User::where('id',$id)->delete(); //menghapus data
            $this->alertSuccess($this->email . ' berhasil dihapus!'); //menampilkan notifikasi
            $this->resetInputFields(); //meriset properti / mengosongkan
            $this->emit('userDeleted'); //menutup modal konfirmasi delete
        }
    }

    //merender data user untuk ditampilkan di page user
    public function render()
    {
      if(Auth::user()->level == 'admin')
       {  
           //akan dieksekusi jika level pengguna admin
        $users = User::select('id','name','email','level') //memanggil data
            ->whereNotIn('level',['admin']) //pengguna level admin tidak ditampilkan
            ->orderBy('id','DESC')->paginate(10); //paginasi tiap 10 data
        if ($this->search != '') {
            //akan dieksekusi jika koolom pencarian terisi
            $users = User::select('id','name','email','level')
            ->whereNotIn('level',['admin'])
            ->where($this->kategoriOps, 'like', '%' . $this->search . '%') //pencarian berdasarkan kata kunci dan kategori
                            ->latest()
                            ->paginate(10); //paginasi setiap 10 data
        }
        return view('admin.users',['users'=>$users]) //menampilkan view page user
           ->layout('layouts.alela'); //layout yang digunakan
        }else{
            return back()->withInput(); //jika pengguna tidak punya akses akan dikembalikan ke halaman sebelumnya

        }
    }
}
