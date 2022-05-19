<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Gita Perdinanta Ginting',
            'email' => 'gita@gmail.com',
            'nim' => '180180074',
            'role_id' => '1',
            'prodi_id' => '8',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Ananda Faridhatul Ulva',
            'email' => 'ananda@gmail.com',
            'nip' => '12804581289',
            'role_id' => '2',
            'prodi_id' => '8',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Muzakir Nur',
            'email' => 'muzakir@gmail.com',
            'nip' => '12804581289',
            'role_id' => '3',
            'prodi_id' => '8',
            'password' => bcrypt('password'),
        ]);
    }
}
