<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengajuanApiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Api\AuthController;

Route::post('dukcapil/verifikasi', [PengajuanApiController::class, 'verifikasiNik']);
Route::get('tracking/{nomor_registrasi}', [PengajuanApiController::class, 'trackStatus']);

Route::post('pengajuan', [PengajuanApiController::class, 'buatPengajuan']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::get('pengajuan', [PengajuanController::class, 'index']);
    Route::post('pengajuan', [PengajuanController::class, 'store']);
    Route::get('pengajuan/{id}', [PengajuanController::class, 'show']);
    Route::put('pengajuan/{id}/status', [PengajuanController::class, 'updateStatus']);
    Route::delete('pengajuan/{id}', [PengajuanController::class, 'destroy']);
    Route::post('pengajuan/{id}/upload-dokumen', [PengajuanApiController::class, 'uploadDokumen']);
    Route::get('pengajuan/{id}/cetak-pdf', [PengajuanController::class, 'cetakPdf']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');