<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::create([
            'name' => 'Desvina Yulisda',
            'nip' => '124714014012712',
            'prodi_id' => '8',
            'user_id' => '2'
        ]);
    }
}
