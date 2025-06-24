<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'admin',
            'alamat' => 'Jl. Lenteng Agung',
            'telepon' => '081367185045',
            'email' => 'firstakundakwah@gmail.com',
            'password' =>Hash::make('admin123'),
            'jenis' => 'admin'
        ]);
    }
}
