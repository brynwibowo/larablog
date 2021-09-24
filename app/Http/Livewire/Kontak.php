<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;

class Kontak extends Component
{
    public $name;
    public $email;
    public $subject;
    public $text;
    public $status='';
    public $agreement=0;
    public $cls;

    public function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->subject = '';
        $this->text = '';
        $this->agreement=0;
    }

    public function store(){
        $this->status='';
        $this->validate([ //memvalidasi isi konten
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'text'=>'required',
        ]);
        if($this->agreement)
        {
        $verifiedData = [
            'name'=>$this->name,
            'email'=> $this->email,
            'subject'=>$this->subject,
            'message'=> $this->text,
        ];

        Contact::create($verifiedData);
        $this->status = "Pesan berhasil terkirim!";
        $this->cls = "text-success";
        $this->resetInputFields();
        }else{
            $this->status = "Klik saya setuju";
            $this->cls = "text-danger";
        }
    }
    public function render()
    {
        return view('livewire.kontak')->layout('layouts.home');
    }
}
