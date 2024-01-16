<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ReplySupportController;
use App\Http\Controllers\Api\SupportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group( function () {
    Route::get('/replies/{support_id}', [ReplySupportController::class, 'getRepliesFromSupport']);
    Route::post('/replies/{support_id}', [ReplySupportController::class, 'createNewReply']);
    Route::delete('/replies/{id}', [ReplySupportController::class, 'destroy']);
    
    Route::apiResource('/supports', SupportController::class);
});

