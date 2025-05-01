<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as ModelUser;

class User extends Component
{
   public $pilihanMenu = 'lihat';
   public $nama, $email, $password, $role, $penggunaTerpilih;
   
   public function mount(){
    if(auth()->user()->role != 'admin'){
        abort(403);
    }
   }

   public function simpan()
   {
       $this->validate([
            'nama' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required',
            'role' => 'required',
       ], [
            'nama.required' => 'Nama Harus Diisi!',
            'email.required' => 'Email Harus Diisi!',
            'email.email' => 'Email Harus Valid!',
            'email.unique' => 'Email Sudah Terdaftar!',
            'password.required' => 'Password Harus Diisi!',
            'role.required' => 'Role Harus Diisi!',
       ]);
       $simpan= new ModelUser();
       $simpan->name = $this->nama;
       $simpan->email = $this->email;
       $simpan->password = bcrypt($this->password);
       $simpan->role = $this->role;
       $simpan->save();
       $this->reset(['nama', 'email', 'password', 'role']);
       $this->pilihanMenu = 'lihat';
   }

   public function pilihEdit($id)
   {
       $this->penggunaTerpilih = ModelUser::findOrFail($id);
       $this->nama = $this->penggunaTerpilih->name; 
       $this->email = $this->penggunaTerpilih->email; 
       $this->role = $this->penggunaTerpilih->role;
       $this->pilihanMenu = 'edit';
   }

   public function simpanEdit()
   {
    $this->validate([
        'nama' => 'required',
        'email' => ['required', 'email', 'unique:users,email,'.$this->penggunaTerpilih->id],
        'role' => 'required',
   ], [
        'nama.required' => 'Nama Harus Diisi!',
        'email.required' => 'Email Harus Diisi!',
        'email.email' => 'Email Harus Valid!',
        'email.unique' => 'Email Sudah Terdaftar!',
        'role.required' => 'Role Harus Diisi!',
   ]);
   $simpan= $this->penggunaTerpilih;
   $simpan->name = $this->nama;
   $simpan->email = $this->email;
   if($this->password)
   {
    $simpan->password = bcrypt($this->password);
   }
   $simpan->role = $this->role;
   $simpan->save();

   $this->reset(['nama', 'email', 'password', 'role']);
   $this->pilihanMenu = 'lihat';
   }
   public function pilihHapus($id)
   {
       $this->penggunaTerpilih = ModelUser::findOrFail($id);
       $this->pilihanMenu = 'hapus';
   }
   
   public function hapus()
   {
       $this->penggunaTerpilih->delete();
       $this->reset();
       $this->pilihanMenu = 'lihat';
   }
   public function batal()
   {
    $this->reset();
   }

public function pilihMenu($menu)
   {
       $this->pilihanMenu = $menu;
   }
    public function render()
    {
        return view('livewire.user')->with([
            'semuaPengguna' => ModelUser::all()
        ]);
    }
}
