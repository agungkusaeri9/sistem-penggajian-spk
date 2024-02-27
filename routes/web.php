<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GolonganGajiController;
use App\Http\Controllers\GolonganGajiTunjanganController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TunjanganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password.index');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');
    Route::resource('users', UserController::class)->except('show');
    Route::resource('jabatan', JabatanController::class)->except('show');
    Route::resource('divisi', DivisiController::class)->except('show');
    Route::controller(GolonganGajiTunjanganController::class)->group(function () {
        Route::get('/golongan-gaji-tunjangan/{id}', 'index')->name('golongan-gaji-tunjangan.index');
        Route::get('/golongan-gaji-tunjangan/{id}/create', 'create')->name('golongan-gaji-tunjangan.create');
        Route::post('/golongan-gaji-tunjangan/{id}/create', 'store')->name('golongan-gaji-tunjangan.store');
        Route::get('/golongan-gaji-tunjangan/{id}/edit', 'edit')->name('golongan-gaji-tunjangan.edit');
        Route::patch('/golongan-gaji-tunjangan/{id}/edit', 'update')->name('golongan-gaji-tunjangan.update');
        Route::delete('/golongan-gaji-tunjangan/{id}', 'destroy')->name('golongan-gaji-tunjangan.destroy');
    });
    Route::resource('golongan-gaji', GolonganGajiController::class);
    Route::resource('tunjangan', TunjanganController::class)->except('show');
});
