<?php

use App\Models\User;
use App\Models\Sidang;
use App\Models\Kaprodi;
use Faker\Guesser\Name;
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
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeDosenController;
use App\Http\Controllers\HomeMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\ValidasiTaController;
use App\Http\Controllers\Tugas_akhirController;
use App\Http\Controllers\ValidasiProposalController;

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
})->middleware('auth');

// Public Routes

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin',])->group(function () {

    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin-user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/change_password', [UserController::class, 'showChangePasswordForm'])->name('admin.change_password');
    Route::post('/admin/change_password', [UserController::class, 'changePassword'])->name('admin.change.password');
    Route::get('admin/user/{id}', [UserController::class, 'show'])->name('admin.user.show');
    Route::get('admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('admin-user/import', [UserController::class, 'showImportForm'])->name('admin.user.import');
    Route::post('admin-user/import', [UserController::class, 'import'])->name('admin.user.import.post');

    Route::get('/admin-mahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
    Route::get('/admin-mahasiswa/create', [MahasiswaController::class, 'create'])->name('admin.mahasiswa.create');
    Route::post('/admin-mahasiswa', [MahasiswaController::class, 'store'])->name('admin.mahasiswa.store');
    Route::delete('/admin-mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('admin.mahasiswa.destroy');
    Route::get('/admin-mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');
    Route::put('/admin-mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');
    Route::get('/admin-mahasiswa/export/excel', [MahasiswaController::class, 'export_excel'])->name('mahasiswa.export.excel');
    Route::get('admin-mahasiswa/import', [MahasiswaController::class, 'showImportForm'])->name('mahasiswa.import');
    Route::post('admin-mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import.post');
    Route::get('/admin-dashboard/mahasiswa', [HomeMahasiswaController::class, 'index'])->name('mahasiswa.home');

    Route::get('/admin-dosen', [DosenController::class, 'index'])->name('admin.dosen.index');
    Route::get('/admin-dosen/create', [DosenController::class, 'create'])->name('admin.dosen.create');
    Route::post('/admin-dosen', [DosenController::class, 'store'])->name('admin.dosen.store');
    Route::delete('/admin-dosen/{id}', [DosenController::class, 'destroy'])->name('admin.dosen.destroy');
    Route::get('/dosen/{dosen_id}/prodi', [DosenController::class, 'getNamaProdi']);
    Route::get('/admin-dosen/{id}/edit', [DosenController::class, 'edit'])->name('admin.dosen.edit');
    Route::put('/admin-dosen/{id}', [DosenController::class, 'update'])->name('admin.dosen.update');
    Route::get('/admin-dosen/export/excel', [DosenController::class, 'export_excel'])->name('dosen.export.excel');
    Route::get('/admin-dosen/import', [DosenController::class, 'showImportForm'])->name('dosen.import');
    Route::post('/admin-dosen/import', [DosenController::class, 'import'])->name('dosen.import.post');
    Route::get('/dosen-jadwal', [DosenController::class, 'dosenDenganJadwalSidang'])->name('dosen.jadwal-sidang');
    Route::get('/admin-dashboard/dosen', [HomeDosenController::class, 'index'])->name('dosen.home');

    Route::get('/admin-prodi', [ProdiController::class, 'index'])->name('admin.prodi.index');
    Route::get('/admin-prodi/create', [ProdiController::class, 'create'])->name('admin.prodi.create');
    Route::post('/admin-prodi', [ProdiController::class, 'store'])->name('admin.prodi.store');
    Route::delete('/admin-prodi/{id_prodi}', [ProdiController::class, 'destroy'])->name('prodi.destroy');

    Route::get('/admin-kaprodi', [KaprodiController::class, 'index']);

    Route::get('/admin-sidang', [SidangController::class, 'index'])->name('admin.sidang.index');
    Route::get('/admin-sidang/create', [SidangController::class, 'create'])->name('admin.sidang.create');
    Route::post('/admin-sidang', [SidangController::class, 'store'])->name('admin.sidang.store');
    Route::get('/admin-sidang/{id}', [SidangController::class, 'show'])->name('admin.sidang.show');
    Route::get('/admin-sidang/{sidang}/edit', [SidangController::class, 'edit'])->name('admin.sidang.edit');
    Route::put('/admin-sidang/{sidang}', [SidangController::class, 'update'])->name('admin.sidang.update');
    Route::delete('/admin-sidang/{id_sidang}', [SidangController::class, 'destroy'])->name('admin.sidang.destroy');
    Route::get('/admin/dosen-terjadwal', [SidangController::class, 'dosenTerjadwal'])->name('admin.dosen-terjadwal');
    Route::get('/getPembimbingByTA/{taId}', [SidangController::class, 'getPembimbingByTA']);
    Route::get('/getScheduledProfessors', [SidangController::class, 'getScheduledProfessors'])->name('scheduled.professors');
    Route::get('/get-tugas-akhir/{nim}', [SidangController::class, 'getTugasAkhir']);
    Route::get('/admin-sidang/{sidang}/print', [SidangController::class, 'print'])->name('admin.sidang.print');
    Route::post('/admin/sidang/set-ketua-sidang', 'SidangController@setKetuaSidang')->name('admin.sidang.set-ketua-sidang');
    Route::get('/admin/sidang/{id}/rekap', [SidangController::class, 'rekap'])->name('admin.sidang.rekap');

    Route::get('/admin-ruangan', [RuanganController::class, 'index'])->name('admin.ruangan.index');
    Route::get('/admin-ruangan/create', [RuanganController::class, 'create'])->name('admin.ruangan.create');
    Route::post('/admin-ruangan', [RuanganController::class, 'store'])->name('admin.ruangan.store');
    Route::delete('/admin-ruangan/{id}', [RuanganController::class, 'destroy'])->name('admin.ruangan.destroy');
    Route::get('/admin/ruangan/available', [RuanganController::class, 'availableRooms'])->name('admin.ruangan.available');

    Route::get('/admin-tugas_akhir', [Tugas_akhirController::class, 'index'])->name('admin.tugas_akhir.index');
    Route::get('/tugas_akhir', [Tugas_akhirController::class, 'index'])->name('tugas_akhir.index');
    Route::get('/tugas_akhir/create', [Tugas_akhirController::class, 'create'])->name('tugas_akhir.create');
    Route::post('/tugas_akhir', [Tugas_akhirController::class, 'store'])->name('tugas_akhir.store');
    Route::get('/tugas_akhir/{id}/edit', [Tugas_akhirController::class, 'edit'])->name('tugas_akhir.edit');
    Route::put('/tugas_akhir/{id}', [Tugas_akhirController::class, 'update'])->name('tugas_akhir.update');
    Route::delete('/tugas_akhir/{id}', [Tugas_akhirController::class, 'destroy'])->name('tugas_akhir.destroy');
    Route::get('tugas_akhir/download-dokumen-pkl/{id_ta}', [Tugas_akhirController::class, 'downloadDokumenPKL'])->name('tugas_akhir.downloadDokumenPKL');
    Route::get('tugas_akhir/download-lembar-bimbingan/{id_ta}', [Tugas_akhirController::class, 'downloadLembarBimbingan'])->name('tugas_akhir.downloadLembarBimbingan');
    Route::get('tugas_akhir/download-proposal/{id_ta}', [Tugas_akhirController::class, 'downloadProposal'])->name('tugas_akhir.downloadProposal');
    Route::get('tugas_akhir/download-laporan-ta/{id_ta}', [Tugas_akhirController::class, 'downloadLaporanTA'])->name('tugas_akhir.downloadLaporanTA');


    Route::get('/admin-penilaian', [PenilaianController::class, 'index'])->name('admin.penilaian.index');
    Route::get('/admin-penilaian/create', [PenilaianController::class, 'create'])->name('admin.penilaian.create');
    Route::post('/admin-penilaian', [PenilaianController::class, 'store'])->name('admin.penilaian.store');
    Route::delete('/penilaian/{id}', [PenilaianController::class, 'destroy'])->name('admin.penilaian.destroy');
    Route::get('/api/getPembimbingOptions/{taId}/{jabatan}', 'App\Http\Controllers\PenilaianController@getPembimbingOptions');
    Route::get('/get-dosen/{ta_id}/{jabatan}', [PenilaianController::class, 'getDosen'])->name('get.dosen');


    Route::get('/admin/assign-role', [RoleController::class, 'showAssignRoleForm'])->name('assign.role');
    Route::post('/admin/assign-role', [RoleController::class, 'assignRole']);

    Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin-validasi_ta', [ValidasiTaController::class, 'index'])->name('validasi_ta.index');
    Route::get('/validasi_ta/create', [ValidasiTaController::class, 'create'])->name('validasi_ta.create');
    Route::post('/validasi_ta', [ValidasiTaController::class, 'store'])->name('validasi_ta.store');
    Route::get('/validasi_ta/{id}', [ValidasiTaController::class, 'show'])->name('validasi_ta.show');
    Route::get('/validasi_ta/{id}/edit', [ValidasiTaController::class, 'edit'])->name('validasi_ta.edit');
    Route::put('/validasi_ta/{id}', [ValidasiTaController::class, 'update'])->name('validasi_ta.update');
    Route::delete('/validasi_ta/{id}', [ValidasiTaController::class, 'destroy'])->name('validasi_ta.destroy');
    Route::get('validasi_ta/{id}/download', [ValidasiTaController::class, 'downloadTa'])->name('validasi_ta.download');

    Route::get('validasi_proposal', [ValidasiProposalController::class, 'index'])->name('validasi_proposal.index');
    Route::get('validasi_proposal/create', [ValidasiProposalController::class, 'create'])->name('validasi_proposal.create');
    Route::post('validasi_proposal', [ValidasiProposalController::class, 'store'])->name('validasi_proposal.store');
    Route::get('validasi_proposal/{id}', [ValidasiProposalController::class, 'show'])->name('validasi_proposal.show');
    Route::get('validasi_proposal/{id}/edit', [ValidasiProposalController::class, 'edit'])->name('validasi_proposal.edit');
    Route::put('validasi_proposal/{id}', [ValidasiProposalController::class, 'update'])->name('validasi_proposal.update');
    Route::delete('validasi_proposal/{id}', [ValidasiProposalController::class, 'destroy'])->name('validasi_proposal.destroy');
    Route::get('validasi_proposal/{id}/download', [ValidasiProposalController::class, 'downloadProposal'])->name('validasi_proposal.download');

    Route::get('/admin-penilaian', [PenilaianController::class, 'index'])->name('admin.penilaian.index');
    Route::get('/admin-penilaian/create', [PenilaianController::class, 'create'])->name('admin.penilaian.create');
    Route::post('/admin-penilaian', [PenilaianController::class, 'store'])->name('admin.penilaian.store');
    Route::get('/admin-penilaian/{penilaian}', [PenilaianController::class, 'show'])->name('admin.penilaian.show');
    Route::get('/admin-penilaian/{penilaian}/edit', [PenilaianController::class, 'edit'])->name('admin.penilaian.edit');
    Route::put('/admin-penilaian/{penilaian}', [PenilaianController::class, 'update'])->name('admin.penilaian.update');
    Route::delete('/admin-penilaian/{penilaian}', [PenilaianController::class, 'destroy'])->name('admin.penilaian.destroy');
});

// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/admin-tugas_akhir', [Tugas_akhirController::class, 'index'])->name('admin.tugas_akhir.index');
    Route::get('/tugas_akhir', [Tugas_akhirController::class, 'index'])->name('tugas_akhir.index');
    Route::get('/tugas_akhir/create', [Tugas_akhirController::class, 'create'])->name('tugas_akhir.create');
    Route::post('/tugas_akhir', [Tugas_akhirController::class, 'store'])->name('tugas_akhir.store');
});

Route::get('/api/tugas_akhir/{id}/mahasiswas', [ValidasiTaController::class, 'getMahasiswasByTugasAkhir']);


Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/admin-penilaian', [PenilaianController::class, 'index'])->name('admin.penilaian.index');
    Route::get('/admin-penilaian/create', [PenilaianController::class, 'create'])->name('admin.penilaian.create');
    Route::post('/admin-penilaian', [PenilaianController::class, 'store'])->name('admin.penilaian.store');
    Route::get('/admin-penilaian/{penilaian}', [PenilaianController::class, 'show'])->name('admin.penilaian.show');
    Route::get('/admin-penilaian/{penilaian}/edit', [PenilaianController::class, 'edit'])->name('admin.penilaian.edit');
    Route::put('/admin-penilaian/{penilaian}', [PenilaianController::class, 'update'])->name('admin.penilaian.update');
    Route::delete('/admin-penilaian/{penilaian}', [PenilaianController::class, 'destroy'])->name('admin.penilaian.destroy');
});
