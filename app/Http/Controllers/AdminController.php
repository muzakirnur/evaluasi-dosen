<?php

namespace App\Http\Controllers;

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
}
