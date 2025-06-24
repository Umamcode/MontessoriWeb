<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User; 
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;


class UserComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama, $email, $password, $id, $cari;
    public function render()
    {
        $layout['title'] = 'Kelola User';
        if($this->cari != ""){
            $data['user']= User::Where('nama', 'like', '%'.$this->cari.'%')->orwhere('email', 'like', '%'.$this->cari.'%')
            ->paginate(10);
        } else {
            $data['user']= User::paginate(10);
        }
        return view('livewire.user-component', $data)->layoutData($layout);
    }
    public function store(){
        $this->validate([
            'nama'=> 'required',
            'email' => 'required',
            'password' => 'required'
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format Email salah',
            'password' => 'Password wajib diisi'
        ]);
        User::create([
            'nama'=>$this->nama,
            'email'=>$this->email,
            'password'=> Hash::make($this->password),
            'jenis'=> 'admin'
        ]);
        session()->flash('success', 'Data berhasil disimpan');
        $this->reset();
    }

    public function edit($id){
        $user = User::find($id);
        $this->nama = $user->nama;
        $this->email = $user->email;
         $this->id= $user->id;
    }
    public function update(){
        $user = User::find($this->id);
        if($this->password==""){
            $user->update([
                'nama'=>$this->nama,
                'email'=>$this->email
            ]);
        } else {
            $user->update([
                'nama' => $this->nama,
                'email'=> $this->email,
                'password' => $this->password
            ]);
        }
        session()->flash('success', 'Data berhasil diubah');
        $this->reset();
    }

    public function confirm($id){
        $this->id = $id;
    }
    public function destroy(){
        $user = User::find($this->id);
        $user -> forceDelete();
        session()-> flash('success', 'Data berhasil dihapus');
        return redirect()->route('user');
        // $this->reset();
    }

        public function mount()
    {
        if (auth()->user()->jenis !== 'admin') {
            abort(403, 'Akses ditolak');
        }
    }
}
