<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DashboardApiController;
use App\Http\Controllers\API\JenislayananApiController;
use App\Http\Controllers\API\LayanankhususApiController;
use App\Http\Controllers\API\StatuspesananApiController;
use App\Http\Controllers\API\PesananApiController;
use App\Http\Controllers\API\AuthController;


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function() {
    //pelanggan
    Route::get('/pelanggan', [DashboardApiController::class, 'index']);
    Route::post('/create-pelanggan', [DashboardApiController::class, 'store']);
    Route::post('/edit-pelanggan/{id}', [DashboardApiController::class, 'update']);
    Route::delete('/pelanggan/{id}', [DashboardApiController::class, 'destroy']);

    //jenislayanan
    Route::resource('/jenislayanan', JenislayananApiController::class);
    Route::resource('/layanankhusus', LayanankhususApiController::class);
    Route::resource('/statuspesanan', StatuspesananApiController::class);
    Route::resource('/pesanan', PesananApiController::class);
});
