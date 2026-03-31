<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Peminjam\PeminjamanController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjaman;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\LogController;


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

// autentikas web login
// ================= AUTH =================
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


// ================= ADMIN =================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('alat', AlatController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('user', UserController::class);
        Route::resource('peminjaman',PeminjamanController::class);
        Route::get('pengembalian', [PengembalianController::class, 'index' ])
        ->name('pengembalian.index');
        Route::post('pengembalian/{id}', [PengembalianController::class, 'kembalikan'])
        ->name('pengembalian.kembalikan');
        Route::get('log', [logController::class, 'index'])
        ->name('log.index');
        Route::post('/alat/bulk-delete', [AlatController::class, 'bulkDelete'])
        ->name('alats.bulkDelete');
        Route::get('/peminjam/peminjaman/{id}', [PeminjamanController::class, 'show'])
        ->name('peminjam.peminjaman.show');

});


// ================= PETUGAS =================
Route::middleware(['auth', 'role:petugas'])->group(function () {

    Route::get('/petugas/dashboard', fn() => view('petugas.dashboard'));

    Route::get('/petugas/peminjaman',
        [PetugasPeminjaman::class, 'index'])
        ->name('petugas.peminjaman.index');

    Route::post('/petugas/peminjaman/{id}/approve',
        [PetugasPeminjaman::class, 'approve'])
        ->name('petugas.peminjaman.approve');

    Route::post('/petugas/peminjaman/{id}/reject',
        [PetugasPeminjaman::class, 'reject'])
        ->name('petugas.peminjaman.reject');
});


// ================= PEMINJAM =================
Route::middleware(['auth', 'role:peminjam'])->group(function(){

    Route::get('/peminjam/dashboard',
        fn() => view('peminjam.dashboard'));

    Route::get('/peminjam/peminjaman',
        [PeminjamanController::class, 'index'])
        ->name('peminjam.peminjaman.index');

    Route::get('/peminjam/peminjaman/{id}/create',
        [PeminjamanController::class, 'create'])
        ->name('peminjam.peminjaman.create');

    Route::post('/peminjam/peminjaman',
        [PeminjamanController::class, 'store'])
        ->name('peminjam.peminjaman.store');
});


// ================= ROOT REDIRECT =================
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