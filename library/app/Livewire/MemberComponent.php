<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MemberComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama, $telepon, $email, $alamat, $password, $cari, $id;
    public function render(){
        // $data['member']= User::where('jenis', 'member')->paginate(10);
        $layout['title']= 'Kelola Member';
        if($this->cari != ""){
            $data['member'] = User::where('jenis', 'member')
                ->orWhere('nama', 'like', '%', $this->cari, '%')
                ->orWhere('email', 'like', '%', $this->cari, '%')
                ->paginate(10);
        } else {
            $data['member']= User::where('jenis', 'member')->paginate(10);
        }
        return view('livewire.member-component', $data)->layoutData($layout);
    }
    public function store(){
        $this->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'email' => 'required',
            'alamat' => 'required',
        ]);
        User::create([
            'nama' => $this->nama,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'password' => Hash::make($this->password),
            'jenis' => 'member'
        ]);
        session()->flash('success', 'Data berhasil ditambah');
        return redirect()->route('member');
    }
    public function edit($id){
        $member = User::find($id);
        $this->id = $member->id;
        $this->nama = $member->nama;
        $this->alamat = $member->alamat;
        $this->telepon = $member->telepon;
        $this->email = $member->email;
    }
    public function update(){
        $member = User::find($this->id);
        $member->update([
            'nama' => $this->nama,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'jenis' => 'member'
        ]); 
        session()->flash('success', 'Data berhasil diubah');
        return redirect()->route('member');
    }
    public function confirm($id){
        $this->id = $id;
    }
    public function destroy(){
        $member = User::find($this->id);
        $member -> delete();
        session()-> flash('success', 'Data berhasil dihapus');
        return redirect()->route('member');
    }
}
