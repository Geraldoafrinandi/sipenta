<?php

use App\Models\Sidang;
use App\Models\Kaprodi;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Tugas_akhirController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});



Route::get('/backend', function () {
    return view('admin.main');
})->middleware(('auth'));


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/admin-mahasiswa', [MahasiswaController::class, 'index'])->middleware('auth');
Route::get('/admin-mahasiswa/create', [MahasiswaController::class, 'create'])->name('admin.mahasiswa.create');
Route::post('/admin-mahasiswa', [MahasiswaController::class, 'store'])->name('admin.mahasiswa.store');
Route::get('/admin/mahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
Route::delete('/admin-mahasiswa/{id_mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');



Route::get('/admin-dosen', [DosenController::class, 'index'])->middleware('auth');
Route::get('/admin-dosen/create', [DosenController::class, 'create'])->name('admin.dosen.create');
Route::post('/admin-dosen', [DosenController::class, 'store'])->name('admin.dosen.store');
Route::get('/admin/dosen', [DosenController::class, 'index'])->name('admin.dosen.index');



Route::get('/admin-prodi',[ProdiController::class,'index'])->middleware('auth');
Route::get('/admin-prodi/create', [ProdiController::class, 'create'])->name('admin.prodi.create');
Route::post('/admin-prodi', [ProdiController::class, 'store'])->name('admin.prodi.store');
Route::get('/admin/prodi', [ProdiController::class, 'index'])->name('admin.prodi.index');
Route::delete('/admin-prodi/{id_prodi}', [ProdiController::class, 'destroy'])->name('prodi.destroy');


Route::get('/admin-kaprodi',[KaprodiController::class,'index'])->middleware('auth');


Route::get('/admin-sidang',[SidangController::class,'index'])->middleware('auth');


Route::get('/admin-ruangan',[RuanganController::class,'index'])->middleware('auth');


Route::get('/admin-tugas_akhir',[Tugas_akhirController::class,'index'])->middleware('auth');


