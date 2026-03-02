<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Peminjam\PeminjamanController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjaman;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Peminjam\AlatController as PeminjamAlatController;
use App\Http\Controllers\Peminjam\DashboardController as PeminjamDashboardController;
use App\Http\Controllers\Peminjam\KeranjangController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {

    if (!auth()->check()) {
        return redirect('/login');
    }

    return match (auth()->user()->role) {
        'admin'    => redirect('/admin/dashboard'),
        'petugas'  => redirect('/petugas/dashboard'),
        default    => redirect('/peminjam/dashboard'),
    };

});

// autentikas web login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//ROUTE ADMIN 
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/alat', AlatController::class)->names('alat');
    Route::resource('/kategori', KategoriController::class)->names('kategori');
});

//Route petugas
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/peminjaman', [PetugasPeminjaman::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/{id}/approve', [PetugasPeminjaman::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{id}/reject', [PetugasPeminjaman::class, 'reject'])->name('peminjaman.reject');
    });
    
//Route Peminjam
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [PeminjamDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/detail-alat/{id_alat}', [PeminjamAlatController::class, 'show'])->name('detail-alat');

    Route::get('/proses-penyewaan/{id_alat}', [PeminjamanController::class, 'create'])->name('proses-penyewaan');
    Route::post('/proses-penyewaan', [PeminjamanController::class, 'store'])->name('proses-penyewaan.store');
    Route::get('/transaksi-berhasil/{id_transaksi}', [PeminjamanController::class, 'show'])->name('transaksi-berhasil');
    Route::get('/transaksi', [PeminjamanController::class, 'index'])->name('riwayat-penyewaan');

    Route::prefix('keranjang')->name('keranjang.')->group(function () {
        Route::get('/', [KeranjangController::class, 'index'])->name('index');
        Route::post('/add', [KeranjangController::class, 'add'])->name('add');
        Route::put('/update/{id}', [KeranjangController::class, 'update'])->name('update');
        Route::get('/remove/{id}', [KeranjangController::class, 'remove'])->name('remove');
        Route::post('/checkout', [KeranjangController::class, 'checkout'])->name('checkout');
    });

    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/{id}/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
});