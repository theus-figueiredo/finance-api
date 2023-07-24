<?php

use App\Http\Controllers\Auth\JwtController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::name('app')->namespace('App\Http\Controllers')->group(function() {

    Route::prefix('/users')->group(function() {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'create']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::post('/login', [JwtController::class, 'login']);
        Route::get('/refresh-session', [JwtController::class, 'refresh']);
        Route::get('/logout', [UserController::class, 'logout']);
    });


    Route::prefix('/expense-category')->group(function() {
        Route::get('/', [ExpenseCategoryController::class, 'index']);
        Route::get('/{id}', [ExpenseCategoryController::class, 'show']);
        Route::post('/', [ExpenseCategoryController::class, 'create']);
        Route::put('/{id}', [ExpenseCategoryController::class, 'update']);
        Route::delete('/{id}', [ExpenseCategoryController::class, 'destroy']);
    });


    Route::prefix('income-category')->group(function() {
        Route::get('/', [IncomeCategoryController::class, 'index']);
        Route::get('/{id}', [IncomeCategoryController::class, 'show']);
        Route::post('/', [IncomeCategoryController::class, 'create']);
        Route::put('/{id}', [IncomeCategoryController::class, 'update']);
        Route::delete('/{id}', [IncomeCategoryController::class, 'destroy']);
    });


    Route::prefix('/expenses')->group(function() {
        Route::get('/', [ExpensesController::class, 'index']);
        Route::get('/{id}', [ExpensesController::class, 'show']);
        Route::post('/', [ExpensesController::class, 'create']);
        Route::put('/{id}', [ExpensesController::class, 'update']);
        Route::delete('/{id}', [ExpensesController::class, 'destroy']);
    });
});