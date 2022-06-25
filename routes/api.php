<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TrxController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::get('/pegawai/tambah', [PegawaiController::class, 'create']); // show form
Route::post('/pegawai/tambah', [PegawaiController::class, 'store']); // save to db
Route::post('/pegawai/hapus/{id}', [PegawaiController::class, 'destroy'])->name('hapus');
Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('edit_pg'); // show form
Route::post('/pegawai/{id}/edit', [PegawaiController::class, 'update'])->name('update_pg'); // save to db

Route::get('/export', [TrxController::class, 'export'])->name('export');
Route::get('/trx', [TrxController::class, 'index']);
Route::get('/trx/save', [TrxController::class, 'index_success']);
Route::get('/trx/tambah', [TrxController::class, 'create']); // show form
Route::post('/trx/tambah', [TrxController::class, 'store']); // save to db
Route::get('/trx/{id}/edit', [TrxController::class, 'edit'])->name('edit_trx');
Route::post('/trx/{id}/edit', [TrxController::class, 'update'])->name('update_trx');
Route::post('/trx/hapus/{id}', [TrxController::class, 'destroy'])->name('trx_hapus');
