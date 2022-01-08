<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\AuthRouteMethods;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required'],
            'prodi_id' => ['required'],
            'role_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if ($data['role_id'] == 2) {
            $user =  User::create([
                'name' => $data['name'],
                'nip' => $data['nim'],
                'prodi_id' => $data['prodi_id'],
                'role_id' => $data['role_id'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $userId = $user->id;
            Dosen::create([
                'name' => $data['name'],
                'nip' => $data['nim'],
                'prodi_id' => $data['prodi_id'],
                'user_id' => $userId,
            ]);

            return Auth::login($user);
        }
        return User::create([
            'name' => $data['name'],
            'nim' => $data['nim'],
            'prodi_id' => $data['prodi_id'],
            'role_id' => $data['role_id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $id = User::latest()->first()->id;
        dd($id);
        Mahasiswa::create([
            'name' => $data['name'],
            'nim' => $data['nim'],
            'prodi_id' => $data['prodi_id'],
            'user_id' => $id,
        ]);
        // $userId = $user->id();
        // return redirect()->route('login')->with('success', 'Registrasi Berhasil, Silahkan login');
    }
}
