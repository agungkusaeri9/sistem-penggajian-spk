<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\GajiLemburController;
use App\Http\Controllers\GajiPotonganController;
use App\Http\Controllers\GolonganGajiController;
use App\Http\Controllers\GolonganGajiTunjanganController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
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


    // admin
    Route::middleware('cek_role:admin')->group(function () {
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
        Route::get('golongan-gaji/{jabatan_id}/by-jabatan-id', [GolonganGajiController::class, 'getByJabatanId'])->name('golongan-gaji.getByJabatanId');
        Route::resource('tunjangan', TunjanganController::class)->except('show');
        Route::resource('karyawan', KaryawanController::class)->except('show');
        Route::resource('bank', BankController::class)->except('show');
        Route::get('bank/getbykaryawanid', [BankController::class, 'getbykaryawanid'])->name('bank.getbykaryawanid');

        Route::controller(GajiLemburController::class)->group(function () {
            Route::get('/gaji-lembur/{gaji_uuid}', 'index')->name('gaji-lembur.index');
            Route::get('/gaji-lembur/create/{gaji_uuid}', 'create')->name('gaji-lembur.create');
            Route::post('/gaji-lembur/create/{gaji_uuid}', 'store')->name('gaji-lembur.store');
            Route::get('/gaji-lembur/edit/{uuid}', 'edit')->name('gaji-lembur.edit');
            Route::patch('/gaji-lembur/edit/{uuid}', 'update')->name('gaji-lembur.update');
            Route::delete('/gaji-lembur/edit/{uuid}', 'destroy')->name('gaji-lembur.destroy');
        });

        Route::controller(GajiPotonganController::class)->group(function () {
            Route::get('/gaji-potongan/{gaji_uuid}', 'index')->name('gaji-potongan.index');
            Route::get('/gaji-potongan/create/{gaji_uuid}', 'create')->name('gaji-potongan.create');
            Route::post('/gaji-potongan/create/{gaji_uuid}', 'store')->name('gaji-potongan.store');
            Route::get('/gaji-potongan/edit/{uuid}', 'edit')->name('gaji-potongan.edit');
            Route::patch('/gaji-potongan/edit/{uuid}', 'update')->name('gaji-potongan.update');
            Route::delete('/gaji-potongan/edit/{uuid}', 'destroy')->name('gaji-potongan.destroy');
        });
    });

    Route::resource('gaji', GajiController::class)->except('show');
    Route::get('gaji/{uuid}/detail', [GajiController::class, 'detail'])->name('gaji.detail');
    Route::post('gaji/update-lembur/{uuid}', [GajiController::class, 'update_lembur'])->name('gaji.update-lembur');
    Route::post('gaji/update-potongan/{uuid}', [GajiController::class, 'update_potongan'])->name('gaji.update-potongan');
});
