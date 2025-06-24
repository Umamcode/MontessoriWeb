<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginComponent extends Component
{
    public $email, $password;
    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.login');
    }
    public function proses()
    {
        $this->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => "Email tidak boleh kosong!",
        'email.email' => "Format email tidak valid!",
        'password.required' => "Password tidak boleh kosong!"
    ]);

    // Cek apakah email terdaftar
    $user = \App\Models\User::where('email', $this->email)->first();

    if (!$user) {
        // Email tidak ditemukan
        session()->flash('error', 'Email tidak terdaftar.');
        return;
    }

    // Email ditemukan, coba login
    if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
        // Password salah
        session()->flash('error', 'Password salah.');
        return;
    }

    // Berhasil login
    session()->regenerate();
    session()->flash('success', 'Selamat, Anda berhasil login.');
    return redirect()->route('home');

}
    public function keluar(){
         Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        session()->flush(); 
        return redirect()->route('login');
    }
}
