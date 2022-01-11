<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Image;

class ProfileController extends Controller
{
    public function profile_index()
    {
        $data = Auth::user();
        $page = "Profile";
        $prodi = Prodi::all();
        return view('layouts.profile', compact('page', 'data', 'prodi'));
    }

    public function profile_update($id, Request $request)
    {
        if ($request->hasFile('avatar')) {
            $validated = $request->validate([
                'avatar' => 'image',
            ]);
            $nm = $validated['avatar'];
            $name = $nm->getClientOriginalName();
            $nm->move(public_path() . '/img/profile', $name);
            User::find($id)->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'nim' => $request->nim,
                'prodi_id' => $request->prodi_id,
                'avatar' => $name,
            ]);
        } else {
            User::find($id)->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'nim' => $request->nim,
                'prodi_id' => $request->prodi_id,
            ]);
        }
        return redirect()->back()->with('success', 'Profile berhasil di update');
    }
}
