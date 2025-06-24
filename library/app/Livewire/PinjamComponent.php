<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pinjam;
use App\Models\Buku;
use App\Models\User;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class PinjamComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $user_id, $buku_id, $tgl_pinjam, $tgl_kembali, $status, $cari, $id;
    public function render()
    {
         $data['member'] = User::where('jenis', 'member')->get();
         $data['buku'] = Buku::all();
        $data['pinjam'] = Pinjam::paginate('10');
        $layout['title'] = "Pinjam Buku";
        return view('livewire.pinjam-component', $data)->layoutData($layout);
    }

    public function store(){
        $this->validate([
            'buku_id' => 'required',
            'user_id' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'status' => 'required',
        ]);
        Pinjam::create([
            'buku_id' => $this->buku_id,
            'user_id' => $this->user_id,
            'tgl_pinjam' => $this->tgl_pinjam,
            'tgl_kembali' => $this->tgl_kembali,
            'status' => $this->status,
        ]);
        session()->flash('success', 'Data berhasil ditambah');
        return redirect()->route('pinjam');
    }
    public function edit($id){
        $pinjams = Pinjam::find($id);
        $this->id = $pinjams->id;
        $this->buku_id = $pinjams->buku_id;
        $this->user_id = $pinjams->user_id;
        $this->tgl_pinjam = $pinjams->tgl_pinjam;
        $this->tgl_kembali = $pinjams->tgl_kembali;
        $this->status = $pinjams->status;
    }
    public function update(){
        $pinjams = Pinjam::find($this->id);
        $pinjams->update([
            'buku_id' => $this->buku_id,
            'user_id' => $this->user_id,
            'tgl_pinjam' => $this->tgl_pinjam,
            'tgl_kembali' => $this->tgl_kembali,
            'status' => $this->status,
        ]); 
        session()->flash('success', 'Data berhasil diubah');
        return redirect()->route('pinjam');
    }
    public function confirm($id){
        $this->id = $id;
    }
    public function destroy(){
        $pinjam = Pinjam::find($this->id);
        $pinjam -> delete();
        session()-> flash('success', 'Data berhasil dihapus');
        return redirect()->route('pinjam');
    }
}
