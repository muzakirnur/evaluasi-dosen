<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $page = "Dashboard Mahasiswa";
        return view('layouts.mahasiswa.dashboard', compact('page'));
    }
}
