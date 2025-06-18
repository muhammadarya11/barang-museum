<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'prosesLogin']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'prosesRegister']);
});

Route::middleware('auth')->group(function () {

    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/lokasi-barang', [PageController::class, 'lokasi_barang'])->name('lokasi-barang');
    Route::get('/lokasi-barang/tambah', [PageController::class, 'tambah_lokasi'])->name('lokasi-barang.tambah');
    Route::post('/lokasi-barang/simpan', [PageController::class, 'simpan_lokasi'])->name('lokasi-barang.simpan');
    Route::get('/lokasi/{id}/edit', [PageController::class, 'edit_lokasi'])->name('lokasi.edit');
    Route::put('/lokasi-barang/{id}', [PageController::class, 'update_lokasi'])->name('lokasi-barang.update');
    Route::delete('/hapus-lokasi/{id}', [PageController::class, 'hapus_lokasi'])->name('lokasi.hapus');

    Route::get('/koleksi-barang', [PageController::class, 'koleksi_barang'])->name('koleksi-barang');
    Route::get('/tambah-koleksi', [PageController::class, 'tambah_koleksi'])->name('tambah-koleksi');
    Route::post('/simpan-koleksi', [PageController::class, 'simpan_koleksi'])->name('simpan-koleksi');
    Route::get('/koleksi/{id}/edit', [PageController::class, 'edit_koleksi'])->name('koleksi.edit');
    Route::put('/koleksi/{id}', [PageController::class, 'update_koleksi'])->name('koleksi.update');
    Route::delete('/hapus-koleksi/{id}', [PageController::class, 'hapus_koleksi'])->name('koleksi.hapus');
    Route::get('/koleksi/{id}/detail', [PageController::class, 'detail_koleksi'])->name('detail.koleksi');

    Route::get('/laporan-statistik', [PageController::class, 'laporan_statistik'])->name('laporan-statistik');
    Route::get('/tambah-laporan', [PageController::class, 'tambah_laporan'])->name('tambah-laporan');
    Route::post('/simpan-laporan', [PageController::class, 'simpan_laporan'])->name('simpan-laporan');
    Route::get('/laporan/{id}/edit', [PageController::class, 'edit_laporan'])->name('laporan.edit');
    Route::put('/laporan/{id}', [PageController::class, 'update_laporan'])->name('laporan.update');
    Route::delete('/hapus-laporan/{id}', [PageController::class, 'hapus_laporan'])->name('laporan.hapus');

    Route::get('/user', [UserController::class, 'user_index'])->name('user.index');
    Route::get('/user/tambah', [UserController::class, 'tambah_user'])->name('user.tambah');
    Route::post('/user/simpan', [UserController::class, 'simpan_user'])->name('user.simpan');
    Route::get('/user/{id}/edit', [UserController::class, 'edit_user'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update_user'])->name('user.update');
    Route::get('/user/{id}/reset-password', [UserController::class, 'formResetPassword'])->name('user.reset_password');
    Route::post('/user/{id}/reset-password', [UserController::class, 'resetPassword'])->name('user.reset_password.submit');
    Route::delete('/user/{id}', [UserController::class, 'hapus_user'])->name('user.hapus');

    Route::get('/beranda', [PageController::class, 'dashboard_pengunjung'])->name('dashboard.pengunjung');
    Route::get('/koleksi-pengunjung', [PageController::class, 'koleksi_pengunjung'])->name('koleksi.pengunjung');
    Route::get('/detail-koleksi/{id}', [PageController::class, 'detail_koleksi'])->name('detail.koleksi');
    Route::get('/tentang-museum', [PageController::class, 'tentang_museum'])->name('tentang.museum');

    Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
});
