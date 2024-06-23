<?php

use App\Http\Controllers\API\User\{OrdersController,ProfileController,ContactUsController, FavouritesController, RateSeller};
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
Route::post('',[ProfileController::class,'update'])->name('customer.update');
Route::post('update-pic',[ProfileController::class,'updatePic']);
Route::post('update-password',[ProfileController::class,'updatePassword']);

//Orders
Route::get('orders',[OrdersController::class,'index']);
Route::get('order/{order}',[OrdersController::class,'show'])->name('order.show');


//Contact Us
Route::post('contact-us',ContactUsController::class);


//Rate seller
Route::post('rate-seller/{seller}',RateSeller::class)->name('rate.seller');

//Favourites
Route::get('favourites',[FavouritesController::class,'index']);
Route::post('favourites',[FavouritesController::class,'store'])->name('favourite.store');
Route::post('favourites/{favourite}',[FavouritesController::class,'destroy'])->name('favourite.delete');
