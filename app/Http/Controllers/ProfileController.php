<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile_index()
    {
        $data = Auth::user();
        $page = "Profile " . $data->name;
        return view('layouts.profile', compact('page', 'data'));
    }
}
