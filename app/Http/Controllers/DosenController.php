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
        $page = "Dashboard Dosen";
        return view('layouts.dosen.dashboard', compact('page'));
    }

    public function kuisioner_index()
    {
        $page = "Hasil Kuisioner";
        $auth = Auth::user()->id;
        $dosenId = Dosen::where('user_id', $auth)->first();
        $data = Hasil::all()->where('dosen_id', $dosenId->id);
        return view('layouts.dosen.kuisioner.index', compact('page', 'data'));
    }
}
