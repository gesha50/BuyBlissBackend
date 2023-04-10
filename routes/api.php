<?php

use App\Http\Controllers\v1\ProductCategoryController;
use App\Http\Controllers\v1\ProductController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', ProductController::class)->only([
    'index', 'show'
]);

Route::resource('product-categories', ProductCategoryController::class)->only([
    'index', 'show'
]);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('product-categories', ProductCategoryController::class,)->only([
        'create', 'store', 'update', 'destroy'
    ]);
    Route::apiResource('products', ProductController::class)->only([
        'create', 'store', 'update', 'destroy'
    ]);
});

// Auth
Route::post('/login', [UserController::class, 'login'] );
Route::post('/register', [UserController::class, 'register'] );

Route::post('/send-password', [UserController::class, 'sendPassword'] );
Route::post('/check-login', [UserController::class, 'checkLogin'] );
Route::post('/reset-password', [UserController::class, 'resetPassword'] );

