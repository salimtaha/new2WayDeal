<?php

use App\Http\Controllers\Admin\Alert\AlertStoreController;
use App\Http\Controllers\Admin\Invoice\InvoiceController;
use App\Http\Controllers\Admin\Product\TrashedProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\WelcomeController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Store\StoreController;
use App\Http\Controllers\Admin\Profits\ProfitController;
use App\Http\Controllers\Admin\User\BlockUserController;
use App\Http\Controllers\Admin\Charity\CharityController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Mediator\MediatorController;
use App\Http\Controllers\Admin\Category\SubCategoryController;
use App\Http\Controllers\Admin\Withdrawal\WithdrawalController;
use App\Http\Controllers\Admin\Charity\CharityTrashedController;
use App\Http\Controllers\Admin\Mediator\MediatorTrashedController;
use App\Http\Controllers\Admin\Notification\NotificationController;
use App\Http\Controllers\Admin\Operations\LatestOperationController;
use App\Http\Controllers\Admin\Auth\password\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\password\ForgetPasswordController;
use App\Http\Controllers\Admin\User\Order\OrderController as OrderReportController;
use App\Http\Controllers\Admin\Auth\Password\PasswordOutside\ResetPasswordOutsideController;
use App\Http\Controllers\Admin\Auth\Password\PasswordOutside\ForgetPasswordOutsideController;

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


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    // Auth Routes
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('showLogin');
        Route::post('/login/check', 'check')->name('check');
        Route::post('/logout', 'logout')->name('logout');
    });

    // Forget Password Routes inside system
    Route::controller(ForgetPasswordController::class)->name('password.')->prefix('password')->group(function () {
        Route::get('/forgot', 'showEmailForm')->name('forgot');
        Route::post('/verify', 'getVerficationCode')->name('send.verfication.code');
        Route::get('{email}/otp-form', 'otpForm')->name('otp.form');
        Route::post('/check-otp', 'checkOtp')->name('check.otp');
    });
    Route::controller(ResetPasswordController::class)->name('password.')->prefix('password')->group(function () {
        Route::get('/reset-form', 'showResetForm')->name('resetform');
        Route::post('/reset', 'resetPassword')->name('reset');
    });

    // Forget Password Routes inside system
    Route::controller(ForgetPasswordOutsideController::class)->name('password.')->prefix('password')->group(function () {
        Route::get('/forgot-outside', 'showEmailForm')->name('forgot.outside');
        Route::post('/verify-outside', 'getVerficationCode')->name('send.verfication.code.outside');
        Route::get('{email}/otp-form-outside', 'otpForm')->name('otp.form.outside');
        Route::post('/check-otp-outside', 'checkOtp')->name('check.otp.outside');
    });
    Route::controller(ResetPasswordOutsideController::class)->name('password.')->prefix('password')->group(function () {
        Route::get('/reset-form-outside', 'showResetForm')->name('resetform.outside');
        Route::post('/reset-outside', 'resetPassword')->name('reset.outside');
    });


    Route::middleware(['auth:admin'])->group(function () {
        // Welcome Route
        Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

        // Users Routes
        Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all', 'getall')->name('getall');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{id}/show', 'show')->name('show');
            Route::delete('/delete', 'delete')->name('delete');

            Route::get('/trashed', 'trashed')->name('trashed');
            Route::get('/get-all-trashed', 'getAllTrashed')->name('getalltrashed');
            Route::get('/{id}/restore', 'restore')->name('restore');
            Route::delete('/force-delete', 'forceDelete')->name('forceDelete');
        });
        Route::controller(BlockUserController::class)->prefix('users-blocked')->name('users.blocked.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all', 'getall')->name('getall');
            Route::get('/{id}/block', 'block')->name('block');
            Route::get('/{id}/retrieve', 'retrieve')->name('retrieve');
        });

        // Routes Orders for User
        Route::controller(OrderReportController::class)->prefix('users/orders')->name('users.orders.')->group(function () {
            Route::get('/{id}/detail', 'detail')->name('detail');
            Route::get('/{id}/delete', 'delete')->name('delete');
        });

        // Categories Routes
        Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all', 'getAll')->name('getall');
            Route::post('/store', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
            Route::get('/trashed', 'trashed')->name('trashed');
            Route::get('/get-all-trashed', 'getAllTrashed')->name('getall.trashed');
            Route::get('/{id}/restore', 'restore')->name('restore');
            Route::delete('/force-delete', 'forceDelete')->name('forcedelete');
        });
        // Sub Categories Routes
        Route::controller(SubCategoryController::class)->prefix('sub-categories')->name('subcategories.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all', 'getAll')->name('getall');
        });

        // Setting Routes
        Route::controller(SettingController::class)->prefix('settings')->name('settings.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/update/{id}', 'update')->name('update');
        });

        // Mediators Routes
        Route::controller(MediatorController::class)->prefix('mediators')->name('mediators.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all', 'getAll')->name('getall');
            Route::match(['get', 'post'], '/{id}/withdrawals', 'showWithdrawals')->name('withdrawals');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}/update', 'update')->name('update');
            Route::delete('/destroy', 'destroy')->name('destroy');
        });
        Route::controller(MediatorTrashedController::class)->prefix('mediators-trashed')->name('mediators.trashed.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all', 'getAll')->name('getall');

            Route::get('/{id}/restore', 'restore')->name('restore');
            Route::delete('/forceDelete', 'forceDelete')->name('forceDelete');
        });

        // Contacts Route
        Route::controller(ContactController::class)->name('contacts.')->prefix('contacts')->group(function () {
            Route::match(['post', 'get'], '/', 'index')->name('index');
            Route::match(['post', 'get'], '/old', 'old')->name('old');
            Route::get('/{id}/delete', 'delete')->name('delete');
            Route::get('/replay/{contact}', 'replay')->name('replay');
            Route::post('/send-replay', 'sendReplay')->name('send');
            Route::delete('old/delete-all', 'deleteSelected')->name('deleteSelected');

            Route::get('/{id}/show', 'show')->name('show');
        });


        // Charities Routes
        Route::controller(CharityController::class)->name('charities.')->prefix('charities')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all-approved', 'getallApproved')->name('getallApproved');

            Route::get('/wating', 'wating')->name('wating');
            Route::get('/get-all-pending', 'getallPending')->name('getallPending');

            Route::get('/{id}/show', 'show')->name('show');
            Route::delete('/destroy', 'destroy')->name('destroy');

            Route::get('/{id}/accept', 'accept')->name('accept');
            Route::get('/{id}/block', 'block')->name('block');
            Route::get('/{id}/active', 'active')->name('active');
            // Route::get('/{id}/cancel', 'cancel')->name('cancel');

        });
        Route::controller(CharityTrashedController::class)->name('charities.trashed.')->prefix('charities-trashed')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all-trashed', 'getallTrashed')->name('getallTrashed');

            Route::get('/{id}/restore', 'restore')->name('restore');
            Route::delete('/force-delete', 'forceDelete')->name('forcedelete');
        });







        // Stores Routes
        Route::controller(StoreController::class)->name('stores.')->prefix('stores')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all-approved', 'getallApproved')->name('getallApproved');

            Route::get('/wating', 'wating')->name('wating');
            Route::get('/get-all-pending', 'getallPending')->name('getallPending');

            Route::match(['get', 'post'], '/trashed', 'trashed')->name('trashed');
            Route::get('/{id}/restore', 'restore')->name('restore');

            Route::get('/{id}/show', 'show')->name('show');
            Route::delete('/destroy', 'destroy')->name('destroy');
            Route::get('/{id}/force-delete', 'forceDelete')->name('forcedelete');

            Route::get('/{id}/accept', 'accept')->name('accept');

            Route::match(['get', 'post'], '/blocked', 'blocked')->name('blocked');
            Route::get('/{id}/block', 'block')->name('block');
            Route::get('/{id}/active', 'active')->name('active');
        });

        // products Routes
        Route::controller(ProductController::class)->name('products.')->prefix('products')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all', 'getAll')->name('getall');
            Route::get('/{id}/show', 'show')->name('show');
            Route::delete('/destroy', 'destroy')->name('destroy');
        });

         // products Routes
         Route::controller(TrashedProductController::class)->name('products.trashed.')->prefix('products/trashed')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all', 'getAll')->name('getall');
            Route::get('/{id}/restore', 'restore')->name('restore');
            Route::delete('/force-delete', 'forceDelete')->name('forceDelete');
        });


        // Profile Routes
        Route::controller(ProfileController::class)->name('profile.')->prefix('profile')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/update', 'update')->name('update');
        });

        // Withdrawal Routes
        Route::controller(WithdrawalController::class)->name('withdrawal.')->prefix('withdrawal')->group(function () {
            Route::match(['post', 'get'], '/', 'index')->name('index');
            Route::get('/setting', 'setting')->name('setting');
            Route::get('/{id}/show', 'show')->name('show');
        });


        // // Orders Route
        // Route::controller(StoreController::class)->name('orders.')->prefix('orders')->group(function () {
        //     Route::get('/', 'index')->name('index');
        //     Route::get('/{id}/show', 'show')->name('show');
        // });

        // Orders Route
        Route::controller(OrderController::class)->name('orders.')->prefix('orders')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all', 'getall')->name('getall');

            Route::get('/{id}/show', 'show')->name('show');
        });



        //Latest Operations Routes
        Route::controller(LatestOperationController::class)->name('operations.')->prefix('latest-operations')->group(function () {
            Route::get('/', 'index')->name('index');
        });

        //Events Route
        Route::controller(EventController::class)->name('events.')->prefix('events')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all', 'getall')->name('getall');
            Route::get('/calendar', 'calendar')->name('calendar');
            Route::get('/{id}/delete', 'delete')->name('delete');
        });

        //Profits Route
        Route::controller(ProfitController::class)->name('profits.')->prefix('profits')->group(function () {
            Route::get('/daily', 'index')->name('index.daily');
            Route::get('/get-all-daily', 'getAllDaily')->name('getall.daily');

            Route::get('/monthly', 'indexMonthly')->name('index.monthly');
            Route::get('/get-all-monthly', 'getAllMonthly')->name('getall.monthly');
        });

        // Invoices Routes
        Route::controller(InvoiceController::class)->prefix('invoices')->name('invoices.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-all' , 'getAll')->name('getall');
            Route::get('/{id}/show', 'show')->name('show');
            Route::delete('/delete', 'delete')->name('delete');
        });


        // Notifications Routes
        Route::controller(NotificationController::class)->prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}/redirect-to', 'redirectTo')->name('redirectTo');
            Route::get('/{id}/show-all', 'showAll')->name('show');
            Route::get('/{id}/delete', 'delete')->name('delete');
        });



        // Alert Store
        Route::controller(AlertStoreController::class)->prefix('stores/alerts')->name('stores.alerts.')->group(function () {
            Route::get('/{id}/show', 'show')->name('show');
            Route::get('/{id}/delete', 'delete')->name('delete');
        });

    });
});
