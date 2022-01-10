<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
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
        $mahasiswa = Mahasiswa::count();
        $pertanyaan = Pertanyaan::count();
        $hasil = Hasil::count();
        $dosen = Dosen::count();
        return view('layouts.admin.dashboard', compact('page', 'pertanyaan', 'mahasiswa', 'hasil', 'dosen'));
    }

    // Fungsi Kelola Mahasiswa

    public function mahasiswa_index()
    {
        $page = "Kelola Mahasiswa";
        $data = Mahasiswa::paginate(10);
        return view('layouts.admin.mahasiswa.index', compact('page', 'data'));
    }

    public function mahasiswa_delete($id)
    {
        Mahasiswa::destroy($id);
        return redirect()->back()->with('success', 'Data Mahasiswa Berhasil dihapus');
    }

    public function mahasiswa_show($id)
    {
        $page = "Detail Mahasiswa";
        $mhs = Mahasiswa::find($id);
        $user = User::where('id', $mhs->user_id)->first();
        $data = Hasil::where('mahasiswa_id', $mhs->id)->paginate(10);
        return view('layouts.admin.mahasiswa.show', compact('mhs', 'user', 'data', 'page'));
    }

    // Fungsi Kelola Dosen

    public function dosen_index()
    {
        $page = "Kelola Dosen";
        $data = Dosen::paginate(10);
        return view('layouts.admin.dosen.index', compact('page', 'data'));
    }

    public function dosen_show($id)
    {
        $page = "Detail Dosen";
        $dosen = Dosen::find($id);
        $user = User::where('id', $dosen->user_id)->first();
        $data = Hasil::where('dosen_id', $dosen->id)->paginate(10);
        return view('layouts.admin.dosen.show', compact('page', 'dosen', 'data', 'user'));
    }

    // Fungsi Kelola Pertanyaan

    public function pertanyaan_index()
    {
        $page = "Kelola Pertanyaan";
        $data = Pertanyaan::paginate(10);
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

    public function pertanyaan_destroy($id)
    {
        Pertanyaan::destroy($id);
        return redirect()->back()->with('successs', 'Pertanyaan Berhasil dihapus');
    }

    // Fungsi untuk Hasil Evaluasi

    public function hasil_index()
    {
        $page = "Hasil Evaluasi Dosen";
        $data = Hasil::paginate(10);
        return view('layouts.admin.hasil.index', compact('page', 'data'));
    }

    public function hasil_destroy($id)
    {
        Hasil::destroy($id);
        return redirect()->route('admin-hasil.index')->with('success', 'Data Berhasil dihapus');
    }

    // Fungsi Kelola Prodi

    public function prodi_index()
    {
        $page = "Kelola Program Studi";
        $data = Prodi::paginate(10);
        return view('layouts.admin.prodi.index', compact('page', 'data'));
    }

    public function prodi_show($id)
    {
        $prodi = Prodi::find($id);
        $data = Dosen::where('prodi_id', $prodi->id)->paginate(10);
        $page = "Daftar Dosen " . $prodi->name;
        return view('layouts.admin.prodi.show', compact('page', 'prodi', 'data'));
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

    public function chart($id)
    {
        $dosen = Dosen::find($id);
        $chart = Hasil::all()->where('dosen_id', $dosen->id);

        return response()->json($chart);
    }
}
