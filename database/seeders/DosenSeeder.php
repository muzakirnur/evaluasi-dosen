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
            'name' => 'Ananda Faridhatul Ulva',
            'nip' => '12804581289',
            'prodi_id' => '8',
            'user_id' => '2',
        ]);
    }
}
