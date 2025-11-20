<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ResendVerificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('getRoles', [RoleController::class, 'fetchRoles']);

// Email Verification
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware(['signed', 'throttle:6,1']);

// Resend verification
Route::post('/email/resend', [ResendVerificationController::class, 'resend'])
    ->middleware('throttle:6,1');

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('/saveUser', [UserController::class, 'store']);
    Route::get('/getUser', [UserController::class, 'index']);
    Route::post('/getUser/{id}', [UserController::class, 'show']);
    Route::post('/updateUser/{id}', [UserController::class, 'update']);
    Route::post('/deleteUser/{id}', [UserController::class, 'delete']);

    Route::post('createRole', [RoleController::class, 'saveRole']);
    Route::get('getRole/{id}', [RoleController::class, 'fetchRole']);
    Route::put('updateRole/{id}', [RoleController::class, 'updateRole']);
    Route::delete('deleteRole/{id}', [RoleController::class, 'deleteRole']);

    Route::post('/saveProperty', [PropertyController::class, 'store']);
    Route::get('/getProperty', [PropertyController::class, 'index']);
    Route::post('/getProperty/{id}', [PropertyController::class, 'show']);
    Route::post('/updateProperty/{id}', [PropertyController::class, 'update']);
    Route::post('/deleteProperty/{id}', [PropertyController::class, 'delete']);
});
