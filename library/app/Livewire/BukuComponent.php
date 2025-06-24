<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\kategori;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class BukuComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $kategori, $judul,$penulis, $penerbit, $isbn, $tahun, $jumlah, $cari, $id;
    public function render(){
        $layout['title']= 'Kelola Buku';
        $data['category'] = Kategori::all();
        if($this->cari != ""){
            $data['buku'] = Buku::where('judul', 'like', '%', $this->cari, '%')->paginate(10);
        } else {
            $data['buku']= Buku::paginate(10);
        }
        return view('livewire.buku-component', $data)->layoutData($layout);
    }
    public function store(){
        $this->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'isbn' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required'
        ]);
        Buku::create([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'isbn' => $this->isbn,
            'tahun' => $this->tahun,
            'jumlah' => $this->jumlah
        ]);
        session()->flash('success', 'Data berhasil ditambah');
        return redirect()->route('buku');
    }

    public function edit($id){
        $buku = Buku::find($id);
        $this->id = $buku->id;
        $this->kategori = $buku->kategori;
        $this->judul = $buku->judul;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->isbn = $buku->isbn;
        $this->tahun = $buku->tahun;
        $this->jumlah = $buku->jumlah;
    }

    public function update(){
        $buku = Buku::find($this->id);
        $buku->update([
            'kategori' => $this->kategori,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'isbn' => $this->isbn,
            'tahun' => $this->tahun,
            'jumlah' => $this->jumlah
        ]); 
        session()->flash('success', 'Data berhasil diubah');
        return redirect()->route('buku');
    }
    public function confirm($id){
        $this->id = $id;
    }
    public function destroy(){
        $buku = Buku::find($this->id);
        $buku -> delete();
        session()-> flash('success', 'Data berhasil dihapus');
        return redirect()->route('buku');
    }
}
