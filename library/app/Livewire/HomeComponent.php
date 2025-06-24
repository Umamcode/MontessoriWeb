<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\Pengembalian;

class HomeComponent extends Component
{
    public $member;
    public $buku;
    public $pinjam;
    public $pengembalian;
    public $nama;
    public function mount()
    {
        $this->member = User::where('jenis', 'member')->count();
        $this->buku = Buku::count();
        $this->pinjam = Pinjam::where('status', 'Dipinjam')->count();
        $this->pengembalian = Pengembalian::count();
    }
    protected $listeners = ['refresh' => '$refresh'];
    public function render()
    {
        $x["title"] = "home library";
        return view('livewire.home-component')-> layoutData($x);
        // return view('livewire.home-component')->layout('layouts.app');
    }
}
