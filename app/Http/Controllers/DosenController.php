<?php

namespace App\Http\Controllers;

use App\Exports\HasilExport;
use App\Models\Dosen;
use App\Models\Hasil;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isEmpty;

class DosenController extends Controller
{
    public function index()
    {
        $dosenId = Dosen::where('user_id', Auth::user()->id)->first();
        $matakuliah = Matakuliah::all()->where('dosen_id', $dosenId->id);
        // dd($matakuliah[0]['id']);
        $page = "Dashboard Dosen";
        return view('layouts.dosen.dashboard', compact('page', 'matakuliah'));
    }

    public function kuisioner_index()
    {
        $page = "Matakuliah Yang Diampu";
        $auth = Auth::user()->id;
        $dosenId = Dosen::where('user_id', $auth)->first();
        $data = Matakuliah::where('dosen_id', $dosenId->id)->paginate(10);
        // dd($data);

        // Menampilkan Data Hasil Evaluasi
        // $data = Hasil::where('dosen_id', $dosenId->id)->paginate(10);
        return view('layouts.dosen.kuisioner.index', compact('page', 'data'));
    }

    public function hasil_matakuliah()
    {
        $cid = request()->segment(4);
        $judul = Matakuliah::find($cid);
        $data = Hasil::where('matakuliah_id', $cid)->paginate(10);
        $page = "Hasil Evaluasi Matakuliah " . $judul->matakuliah;
        // dd($data);
        // Menampilkan Chart
        $chart = Hasil::all()->where('matakuliah_id', $cid);
        // dd($chart);
        if (isEmpty($chart)) {
            $jlhNilai = 0;
        } else {
            foreach ($chart as $n) {
                $jlhNilai = $n->nilai;
            }
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
        // dd($dataSkb);
        return view('layouts.admin.hasil.matakuliah', compact('data', 'page', 'dataSb', 'dataB', 'dataC', 'dataKb', 'dataSkb'));
    }

    public function export()
    {
        $dosen = Dosen::where('user_id', Auth::user()->id)->get();
        return (new HasilExport)->dosenId($dosen[0]->id)->download('hasil_evaluasi.xlsx');
    }
}
