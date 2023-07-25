<?php

use App\Http\Controllers\Auth\JwtController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\IncomesController;
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
        Route::get('/{id}', [UserController::class, 'show'])->middleware('jwt.auth');
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update'])->middleware('jwt.auth');
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('jwt.auth');
        Route::post('/login', [JwtController::class, 'login']);
        Route::get('/refresh-session', [JwtController::class, 'refresh'])->middleware('jwt.auth');
        Route::get('/logout', [UserController::class, 'logout'])->middleware('jwt.auth');
    });


    Route::prefix('/expense-category')->middleware('jwt.auth')->group(function() {
        Route::get('/', [ExpenseCategoryController::class, 'index']);
        Route::get('/{id}', [ExpenseCategoryController::class, 'show']);
        Route::post('/', [ExpenseCategoryController::class, 'store']);
        Route::put('/{id}', [ExpenseCategoryController::class, 'update']);
        Route::delete('/{id}', [ExpenseCategoryController::class, 'destroy']);
    });


    Route::prefix('income-category')->middleware('jwt.auth')->group(function() {
        Route::get('/', [IncomeCategoryController::class, 'index']);
        Route::get('/{id}', [IncomeCategoryController::class, 'show']);
        Route::post('/', [IncomeCategoryController::class, 'store']);
        Route::put('/{id}', [IncomeCategoryController::class, 'update']);
        Route::delete('/{id}', [IncomeCategoryController::class, 'destroy']);
    });


    Route::prefix('/expenses')->group(function() {
        Route::get('/', [ExpensesController::class, 'index']);
        Route::get('/{id}', [ExpensesController::class, 'show']);
        Route::post('/', [ExpensesController::class, 'store']);
        Route::put('/{id}', [ExpensesController::class, 'update']);
        Route::delete('/{id}', [ExpensesController::class, 'destroy']);
    });

    
    Route::prefix('/incomes')->group(function() {
        Route::get('/', [IncomesController::class, 'index']);
        Route::get('/{id}', [IncomesController::class, 'show']);
        Route::post('/', [IncomesController::class, 'store']);
        Route::put('/{id}', [IncomesController::class, 'update']);
        Route::delete('/{id}', [IncomesController::class, 'destroy']);
    });
});