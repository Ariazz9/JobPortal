<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobApiController;
use App\Http\Controllers\Api\ApplicationApiController;

Route::get('/status', fn() => ['status' => 'API is running']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/public/jobs', [JobApiController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', fn(Request $request) => $request->user());
    Route::post('/logout', [AuthController::class, 'logout']);

    // Jobs
    Route::get('/jobs/{job}', [JobApiController::class, 'show']);
    Route::post('/jobs', [JobApiController::class, 'store']);
    Route::put('/jobs/{job}', [JobApiController::class, 'update']);
    Route::delete('/jobs/{job}', [JobApiController::class, 'destroy']);

    // Applications
    Route::post('/jobs/{job}/apply', [ApplicationApiController::class, 'store']);
    Route::get('/applications', [ApplicationApiController::class, 'index']);
    Route::patch('/applications/{application}/status', 
        [ApplicationApiController::class, 'updateStatus']);
});
