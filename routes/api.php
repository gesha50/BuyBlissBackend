<?php

use App\Http\Controllers\AdressController;
use App\Http\Controllers\v1\AddressController;
use App\Http\Controllers\v1\ColorCategoryController;
use App\Http\Controllers\v1\ColorController;
use App\Http\Controllers\v1\FeedbackController;
use App\Http\Controllers\v1\PriceChangesController;
use App\Http\Controllers\v1\ProductCategoryController;
use App\Http\Controllers\v1\ProductController;
use App\Http\Controllers\v1\ProductImageController;
use App\Http\Controllers\v1\SizeController;
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

Route::apiResource('products', ProductController::class)
    ->only(['index', 'show']);

Route::apiResource('product-categories', ProductCategoryController::class)
    ->only(['index', 'show']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::apiResource('product-categories', ProductCategoryController::class,)
        ->only(['create', 'store', 'update', 'destroy']);
    Route::apiResource('products', ProductController::class)
        ->only(['create', 'store', 'update', 'destroy']);
    Route::apiResource('product-images', ProductImageController::class);
    Route::get('product-images/{product}/all', [ProductImageController::class, 'showProductImages']);

    //price-changes
    Route::get('/price-changes/{product}', [PriceChangesController::class, 'show']);
    Route::get('/price-changes/full/{product}', [PriceChangesController::class, 'showFull']);
    Route::apiResource('price-changes', PriceChangesController::class);

    //sizes
    Route::get('/sizes/{product}', [SizeController::class, 'show']);
    Route::apiResource('sizes', SizeController::class);

    // Color
    Route::apiResource('color-categories', ColorCategoryController::class);
    Route::apiResource('colors', ColorController::class);
    Route::post('/colors/add-to-product/{product}', [ColorController::class, 'addColorToProduct']);

    //User
    Route::prefix('user/')->group(function () {
        Route::get('addresses/all/{user}', [AddressController::class, 'showUser']);
        Route::apiResource('addresses', AddressController::class);
    });

    //Feedback
    Route::apiResource('feedbacks', FeedbackController::class);

});

// Auth
Route::post('/login', [UserController::class, 'login'] );
Route::post('/register', [UserController::class, 'register'] );

Route::post('/send-password', [UserController::class, 'sendPassword'] );
Route::post('/check-login', [UserController::class, 'checkLogin'] );
Route::post('/reset-password', [UserController::class, 'resetPassword'] );

