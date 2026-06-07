<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengajuanApiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PemohonController;
use App\Http\Controllers\Api\JenisIzinController;

Route::post('pengajuan', [PengajuanApiController::class, 'buatPengajuan']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::middleware('role:pemohon')->group(function () {
        Route::post('pemohon', [PemohonController::class, 'store']);
        Route::post('jenis-izin', [JenisIzinController::class, 'store']);

        Route::post('pengajuan', [PengajuanController::class, 'store']);
        Route::post('pengajuan/{id}/upload-dokumen', [PengajuanController::class, 'uploadDokumen']);
        Route::get('pengajuan/{id}', [PengajuanController::class, 'show']);

        Route::get('pengajuan/{id}/cetak-pdf', [PengajuanController::class, 'cetakPdf']);

        Route::put('pengajuan/{id}/submit', [PengajuanController::class, 'submit']);

        Route::get('tracking/{nomor_registrasi}', [PengajuanApiController::class, 'trackStatus']);
    });
    
    Route::middleware('role:admin')->group(function () {
 
        Route::get('pengajuan', [PengajuanController::class, 'index']); 
        Route::put('pengajuan/{id}/status', [PengajuanController::class, 'updateStatus']);
        Route::delete('pengajuan/{id}', [PengajuanController::class, 'destroy']); 
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');