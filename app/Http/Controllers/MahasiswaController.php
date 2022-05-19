<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Hasil;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::Where('user_id', Auth::user()->id)->first();
        $data = Hasil::all()->where('mahasiswa_id', $mahasiswa->id);
        $page = "Dashboard Mahasiswa";
        return view('layouts.mahasiswa.dashboard', compact('page', 'data'));
    }

    public function kuisioner_index()
    {
        $page = "Hasil Penilaian Anda";
        $user = Auth::user()->id;
        $mahasiswa = Mahasiswa::Where('user_id', $user)->first();
        $data = Hasil::all()->where('mahasiswa_id', $mahasiswa->id);
        return view('layouts.mahasiswa.kuisioner.index', compact('mahasiswa', 'data', 'page'));
    }

    public function kuisioner_create()
    {
        $page = "Tambah Penilaian";
        $user = Auth::user()->id;
        $mahasiswa = Mahasiswa::where('user_id', $user)->first();
        $hasil = Hasil::all()->where('mahasiswa_id', $mahasiswa->id);
        $count = $hasil->count();
        // dd($hasil->toArray());
        if ($hasil->isEmpty()) {
            $prodiUser = Auth::user()->prodi_id;
            $matakuliah = Matakuliah::all()->where('prodi_id', $prodiUser);
        } else {
            foreach ($hasil as $h) {
                $mkid = $h->matakuliah_id;
            }
            $prodiUser = Auth::user()->prodi_id;
            $matakuliah = Matakuliah::all()->where('prodi_id', $prodiUser)->where('id', '!=', $mkid);
        }

        $question = Pertanyaan::all();
        return view('layouts.mahasiswa.kuisioner.create', compact('matakuliah', 'question', 'page'));
    }

    public function kuisioner_save(Request $request)
    {


        $data = $request->data;

        $total = array_sum($data);
        $jumlah = count($data);

        $n = ($total / $jumlah);
        $nilai = floatval($n);

        $idusr = Auth::user()->id;
        $idmhs = Mahasiswa::where('user_id', $idusr)->first('id');
        // dd($idmhs);

        if ($nilai <= 6.9) {
            $grade = "Sangat Kurang Baik";
        } else if ($nilai <= 7.9) {
            $grade = "Kurang Baik";
        } else if ($nilai <= 8.9) {
            $grade = "Cukup";
        } else if ($nilai <= 9.9) {
            $grade = "Baik";
        } else if ($nilai == 10) {
            $grade = "Sangat Baik";
        }

        Hasil::create([
            'mahasiswa_id' => $idmhs->id,
            'matakuliah_id' => $request->matakuliah,
            'nilai' => $nilai,
            'saran' => $request->saran,
            'grade' => $grade
        ]);

        return redirect()->route('mahasiswa-kuisioner.index')->with('success', 'Data Penilaian Berhasil ditambahkan');
    }
}
