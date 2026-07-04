<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanySettingController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Company Settings API Routes
Route::prefix('company-settings')->group(function () {
    Route::get('/', [CompanySettingController::class, 'index']);
    Route::get('/group/{group}', [CompanySettingController::class, 'byGroup']);
    Route::post('/', [CompanySettingController::class, 'store']);
    Route::post('/bulk-update', [CompanySettingController::class, 'bulkUpdate']);
    Route::get('/{key}', [CompanySettingController::class, 'show']);
    Route::put('/{key}', [CompanySettingController::class, 'update']);
    Route::delete('/{key}', [CompanySettingController::class, 'destroy']);
});

