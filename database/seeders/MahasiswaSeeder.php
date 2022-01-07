<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mahasiswa::create([
            'name' => 'Muzakir Nur',
            'nim' => '180180101',
            'prodi_id' => '8',
            'user_id' => '3'
        ]);
    }
}
