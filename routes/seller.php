<?php

use App\Http\Controllers\API\Seller\{NotificationsController, OrdersController, ProfileController,ProductsController};
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

//Profile
Route::get('',[ProfileController::class,'index']);
Route::post('',[ProfileController::class,'update'])->name('seller.update');
Route::post('update-pic',[ProfileController::class,'updatePic']);
Route::post('update-password',[ProfileController::class,'updatePassword']);

//Products
Route::get('products',[ProductsController::class,'index']);
Route::get('products/best-sellers',[ProductsController::class,'bestSellers']);
Route::post('products',[ProductsController::class,'store']);
Route::get('product/{product}',[ProductsController::class,'show'])->name('product.show');
Route::post('product/{product}',[ProductsController::class,'update'])->name('product.update');
Route::post('product/{product}/delete',[ProductsController::class,'destroy'])->name('product.delete');
Route::get('notifications',[NotificationsController::class,'index']);
Route::get('notification/{notification}',[NotificationsController::class,'show'])->name('seller.notification');


//Orders
Route::get('orders',[OrdersController::class,'index']);
