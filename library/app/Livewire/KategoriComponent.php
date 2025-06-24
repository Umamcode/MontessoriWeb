<?php

namespace App\Livewire;

use App\Models\kategori;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class KategoriComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama, $deskripsi, $cari, $id;
    public function render(){
        // $data['member']= User::where('jenis', 'member')->paginate(10);
        $layout['title']= 'Kelola Kategori';
        if($this->cari != ""){
            $data['kategori'] = Kategori::where('nama', 'like', '%', $this->cari, '%')->paginate(10);
        } else {
            $data['kategori']= Kategori::paginate(10);
        }
        return view('livewire.kategori-component', $data)->layoutData($layout);
    }
    public function store(){
        $this->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        Kategori::create([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
        ]);
        session()->flash('success', 'Data berhasil ditambah');
        return redirect()->route('kategori');
    }

    public function edit($id){
        $kategori = Kategori::find($id);
        $this->id = $kategori->id;
        $this->nama = $kategori->nama;
        $this->deskripsi = $kategori->deskripsi;
    }

    public function update(){
        $kategori = Kategori::find($this->id);
        $kategori->update([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi
        ]); 
        session()->flash('success', 'Data berhasil diubah');
        return redirect()->route('kategori');
    }
    public function confirm($id){
        $this->id = $id;
    }
    public function destroy(){
        $kategori = Kategori::find($this->id);
        $kategori -> delete();
        session()-> flash('success', 'Data berhasil dihapus');
        return redirect()->route('kategori');
    }
}
