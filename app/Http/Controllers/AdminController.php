<?php

namespace App\Http\Controllers;

use App\Exports\EvaluasiExport;
use App\Models\Dosen;
use App\Models\Hasil;
use App\Models\Mahasiswa;
use App\Models\Pertanyaan;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\HasilExport;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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
        $chart = Hasil::all()->where('dosen_id', $dosen->id);
        foreach ($chart as $n) {
            $jlhNilai = $n->nilai;
        }
        $sangatBaik = $jlhNilai == 10;
        $baik = $jlhNilai <= 9.9;
        $cukup = $jlhNilai <= 8.9;
        $kurangBaik = $jlhNilai <= 7.9;
        $sangatKurangBaik = $jlhNilai <= 6.9;

        $dataSb = $chart->where('nilai', 10)->count();
        $dataB = $chart->whereBetween('nilai', [9, 9.9])->count();
        $dataC = $chart->whereBetween('nilai', [8, 8.9])->count();
        $dataKb = $chart->whereBetween('nilai', [7, 7.9])->count();
        $dataSkb = $chart->whereBetween('nilai', [6, 6.9])->count();
        // dd($sangatBaik);
        return view('layouts.admin.dosen.show', compact('page', 'dosen', 'data', 'user', 'dataSb', 'dataB', 'dataC', 'dataKb', 'dataSkb'));
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

    public function pertanyaan_show($id)
    {
        $page = "Perbarui Pertanyaan";
        $data = Pertanyaan::find($id);
        return view('layouts.admin.pertanyaan.show', compact('data', 'page'));
    }

    public function pertanyaan_update($id, Request $request)
    {
        Pertanyaan::find($id)->update($request->all());
        return redirect()->route('admin-pertanyaan.index')->with('success', 'Pertanyaan Berhasil di Update');
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

    public function hasil_show($id)
    {
        $page = "Detail Hasil Evaluasi";
        $data = Hasil::find($id);
        return view('layouts.admin.hasil.show', compact('page', 'data'));
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

    public function prodi_destroy($id)
    {
        Prodi::destroy($id);
        return redirect()->route('admin-prodi.index')->with('success', 'Program Studi Berhasil dihapus');
    }

    public function export($id)
    {
        $dosen = Dosen::find($id);
        return (new HasilExport)->dosenId($dosen->id)->download('hasil_dosen.xlsx');
    }

    public function exportall()
    {
        return Excel::download(new EvaluasiExport, 'evaluasi.xlsx');
    }

    public function exportPdf()
    {
        $page = "Data Dosen";
        $data = Dosen::all();
        $pdf = PDF::loadView('layouts.pdf.index', compact('data', 'page'));
        // dd($pdf);
        return $pdf->download('dosen.pdf');
    }
}
