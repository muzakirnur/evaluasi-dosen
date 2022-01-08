<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware(['admin'])->group(function () {
        Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin');
        // Routes Kelola Mahasiswa
        Route::get('admin/mahasiswa', [AdminController::class, 'mahasiswa_index'])->name('admin-mahasiswa.index');
        Route::post('admin/mahasiswa', [AdminController::class, 'mahasiswa_delete'])->name('admin-mahasiswa.destroy');
        // Routes Kelola Dosen
        Route::get('admin/dosen', [AdminController::class, 'dosen_index'])->name('admin-dosen.index');
        // Routes Kelola Pertanyaan
        Route::get('admin/pertanyaan', [AdminController::class, 'pertanyaan_index'])->name('admin-pertanyaan.index');
        Route::get('admin/pertanyaan/create', [AdminController::class, 'pertanyaan_create'])->name('admin-pertanyaan.create');
        Route::post('admin/pertanyaan/create', [AdminController::class, 'pertanyaan_save'])->name('admin-pertanyaan.save');
        // Routes Kelola Program Studi
        Route::get('admin/prodi', [AdminController::class, 'prodi_index'])->name('admin-prodi.index');
        Route::get('admin/prodi/create', [AdminController::class, 'prodi_create'])->name('admin-prodi.create');
        Route::post('admin/prodi/create', [AdminController::class, 'prodi_save'])->name('admin-prodi.save');
    });

    Route::middleware(['dosen'])->group(function () {
        Route::get('dosen/dashboard', [DosenController::class, 'index'])->name('dosen');
    });

    Route::middleware(['mahasiswa'])->group(function () {
        Route::get('mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa');
    });
});
