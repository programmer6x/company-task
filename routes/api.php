<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignUserController;
use App\Http\Controllers\CartItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MediaController;
use App\Models\Campaign;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('register', [AuthController::class,'register']);
});

Route::middleware('auth:api')->group(function (){
    Route::apiResource('/categories',CategoryController::class);
});

Route::middleware('auth:api')->group(function (){
    Route::get('/products',[ProductController::class,'index']);
    Route::post('/products',[ProductController::class,'store']);
    Route::get('/products/{id}',[ProductController::class,'show']);
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{deleted_ids}',[ProductController::class,'destroy']);
});

//Route::middleware('auth:api')->group(function (){
//    Route::get('/medias',[MediaController::class,'index']);
//    Route::post('/medias',[MediaController::class,'store']);
//    Route::get('/medias/{id}',[MediaController::class,'show']);
//    Route::put('/medias/{id}',[MediaController::class,'update']);
//    Route::delete('/medias/{media_ids}',[MediaController::class,'destroy']);
//});

Route::middleware('auth:api')->group(function (){
    Route::get('/cart-items',[CartItemController::class,'index']);
    Route::post('/cart-items',[CartItemController::class,'store']);
    Route::get('/cart-items/{id}',[CartItemController::class,'show']);
    Route::put('/cart-items/{id}',[CartItemController::class,'update']);
    Route::delete('/cart-items/{cart_ids}',[CartItemController::class,'destroy']);
});

//Route::get('/factory',function (){
//    Campaign::factory()->count(20)->create();
//});

Route::middleware('auth:api')->group(function (){
    Route::apiResource('/campaigns',CampaignController::class);
});


