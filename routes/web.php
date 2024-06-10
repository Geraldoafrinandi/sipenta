<?php

use App\Models\User;
use App\Models\Sidang;
use App\Models\Kaprodi;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\ProfileController;
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

Route::get('/admin/change_password', [UserController::class, 'showChangePasswordForm'])->name('admin.change_password');
Route::post('/admin/change_password', [UserController::class, 'changePassword'])->name('admin.change.password');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/admin-mahasiswa', [MahasiswaController::class, 'index'])->middleware('auth');
Route::get('/admin-mahasiswa/create', [MahasiswaController::class, 'create'])->name('admin.mahasiswa.create');
Route::post('/admin-mahasiswa', [MahasiswaController::class, 'store'])->name('admin.mahasiswa.store');
Route::get('/admin/mahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
Route::delete('/admin-mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
Route::get('/admin-mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');
Route::put('/admin-mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');
Route::get('/admin-mahasiswa/export/excel', [MahasiswaController::class, 'export_excel'])->name('mahasiswa.export.excel');
Route::get('admin-mahasiswa/import', [MahasiswaController::class, 'showImportForm'])->name('mahasiswa.import');
Route::post('admin-mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import.post');



Route::get('/admin-dosen', [DosenController::class, 'index'])->middleware('auth');
Route::get('/admin-dosen/create', [DosenController::class, 'create'])->name('admin.dosen.create');
Route::post('/admin-dosen', [DosenController::class, 'store'])->name('admin.dosen.store');
Route::get('/admin/dosen', [DosenController::class, 'index'])->name('admin.dosen.index');
Route::delete('/admin-dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
Route::get('/dosen/{dosen_id}/prodi', [DosenController::class, 'getNamaProdi']);
Route::get('/admin-dosen/{id}/edit', [DosenController::class, 'edit'])->name('admin.dosen.edit'); // Rute untuk menampilkan form edit dosen
Route::put('/admin-dosen/{id}', [DosenController::class, 'update'])->name('admin.dosen.update');// Rute untuk menyimpan perubahan data dosen
Route::get('/admin-dosen/export/excel', [DosenController::class, 'export_excel'])->name('dosen.export.excel');
Route::get('admin-dosen/import', [DosenController::class, 'showImportForm'])->name('dosen.import');
Route::post('admin-dosen/import', [DosenController::class, 'import'])->name('dosen.import.post');



Route::get('/admin-prodi',[ProdiController::class,'index'])->middleware('auth');
Route::get('/admin-prodi/create', [ProdiController::class, 'create'])->name('admin.prodi.create');
Route::post('/admin-prodi', [ProdiController::class, 'store'])->name('admin.prodi.store');
Route::get('/admin/prodi', [ProdiController::class, 'index'])->name('admin.prodi.index');
Route::delete('/admin-prodi/{id_prodi}', [ProdiController::class, 'destroy'])->name('prodi.destroy');


Route::get('/admin-kaprodi',[KaprodiController::class,'index'])->middleware('auth');


// Route untuk Sidang dengan middleware auth
Route::get('/admin-sidang', [SidangController::class, 'index'])->middleware('auth')->name('admin.sidang.index');
Route::get('/admin-sidang/create', [SidangController::class, 'create'])->middleware('auth')->name('admin.sidang.create');
Route::post('/admin-sidang', [SidangController::class, 'store'])->middleware('auth')->name('admin.sidang.store');
Route::get('/admin-sidang/{id}', [SidangController::class, 'show'])->middleware('auth')->name('admin.sidang.show');
Route::get('/admin-sidang/{id}/edit', [SidangController::class, 'edit'])->middleware('auth')->name('admin.sidang.edit');
Route::put('/admin-sidang/{id}', [SidangController::class, 'update'])->middleware('auth')->name('admin.sidang.update');
Route::delete('/admin-sidang/{id}', [SidangController::class, 'destroy'])->middleware('auth')->name('admin.sidang.destroy');


Route::get('/admin-ruangan',[RuanganController::class,'index'])->middleware('auth');
Route::get('/admin-ruangan', [RuanganController::class, 'index'])->name('admin.ruangan.index');
Route::get('/admin-ruangan/create', [RuanganController::class, 'create'])->name('admin.ruangan.create');
Route::post('/admin-ruangan', [RuanganController::class, 'store'])->name('admin.ruangan.store');
Route::delete('/admin-ruangan/{id}', [RuanganController::class, 'destroy'])->name('admin.ruangan.destroy');



Route::get('/admin-tugas_akhir',[Tugas_akhirController::class,'index'])->middleware('auth');
Route::get('/tugas_akhir', [Tugas_akhirController::class, 'index'])->name('tugas_akhir.index');
Route::get('/tugas_akhir/create', [Tugas_akhirController::class, 'create'])->name('tugas_akhir.create');
Route::post('/tugas_akhir', [Tugas_akhirController::class, 'store'])->name('tugas_akhir.store');
Route::get('/tugas_akhir/{id}/edit', [Tugas_akhirController::class, 'edit'])->name('tugas_akhir.edit');
Route::put('/tugas_akhir/{id}', [Tugas_akhirController::class, 'update'])->name('tugas_akhir.update');
Route::delete('/tugas_akhir/{id}', [Tugas_akhirController::class, 'destroy'])->name('tugas_akhir.destroy');

Route::get('/admin/assign-role', [RoleController::class, 'showAssignRoleForm'])->name('assign.role');
Route::post('/admin/assign-role', [RoleController::class, 'assignRole']);



