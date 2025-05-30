<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\TimeLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


 Route::put('/time-logs/end/{time_log}', [TimeLogController::class, 'end']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('clients', ClientController::class);

    Route::get('/time-logs', [TimeLogController::class,'index']);
    Route::post('/time-logs/start', [TimeLogController::class, 'store']);
    Route::put('/time-logs/update/{time_log}', [TimeLogController::class, 'update']);


    Route::get('/time-log/generate/pdf',[TimeLogController::class, 'generatePdf']);

    Route::get('project/report', [ReportController::class, 'projectReport']);
});
