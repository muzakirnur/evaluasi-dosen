<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function index()
    {
        $dosenId = Dosen::where('user_id', Auth::user()->id)->first();

        $hasil = Hasil::all()->where('dosen_id', $dosenId->id);
        $page = "Dashboard Dosen";
        return view('layouts.dosen.dashboard', compact('page', 'hasil'));
    }

    public function kuisioner_index()
    {
        $page = "Hasil Kuisioner";
        $auth = Auth::user()->id;
        $dosenId = Dosen::where('user_id', $auth)->first();
        // Menampilkan Chart
        $chart = Hasil::all()->where('dosen_id', $dosenId->id);
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
        // Menampilkan Data Hasil Evaluasi
        $data = Hasil::where('dosen_id', $dosenId->id)->paginate(5);
        return view('layouts.dosen.kuisioner.index', compact('page', 'data', 'dataSb', 'dataB', 'dataC', 'dataKb', 'dataSkb'));
    }
}
