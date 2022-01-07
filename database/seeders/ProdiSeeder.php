<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::create([
            'name' => 'Teknik Industri',
        ]);
        Prodi::create([
            'name' => 'Teknik Mesin',
        ]);
        Prodi::create([
            'name' => 'Teknik Arsitektur',
        ]);
        Prodi::create([
            'name' => 'Teknik Kimia',
        ]);
        Prodi::create([
            'name' => 'Teknik Elektro',
        ]);
        Prodi::create([
            'name' => 'Teknik Informatika',
        ]);
        Prodi::create([
            'name' => 'Teknik Material',
        ]);
        Prodi::create([
            'name' => 'Sistem Informasi',
        ]);
        Prodi::create([
            'name' => 'Teknik Logistik',
        ]);
        Prodi::create([
            'name' => 'Teknik Sipil',
        ]);
    }
}
