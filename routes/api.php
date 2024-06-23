<?php

use App\Http\Controllers\API\Auth\Login\{CustomerLoginController,SellerLoginController};
use App\Http\Controllers\API\Auth\Register\CustomerRegisterController;
use App\Http\Controllers\API\{AboutUsController, ProductsController,CategoriesController, CitiesController, GovernratesController, StoresController};
use App\Http\Controllers\API\Auth\Register\SellerRegisterController;
use App\Http\Controllers\API\Auth\Reset\{CustomerResetPasswordController, SellerResetPasswordController};
use App\Models\Product;
use Illuminate\Support\Facades\Artisan;
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

Route::group(['prefix'=>'auth'],function(){
    Route::group(['prefix'=>'login','middleware'=>['guest','throttle:login']],function(){
        Route::post('customer',CustomerLoginController::class);
        Route::post('seller',SellerLoginController::class);
    });

    Route::group(['prefix'=>'register','middleware'=>['guest','throttle:register']],function(){
        Route::post('customer',[CustomerRegisterController::class,'store']);
        Route::post('seller',[SellerRegisterController::class,'store']);
    });

    Route::group(['prefix'=>'verify','middleware'=>['auth:sanctum','throttle:verify']],function(){
        Route::post('customer',[CustomerRegisterController::class,'verify']);
        Route::post('seller',[SellerRegisterController::class,'verify']);
    });

   Route::group(['prefix'=>'address','middleware'=>['auth:sanctum','verified','throttle:register']],function(){
        Route::post('customer',[CustomerRegisterController::class,'address']);
        Route::post('seller',[SellerRegisterController::class,'address']);
    });

    Route::post('seller/certificates',[SellerRegisterController::class,'certificates'])->middleware(['auth:sanctum','verified','throttle:register']);
});

Route::group(['prefix'=>'password'],function(){

    Route::group(['prefix'=>'forgot','middleware'=>['guest','throttle:reset']],function(){
        Route::post('customer',[CustomerResetPasswordController::class,'forgot']);
        Route::post('seller',[SellerResetPasswordController::class,'forgot']);
    });

    Route::group(['prefix'=>'otp','middleware'=>['auth:sanctum','throttle:otp']],function(){
        Route::post('customer',[CustomerResetPasswordController::class,'otp']);
        Route::post('seller',[SellerResetPasswordController::class,'otp']);
    });

    Route::group(['prefix'=>'change','middleware'=>['auth:sanctum','throttle:change']],function(){
        Route::post('customer',[CustomerResetPasswordController::class,'change']);
        Route::post('seller',[SellerResetPasswordController::class,'change']);
    });
});

Route::get('products',[ProductsController::class,'index']);
Route::get('product/{product}',[ProductsController::class,'show'])->name('product.show');
Route::get('products/seller/{seller}',[ProductsController::class,'sellerProducts'])->name('seller');
Route::get('categories',[CategoriesController::class, 'index']);
Route::get('category/{category}',[CategoriesController::class,'show'])->name('category.show');
Route::get('governerates',GovernratesController::class);
Route::get('cities',CitiesController::class);
Route::get('stores',StoresController::class);
Route::get('about-us',AboutUsController::class);
