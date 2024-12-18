<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\{
    DashboardController,
    LoginController,
    SiswaController,
    KelasController,
    MataPelajaranController,
    WebController,
    ModulController,
    UjianController,
    WebModulController,
    WebUjianController,
    WebHasilUjianController,
    HasilUjianController
};

Route::get('/run-admin', function () {
    Artisan::call('db:seed', [
        '--class' => 'SuperAdminSeeder'
    ]);

    return "AdminSeeder has been create successfully!";
});
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');





Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswas.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswas.create');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswas.store');
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('siswas.edit');
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswas.update');
    Route::delete('/siswa/delete/{id}', [SiswaController::class, 'destroy'])->name('siswas.destroy');

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/update/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/delete/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    Route::get('/mata_pelajaran', [MataPelajaranController::class, 'index'])->name('mata_pelajarans.index');
    Route::get('/mata_pelajaran/create', [MataPelajaranController::class, 'create'])->name('mata_pelajarans.create');
    Route::post('/mata_pelajaran/store', [MataPelajaranController::class, 'store'])->name('mata_pelajarans.store');
    Route::get('/mata_pelajaran/edit/{id}', [MataPelajaranController::class, 'edit'])->name('mata_pelajarans.edit');
    Route::put('/mata_pelajaran/update/{id}', [MataPelajaranController::class, 'update'])->name('mata_pelajarans.update');
    Route::delete('/mata_pelajaran/delete/{id}', [MataPelajaranController::class, 'destroy'])->name('mata_pelajarans.destroy');

    Route::get('/master_modul', [ModulController::class, 'index'])->name('modul.index');
    Route::get('/master_modul/create', [ModulController::class, 'create'])->name('modul.create');
    Route::post('/master_modul/store', [ModulController::class, 'store'])->name('modul.store');
    Route::get('/master_modul/edit/{id}', [ModulController::class, 'edit'])->name('modul.edit');
    Route::put('/master_modul/update/{id}', [ModulController::class, 'update'])->name('modul.update');
    Route::delete('/master_modul/delete/{id}', [ModulController::class, 'destroy'])->name('modul.destroy');

    Route::get('/ujian', [UjianController::class, 'index'])->name('ujian.index');
    Route::get('/ujian/create', [UjianController::class, 'create'])->name('ujian.create');
    Route::post('/ujian/store', [UjianController::class, 'store'])->name('ujian.store');
    Route::get('/ujian/edit/{id}', [UjianController::class, 'edit'])->name('ujian.edit');
    Route::put('/ujian/update/{id}', [UjianController::class, 'update'])->name('ujian.update');
    Route::delete('/ujian/delete/{id}', [UjianController::class, 'destroy'])->name('ujian.destroy');
    Route::get('/ujian/update-status/{id}', [UjianController::class, 'updateStatus'])->name('ujian.updateStatus');
    Route::get('/ujian/view-soal/{id}', [UjianController::class, 'viewSoal'])->name('ujian.viewSoal');

    Route::get('/hasil_ujian', [HasilUjianController::class, 'index'])->name('hasilUjian.index');
});

Route::get('/', [WebController::class, 'index'])->name('web.index');
Route::get('/siswa/modul', [WebModulController::class, 'index'])->name('web.modul');
Route::get('/siswa/ujian', [WebUjianController::class, 'index'])->name('web.ujian');
Route::get('/siswa/ujian/mulai/{id}', [WebUjianController::class, 'mulaiUjian'])->name('web.ujianMulai');
Route::post('/siswa/ujian/simpan-hasil', [WebUjianController::class, 'simpanHasilUjian'])->name('web.simpanHasilUjian');
Route::get('/siswa/hasil-ujian', [WebHasilUjianController::class, 'index'])->name('web.hasilUjian');