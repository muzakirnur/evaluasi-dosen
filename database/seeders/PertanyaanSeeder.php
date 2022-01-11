<?php

namespace Database\Seeders;

use App\Models\Pertanyaan;
use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pertanyaan::create([
            'question' => 'Apakah Dosen menyampaikan materi sesuai mata kuliah di masa pandemi Covid-19?'
        ]);
        Pertanyaan::create([
            'question' => 'Apakah dosen masuk mengajar di masa pandemi ini secara online atau hanya memberikan materi saja lewat grub WA?'
        ]);
        Pertanyaan::create([
            'question' => 'Apakah Dosen masuk tepat waktu?'
        ]);
        Pertanyaan::create([
            'question' => 'Apakah dosen memberikan materi kuliah di masa pandemi ini sama dengan kuliah online?'
        ]);
        Pertanyaan::create([
            'question' => 'Apakah dosen memberikan methode pembelajaran bervariasi?'
        ]);
    }
}
