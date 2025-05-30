<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('dashboard');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\AdminController;

// Rute login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

// Rute register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Proteksi rute dengan middleware auth dan role
Route::middleware('auth')->group(function () {
    // Rute mahasiswa
    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/mahasiswa', [KelompokController::class, 'index'])->name('mahasiswa.index');
        Route::get('/mahasiswa/create', [KelompokController::class, 'create'])->name('mahasiswa.create');
        Route::post('/mahasiswa/store', [KelompokController::class, 'store'])->name('mahasiswa.store');
        Route::get('/mahasiswa/jadwal/{id}', [KelompokController::class, 'showJadwalForm'])->name('mahasiswa.jadwalForm');
        Route::put('/mahasiswa/jadwal/{id}', [KelompokController::class, 'updateJadwal'])->name('mahasiswa.updateJadwal');
        Route::get('/mahasiswa/edit/{id}', [KelompokController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/mahasiswa/update/{id}', [KelompokController::class, 'update'])->name('mahasiswa.update');
    });

    // Rute admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::put('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
        Route::put('/admin/reject/{id}', [AdminController::class, 'reject'])->name('admin.reject');
        Route::put('/admin/approve-jadwal-update/{id}', [AdminController::class, 'approveJadwalChange'])->name('admin.jadwalApprove');
        Route::put('/admin/reject-jadwal-update/{id}', [AdminController::class, 'rejectJadwalChange'])->name('admin.jadwalReject');
        Route::get('/admin/jadwal', [AdminController::class, 'jadwal'])->name('admin.jadwalForm');
        Route::post('/admin/jadwal/store', [AdminController::class, 'storeJadwal'])->name('admin.storeJadwal');
        Route::delete('/admin/jadwal/{id}', [AdminController::class, 'destroyJadwal'])->name('admin.destroyJadwal');
        Route::post('/admin/storeNilai/{id}', [AdminController::class, 'storeNilai'])->name('admin.storeNilai');
        Route::post('/admin/kelompok/{id}/selesai', [AdminController::class, 'selesai'])->name('admin.selesai');
        Route::delete('/admin/kelompok/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::post('/admin/kelompok/{id}/open-jadwal', [AdminController::class, 'openJadwalLab'])->name('admin.openJadwalLab');
        Route::post('/admin/open-all-jadwal', [AdminController::class, 'openAllJadwalLab'])->name('admin.openAllJadwalLab');
    });

    // Rute logout (untuk semua user yang sudah login)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
