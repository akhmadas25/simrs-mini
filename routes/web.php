<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'tampilkan'])->name('dashboard');

Route::controller(PasienController::class)->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/', 'daftar')->name('daftar');
    Route::get('/tambah', 'tambah')->name('tambah');
    Route::post('/', 'simpan')->name('simpan');
    Route::get('/{pasien}', 'detail')->name('detail');
    Route::get('/{pasien}/ubah', 'ubah')->name('ubah');
    Route::put('/{pasien}', 'perbarui')->name('perbarui');
    Route::delete('/{pasien}', 'hapus')->name('hapus');
});

Route::controller(DokterController::class)->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/', 'daftar')->name('daftar');
    Route::get('/tambah', 'tambah')->name('tambah');
    Route::post('/', 'simpan')->name('simpan');
    Route::get('/{dokter}', 'detail')->name('detail');
    Route::get('/{dokter}/ubah', 'ubah')->name('ubah');
    Route::put('/{dokter}', 'perbarui')->name('perbarui');
    Route::delete('/{dokter}', 'hapus')->name('hapus');
});
