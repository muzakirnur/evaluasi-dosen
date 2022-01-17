<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Hasil;
use App\Models\Mahasiswa;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
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
        $prodiUser = Auth::user()->prodi_id;
        $dosen = Dosen::where('prodi_id', $prodiUser)->get();
        $question = Pertanyaan::all();
        return view('layouts.mahasiswa.kuisioner.create', compact('dosen', 'question', 'page'));
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


        Hasil::create([
            'mahasiswa_id' => $idmhs->id,
            'dosen_id' => $request->dosen_id,
            'nilai' => $nilai,
            'saran' => $request->saran
        ]);

        return redirect()->route('mahasiswa-kuisioner.index')->with('success', 'Data Penilaian Berhasil ditambahkan');
    }
}
