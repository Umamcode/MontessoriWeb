<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pinjam;
use App\Models\Pengembalian;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class PengembalianComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $pinjam_id, $tgl_kembali, $denda, $cari, $id;
    public function render()
    {
        $data['pengembalian'] = Pengembalian::paginate('10');
        $data['pinjam'] = Pinjam::all();
        $layout['title'] = "Pingembalian Buku";
        return view('livewire.pengembalian-component', $data)->layoutData($layout);
    }
    public function store(){
        $this->validate([
            'pinjam_id' => 'required',
            'tgl_kembali' => 'required',
            'denda' => 'required',
        ]);
        Pengembalian::create([
            'pinjam_id' => $this->pinjam_id,
            'tgl_kembali' => $this->tgl_kembali,
            'denda' => $this->denda,
        ]);
        session()->flash('success', 'Data berhasil ditambah');
        return redirect()->route('pengembalian');
    }
    public function edit($id){
        $pengembalian = Pengembalian::find($id);
        $this->id = $pengembalian->id;
        $this->pinjam_id = $pengembalian->pinjam_id;
        $this->tgl_kembali = $pengembalian->tgl_kembali;
        $this->denda = $pengembalian->denda;
    }
    public function update(){
        $pengembalian = Pengembalian::find($this->id);
        $pengembalian->update([
            'pinjam_id' => $this->pinjam_id,
            'tgl_kembali' => $this->tgl_kembali,
            'denda' => $this->denda,
        ]); 
        session()->flash('success', 'Data berhasil diubah');
        return redirect()->route('pengembalian');
    }
    public function confirm($id){
        $this->id = $id;
    }
    public function destroy(){
        $pengembalian = Pengembalian::find($this->id);
        $pengembalian -> delete();
        session()-> flash('success', 'Data berhasil dihapus');
        return redirect()->route('pengembalian');
    }
}
