<?php

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

Route::post('/login', [UserController::class, 'login'] );
Route::post('/register', [UserController::class, 'register'] );

Route::post('/send-password', [UserController::class, 'sendPassword'] );
Route::post('/check-login', [UserController::class, 'checkLogin'] );
Route::post('/reset-password', [UserController::class, 'resetPassword'] );

