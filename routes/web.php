<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Peminjam\PeminjamanController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjaman;
use App\Http\Controllers\Admin\DashboardController;


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

//route dashboard admin
Route::get('/admin/dashboard', 
    [DashboardController::class, 'index'])
    ->middleware(['auth','role:admin'])
    ->name('admin.dashboard');
// autentikas web login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//ROUTE ADMIN 
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::resource('admin/alat', AlatController::class);
});
Route::resource('admin/kategori', KategoriController::class);
//Route petugas
Route::middleware(['auth', 'role:petugas'])->group(function () {

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

Route::middleware(['auth', 'role:petugas'])->group(function () {
Route::get('/petugas/dashboard', fn() => view('petugas.dashboard'));
});

Route::middleware(['auth', 'role:peminjam'])->group(function () {
    Route::get('/peminjam/dashboard', fn() => view('peminjam.dashboard'))->name('peminjam.dashboard');
});



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
// route peminjaman
Route::middleware(['auth', 'role:peminjam'])->group(function(){

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