<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactListController;
use App\Http\Controllers\TableController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('table.create', [TableController::class, 'createTable']);
Route::post('table.delete', [TableController::class, 'deleteTable']);

Route::get('/getContact/{id}', [ContactListController::class, 'getContact']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Authentication
    Route::get('/user', [AuthController::class, 'userProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // User actions
    Route::prefix('/user')->group(function () {
        Route::put('/profile/{id}', [AuthController::class, 'changeProfile']);
        Route::put('/account/{id}', [AuthController::class, 'changeAccount']);
    });

    // table actions
    Route::prefix('/table')->group(function () {
        Route::post('/create', [TableController::class, 'createTable']);
        Route::post('/delete', [TableController::class, 'deleteTable']);
    });

    // contact actions
    Route::prefix('/contact')->group(function () {
        Route::post('/add', [ContactListController::class, 'createContact']);
        Route::get('/get/{id}', [ContactListController::class, 'getContact']);
    });
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
