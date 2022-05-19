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
        $hasil = Hasil::all()->where('matakuliah_id', $matakuliah->dosen_id);
        // dd($hasil);
        $page = "Dashboard Dosen";
        return view('layouts.dosen.dashboard', compact('page', 'hasil', 'matakuliah'));
    }

    public function kuisioner_index()
    {
        $page = "Hasil Kuisioner";
        $auth = Auth::user()->id;
        $dosenId = Dosen::where('user_id', $auth)->first();
        // Menampilkan Chart
        $chart = Hasil::all()->where('dosen_id', $dosenId->id);

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
        // Menampilkan Data Hasil Evaluasi
        $data = Hasil::where('dosen_id', $dosenId->id)->paginate(10);
        return view('layouts.dosen.kuisioner.index', compact('page', 'data', 'dataSb', 'dataB', 'dataC', 'dataKb', 'dataSkb'));
    }

    public function export()
    {
        $dosen = Dosen::where('user_id', Auth::user()->id)->get();
        return (new HasilExport)->dosenId($dosen[0]->id)->download('hasil_evaluasi.xlsx');
    }
}
