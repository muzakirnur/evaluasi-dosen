<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Mahasiswa;
use App\Models\Pertanyaan;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AdminController extends Controller
{
    public function index()
    {
        $page = "Dashboard Admin";
        return view('layouts.admin.dashboard', compact('page'));
    }

    // Fungsi Kelola Mahasiswa

    public function mahasiswa_index()
    {
        $page = "Kelola Mahasiswa";
        $data = Mahasiswa::all();
        return view('layouts.admin.mahasiswa.index', compact('page', 'data'));
    }

    public function mahasiswa_delete($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Data Mahasiswa Berhasil dihapus');
    }

    // Fungsi Kelola Dosen

    public function dosen_index()
    {
        $page = "Kelola Dosen";
        $data = User::all()->whereNotNull('nip');
        return view('layouts.admin.dosen.index', compact('page', 'data'));
    }

    // Fungsi Kelola Pertanyaan

    public function pertanyaan_index()
    {
        $page = "Kelola Pertanyaan";
        $data = Pertanyaan::all();
        return view('layouts.admin.pertanyaan.index', compact('page', 'data'));
    }

    public function pertanyaan_create()
    {
        $page = "Form Tambah Pertanyaan";
        return view('layouts.admin.pertanyaan.create', compact('page'));
    }

    public function pertanyaan_save(Request $request)
    {
        Pertanyaan::create([
            'question' => $request->pertanyaan,
        ]);
        return redirect()->route('admin-pertanyaan.index')->with('success', 'Pertanyaan Berhasil ditambahkan');
    }

    // Fungsi untuk Hasil Evaluasi

    public function hasil_index()
    {
        $page = "Hasil Evaluasi Dosen";
        $data = Hasil::all();
        return view('layouts.admin.hasil.index', compact('page', 'data'));
    }

    // Fungsi Kelola Prodi

    public function prodi_index()
    {
        $page = "Kelola Program Studi";
        $data = Prodi::all();
        return view('layouts.admin.prodi.index', compact('page', 'data'));
    }

    public function prodi_create()
    {
        $page = "Form Tambah Program Studi";
        return view('layouts.admin.prodi.create', compact('page'));
    }

    public function prodi_save(Request $request)
    {
        Prodi::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin-prodi.index')->with('success', 'Program Studi Berhasil ditambahkan');
    }
}
