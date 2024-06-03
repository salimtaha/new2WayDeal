<?php

use App\Http\Controllers\Mediator\Withdrawal\AcceptedWithdrawalController;
use App\Http\Controllers\Mediator\Withdrawal\PendingWithdrawalController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mediator\WelcomeController;
use App\Http\Controllers\Mediator\Auth\LoginController;
use App\Http\Controllers\Mediator\Notification\NotificationController;
use App\Http\Controllers\Mediator\Withdrawal\RejectedWithdrawalController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'mediators', 'as' => 'mediators.'], function () {

    // Auth Routes
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('showLogin');
        Route::post('/login/check', 'check')->name('check');
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::get('test' , function(){
        return         $start_day = Carbon::parse(now()->format('Y-m-d h:m:s'))->startOfDay();

    });

    Route::middleware(['auth:mediator'])->group(function () {

        // Welcome Route
        Route::get('/welcome' , [WelcomeController::class , 'index'])->name('welcome');


        // withdrawals Routes
        Route::controller(PendingWithdrawalController::class)->prefix('pending')->name('pending.')->group(function () {
            Route::match(['get' , 'post'],'/', 'index')->name('index');
            Route::get('/{id}/show', 'show')->name('show');
            Route::get('/{id}/accept', 'accept')->name('accept');
            Route::get('/{id}/reject', 'reject')->name('reject');

        });
        Route::controller(AcceptedWithdrawalController::class)->prefix('accepted')->name('accepted.')->group(function () {
            Route::match(['get' , 'post'],'/', 'index')->name('index');
            Route::get('/get-all', 'getAll')->name('getall');

        });
        Route::controller(RejectedWithdrawalController::class)->prefix('rejected')->name('rejected.')->group(function () {
            Route::match(['get' , 'post'],'/', 'index')->name('index');
            Route::get('/get-all', 'getAll')->name('getall');

        });

        // Notification Route
        Route::controller(NotificationController::class)->prefix('notifications')->name('notifications.')->group(function(){
            Route::get('/' , 'index')->name('index');
        });









    });
});
