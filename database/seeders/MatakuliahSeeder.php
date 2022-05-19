<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Seeder;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Matakuliah::create([
            'matakuliah' => 'Pemrograman Mobile 1',
            'prodi_id' => '8',
            'dosen_id' => '1',
        ]);
        Matakuliah::create([
            'matakuliah' => 'Pemrograman Mobile 1',
            'prodi_id' => '7',
            'dosen_id' => '1',
        ]);
        Matakuliah::create([
            'matakuliah' => 'Pemrograman web',
            'prodi_id' => '8',
            'dosen_id' => '1',
        ]);
    }
}
