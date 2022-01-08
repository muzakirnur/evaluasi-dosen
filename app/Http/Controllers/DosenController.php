<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $page = "Dashboard Dosen";
        return view('layouts.dosen.dashboard', compact('page'));
    }
}
