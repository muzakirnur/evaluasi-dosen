<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->register();
        Gate::define('admin', function ($user) {
            if ($user->role_id == '1') {
                return true;
            }
            return false;
        });
        Gate::define('dosen', function ($user) {
            if ($user->role_id == '2') {
                return true;
            }
            return false;
        });
        Gate::define('mahasiswa', function ($user) {
            if ($user->role_id == '3') {
                return true;
            }
            return false;
        });
        // Gate::define('dosen', function ($user) {
        //     if ($user->role_id == '2') {
        //         return true;
        //     }
        //     return false;
        // });
        // Gate::define('mahasiswa', function ($user) {
        //     if ($user->role_id == '3') {
        //         return true;
        //     }
        //     return false;
        // });
    }
}
