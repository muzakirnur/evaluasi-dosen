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
use App\Models\Matakuliah;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JeroenNoten\LaravelAdminLte\Components\Form\Select;
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
        $mk = Matakuliah::all()->where('dosen_id', $dosen->id);
        // $hasil = Hasil::find('matakuliah_id', $mk->id);
        // dd($mk);
        // $data = Hasil::where('matakuliah_id', $mk == $dosen->id)->paginate(10);
        // dd($sangatBaik);
        // return view('layouts.admin.dosen.show', compact('page', 'dosen', 'data', 'user', 'dataSb', 'dataB', 'dataC', 'dataKb', 'dataSkb'));
        return view('layouts.admin.dosen.show', compact('page', 'user', 'mk', 'dosen'));
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
    public function hasil_matakuliah()
    {
        $cid = request()->segment(4);
        $judul = Matakuliah::find($cid);
        $data = Hasil::where('matakuliah_id', $cid)->paginate(10);
        $page = "Hasil Evaluasi Matakuliah " . $judul->matakuliah;
        $chart = Hasil::all()->where('matakuliah_id', $cid);
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
        // dd($uri);
        return view('layouts.admin.hasil.matakuliah', compact('data', 'page', 'dataSb', 'dataB', 'dataC', 'dataKb', 'dataSkb'));
    }

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
        $dosen = request()->segment(4);
        $int = (int)$dosen;
        // dd($dosen);
        return (new HasilExport)->mkId($int)->download('hasil_matakuliah.xlsx');
    }

    public function exportall($id)
    {
        $dosen = request()->segment(4);
        $int = (int)$dosen;
        // dd($int);
        return (new HasilExport)->mkId($int)->download('hasil_matakuliah.xlsx');
    }

    public function exportPDFall()
    {
        $page = "Data Hasil Evaluasi";
        $data = Hasil::all();
        $pdf = PDF::loadView('layouts.pdf.hasil', compact('data', 'page'));
        // dd($pdf);
        return $pdf->download('hasil.pdf');
    }

    public function exportDosen()
    {
        $page = "Data Dosen";
        $data = Dosen::all();
        $pdf = PDF::loadView('layouts.pdf.dosen', compact('data', 'page'));
        // dd($pdf);
        return $pdf->download('dosen.pdf');
    }

    public function exportHasil($id)
    {
        $id = request()->segment(4);
        $page = "Data Hasil Evaluasi";
        $data = Hasil::all()->where('matakuliah_id', $id);
        $pdf = PDF::loadView('layouts.pdf.hasil', compact('data', 'page'));
        // dd($pdf);
        return $pdf->download('hasil.pdf');
    }

    public function exportMahasiswa()
    {
        $page = "Data Mahasiswa";
        $data = Mahasiswa::all();
        $pdf = PDF::loadView('layouts.pdf.mahasiswa', compact('data', 'page'));
        // dd($pdf);
        return $pdf->download('mahasiswa.pdf');
    }

    // Mengelola Matakuliah

    public function mk_index()
    {
        $page = "Kelola Matakuliah";
        $data = Matakuliah::paginate(10);
        // dd($data);
        return view('layouts.admin.matakuliah.index', compact('data', 'page'));
    }

    public function mk_create()
    {
        $page = "Tambah Matakuliah";
        $prodi = Prodi::all();
        $dosen = Dosen::all();
        return view('layouts.admin.matakuliah.create', compact('dosen', 'prodi', 'page'));
    }

    public function mk_save(Request $request)
    {
        // dd($request);
        Matakuliah::create([
            'matakuliah' => $request->matakuliah,
            'dosen_id' => $request->dosen,
            'prodi_id' => $request->prodi,
        ]);

        return redirect()->route('admin-matakuliah.index')->with('success', 'Data Matakuliah Berhasil ditambahkan');
    }

    public function mk_show($id)
    {
        $page = "Detail Matakuliah";
        $prodi = Prodi::all();
        $dosen = Dosen::all();
        $data = Matakuliah::find($id);
        return view('layouts.admin.matakuliah.show', compact('page', 'data', 'prodi', 'dosen'));
    }

    public function mk_update($id, Request $request)
    {
        Matakuliah::find($id)->update([
            'matakuliah' => $request->matakuliah,
            'prodi_id' => $request->prodi,
            'dosen_id' => $request->dosen,
        ]);
        return redirect()->route('admin-matakuliah.index')->with('success', 'Data Berhasil di Update');
    }

    public function mk_destroy($id)
    {
        Matakuliah::destroy($id);
        return redirect()->route('admin-matakuliah.index')->with('success', 'Data Berhasil di Hapus');
    }
}
