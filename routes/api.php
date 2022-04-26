<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::get('/pegawai/tambah', [PegawaiController::class, 'create']); // show form
Route::post('/pegawai/tambah', [PegawaiController::class, 'store']); // save to db
Route::post('/pegawai/hapus/{id}', [PegawaiController::class, 'destroy'])->name('hapus'); //delete from db (fix later to soft delete!)
Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit']); // show form
Route::post('/pegawai/{id}/edit', [PegawaiController::class, 'update']); // save to db