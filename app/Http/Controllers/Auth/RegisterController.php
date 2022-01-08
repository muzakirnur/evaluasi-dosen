<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

            $user = new User();
            $user->name = $data['name'];
            $user->nip = $data['nim'];
            $user->prodi_id = $data['prodi_id'];
            $user->role_id = $data['role_id'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            $userId = $user->id();
            dd($userId);
            // return User::create([
            //     'name' => $data['name'],
            //     'nip' => $data['nim'],
            //     'prodi_id' => $data['prodi_id'],
            //     'role_id' => $data['role_id'],
            //     'email' => $data['email'],
            //     'password' => Hash::make($data['password']),
            // ]);

            // Dosen::create([
            //     'name' => $data['name'],
            //     'nip' => $data['nim'],
            //     'prodi_id' => $data['prodi_id'],
            //     'user_id' => DB::getPdo()->insertedId(),
            // ]);
        }
        // $userId = $user->id();
        // return redirect()->route('login')->with('success', 'Registrasi Berhasil, Silahkan login');
    }
}
