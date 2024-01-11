<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\JenislayananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayananKhususController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StatuspesananController;
use App\Http\Controllers\StatuspembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard.index');
})->middleware('auth');

Route::get('/login', [LoginController::class,'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'authenticate']);
Route::get('/logout', [LoginController::class,'logout']);



Route::resource('/register', RegisterController::class);
Route::resource('/profil', ProfilController::class);
Route::resource('/dashboard', DashboardController::class)->middleware('auth');
Route::resource('/itemLaundry', ItemController::class)->middleware('auth');
Route::resource('/layananKhusus', LayananKhususController::class)->middleware('auth');
Route::resource('/transaksi', TransaksiController::class)->middleware('auth');
Route::resource('/laporan', LaporanController::class)->middleware('auth');
Route::resource('/jenislayanan', JenislayananController::class)->middleware('auth');
Route::resource('/pesanan', PesananController::class)->middleware('auth');
Route::resource('/status_pesanan', StatuspesananController::class)->middleware('auth');
Route::resource('/status_pembayaran', StatuspembayaranController::class)->middleware('auth');
Route::get('/pesanan/naikkan-status/{id}',  [PesananController::class, 'naikkan_status']);
Route::get('/pesanan/print/{id}',  [PesananController::class, 'export']);
Route::get('/cetaksemua',  [LaporanController::class, 'cetaksemua']);
Route::get('/cetakpertanggal/{tglawal}/{tglakhir}',  [LaporanController::class, 'cetakpertanggal']);







