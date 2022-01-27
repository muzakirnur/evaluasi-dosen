<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
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
    Route::get('profile', [ProfileController::class, 'profile_index'])->name('profile.index');
    Route::put('profile/update/{id}', [ProfileController::class, 'profile_update'])->name('profile.update');
    Route::get('chart', [AdminController::class, 'chart'])->name('chart.index');

    Route::middleware(['admin'])->group(function () {
        Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin');
        // Routes Kelola Mahasiswa
        Route::get('admin/mahasiswa', [AdminController::class, 'mahasiswa_index'])->name('admin-mahasiswa.index');
        Route::post('admin/mahasiswa', [AdminController::class, 'mahasiswa_delete'])->name('admin-mahasiswa.destroy');
        Route::get('admin/mahasiswa/{id}', [AdminController::class, 'mahasiswa_show'])->name('admin-mahasiswa.show');
        // Routes Kelola Dosen
        Route::get('admin/dosen', [AdminController::class, 'dosen_index'])->name('admin-dosen.index');
        Route::get('admin/dosen/{id}', [AdminController::class, 'dosen_show'])->name('admin-dosen.show');
        Route::get('admin/dosen/{id}/export', [AdminController::class, 'export'])->name('admin-dosen.export');
        // Route Kelola PDF

        Route::get('admin/pdf/dosen', [AdminController::class, 'exportDosen'])->name('export-pdf.dosen');
        Route::get('admin/pdf/hasil', [AdminController::class, 'exportHasil'])->name('export-pdf.hasil');
        Route::get('admin/pdf/mahasiswa', [AdminController::class, 'exportMahasiswa'])->name('export-pdf.mahasiswa');


        // Routes Kelola Pertanyaan
        Route::get('admin/pertanyaan', [AdminController::class, 'pertanyaan_index'])->name('admin-pertanyaan.index');
        Route::get('admin/pertanyaan/detail/{id}', [AdminController::class, 'pertanyaan_show'])->name('admin-pertanyaan.show');
        Route::put('admin/pertanyaan/detail/{id}/update', [AdminController::class, 'pertanyaan_update'])->name('admin-pertanyaan.update');
        Route::get('admin/pertanyaan/create', [AdminController::class, 'pertanyaan_create'])->name('admin-pertanyaan.create');
        Route::post('admin/pertanyaan/create', [AdminController::class, 'pertanyaan_save'])->name('admin-pertanyaan.save');
        Route::get('admin/pertanyaan/delete/{id}', [AdminController::class, 'pertanyaan_destroy'])->name('admin-pertanyaan.destroy');
        // Routes Kelola Program Studi
        Route::get('admin/prodi', [AdminController::class, 'prodi_index'])->name('admin-prodi.index');
        Route::get('admin/prodi/create', [AdminController::class, 'prodi_create'])->name('admin-prodi.create');
        Route::post('admin/prodi/create', [AdminController::class, 'prodi_save'])->name('admin-prodi.save');
        Route::get('admin/prodi/{id}', [AdminController::class, 'prodi_show'])->name('admin-prodi.show');
        Route::get('admin/prodi/delete/{id}', [AdminController::class, 'prodi_destroy'])->name('admin-prodi.destroy');
        // Route Kelola Hasil Evaluasi
        Route::get('admin/hasil', [AdminController::class, 'hasil_index'])->name('admin-hasil.index');
        Route::get('admin/hasil/export', [AdminController::class, 'exportall'])->name('admin-hasil.download');
        Route::get('admin/hasil/{id}', [AdminController::class, 'hasil_show'])->name('admin-hasil.show');
        Route::get('admin/hasil/delete/{id}', [AdminController::class, 'hasil_destroy'])->name('admin-hasil.destroy');
    });

    Route::middleware(['dosen'])->group(function () {
        Route::get('dosen/dashboard', [DosenController::class, 'index'])->name('dosen');
        Route::get('dosen/kuisioner/export', [DosenController::class, 'export'])->name('dosen.export');
        // Routes Kelola Hasil Kuisioner
        Route::get('dosen/kuisioner', [DosenController::class, 'kuisioner_index'])->name('dosen-kuisioner.index');
    });

    Route::middleware(['mahasiswa'])->group(function () {
        Route::get('mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa');
        // Route Kuisioner
        Route::get('mahasiswa/kuisioner', [MahasiswaController::class, 'kuisioner_index'])->name('mahasiswa-kuisioner.index');
        Route::get('mahasiswa/kuisioner/tambah', [MahasiswaController::class, 'kuisioner_create'])->name('mahasiswa-kuisioner.create');
        Route::post('mahasiswa/kuisioner/tambah', [MahasiswaController::class, 'kuisioner_save'])->name('mahasiswa-kuisioner.save');
    });
});
