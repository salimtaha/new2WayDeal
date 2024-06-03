<?php

use App\Http\Controllers\Charity\Donation\DonationAcceptedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Charity\Auth\LoginController;
use App\Http\Controllers\Charity\Auth\RegisterController;
use App\Http\Controllers\Charity\Member\MemberController;
use App\Http\Controllers\Charity\Profile\ProfileController;
use App\Http\Controllers\Charity\Donation\DonationController;
use App\Http\Controllers\Charity\Member\TrashedMemberController;
use App\Http\Controllers\Charity\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Charity\Auth\Email\EmailVerificationController;
use App\Http\Controllers\Charity\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Charity\Notification\NotificationController;
use App\Http\Controllers\Charity\WelcomeController;

Route::group(['prefix' => 'charities', 'as' => 'charities.'], function () {

    // Register Routes
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showRegisterForm')->name('showRegister');
        Route::post('/register/store', 'store')->name('register.store');
        Route::get('register/verify' , 'showFormVerfication')->name('register.verify.form');
    });

    // Email Verfication
    Route::controller(EmailVerificationController::class)->group(function () {
        Route::post('/email-check', 'emailVerfication')->name('email.check');
        Route::get('email/{email}/tray-again' , 'tryAgain')->name('email.tryagain');

    });

    // Login Routes
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('showLogin');
        Route::post('/login/check', 'check')->name('login.check');
        Route::post('/logout', 'logout')->name('logout');
    });


      // Forget Password Routes
      Route::controller(ForgetPasswordController::class)->name('password.')->prefix('password')->group(function () {
        Route::get('/forget', 'showEmailForm')->name('forget');
        Route::post('/verify', 'getVerficationCode')->name('send.verfication.code');
        Route::get('/otp-form', 'otpForm')->name('otp.form');
        Route::post('/check-otp', 'checkOtp')->name('check.otp');
    });
    Route::controller(ResetPasswordController::class)->name('password.')->prefix('password')->group(function () {
        Route::get('/reset-form', 'showResetForm')->name('resetform');
        Route::post('/reset', 'resetPassword')->name('reset');
    });



        // Wating Page
     Route::view('/wating', 'charity.wait')->name('wait')->middleware('charity.status.approved');

    Route::middleware(['auth:charity' , 'check.charity.status'])->group(function () {

        // welcome route
        Route::get('/welcome' , [WelcomeController::class , 'index'])->name('welcome');

        //  Profile Routes
        Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/update', 'update')->name('update');
            Route::post('/update-image' , 'updateImage')->name('updateImage');
        });


         //  Members Routes
         Route::controller(MemberController::class)->prefix('members')->name('members.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all' , 'getAll')->name('getall');
            Route::get('/{id}/delete' , 'delete')->name('delete');
            Route::post('/store' , 'store')->name('store');
            Route::get('/{id}/edit' , 'edit')->name('edit');
            Route::put('/update' , 'update')->name('update');

        });
        Route::controller(TrashedMemberController::class)->prefix('members/trashed')->name('members.trashed.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all' , 'getAll')->name('getall');
            Route::get('/{id}/delete' , 'delete')->name('delete');
            Route::get('/{id}/restore' , 'restore')->name('restore');


        });


        // Donations Routes
        Route::controller(DonationController::class)->prefix('donations')->name('donations.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all' , 'getAll')->name('getall');
            Route::get('/{id}/show' , 'show')->name('show');
            Route::get('/{id}/accept' , 'accept')->name('accept');
            Route::get('/{id}/canceld' , 'canceld')->name('canceld');

        });
         // Accepted Donations Routes
         Route::controller(DonationAcceptedController::class)->prefix('donations\accepted')->name('donations.accepted.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all' , 'getAll')->name('getall');
            Route::get('/{id}/canceld' , 'canceld')->name('canceld');

        });

         // Notifications Routes
        Route::controller(NotificationController::class)->prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}/show' , 'show')->name('show');

        });



    });






});
