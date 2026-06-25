<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\MasterSuratController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('surat-masuk', SuratMasukController::class);
    Route::resource('surat-keluar', SuratKeluarController::class);
    Route::get('surat-keluar/{suratKeluar}/print', [SuratKeluarController::class, 'print'])->name('surat-keluar.print');
    Route::post('surat-keluar/preview-nomor', [SuratKeluarController::class, 'previewNomor'])->name('surat-keluar.preview-nomor');
    Route::resource('master-surat', MasterSuratController::class)->middleware('admin');

    Route::resource('menu', MenuController::class)->middleware('admin');
    Route::resource('jabatan', JabatanController::class)->middleware('admin');

    Route::get('surat-masuk/{suratMasuk}/disposisi', [DisposisiController::class, 'create'])->name('disposisi.create');
    Route::post('surat-masuk/{suratMasuk}/disposisi', [DisposisiController::class, 'store'])->name('disposisi.store');
    Route::get('disposisi', [DisposisiController::class, 'index'])->name('disposisi.index');
    Route::get('disposisi/{disposisi}', [DisposisiController::class, 'show'])->name('disposisi.show');
    Route::post('disposisi/{disposisi}/lanjutan', [DisposisiController::class, 'storeLanjutan'])->name('disposisi.store-lanjutan');
    Route::delete('disposisi/{disposisi}', [DisposisiController::class, 'destroy'])->name('disposisi.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
