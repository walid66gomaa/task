<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\SubPackageItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');



    Route::get('subscripe', [SubPackageItemController::class, 'index'])->name('auth.subscripe');
    Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {

        /*
        * These routes require the user to be logged in
        */
        Route::group(['middleware' => 'auth'], function () {
            Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        

    Route::post('subscripe/{slug}', [SubPackageItemController::class, 'show'])->name('subscripe.selecte');
    Route::post('subPackages/stripe-payment', [SubPackageItemController::class, 'stripePayment'])->name('subPackages.stripe.payment');

     Route::post('subPackages/paypal-payment', ['uses' => 'SubPackageItemController@paypalPayment', 'as' => 'subPackages.paypal.payment']);
    Route::post('subPackages/paypal-payment/status', ['uses' => 'SubPackageItemController@getPaymentStatus'])->name('subPackages.paypal.status');

        
        
        
        });
    
     
    

        /*
         * These routes require no user to be logged in
         */
        Route::group(['middleware' => 'guest'], function () {
            // Authentication Routes
            Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
            Route::post('login', [LoginController::class, 'login'])->name('login.post');
    
            // Registration Routes
            if (config('access.registration')) {
                Route::get('register', [LoginController::class, 'showLoginForm'])->name('register');
                Route::post('register', [RegisterController::class, 'register'])->name('register.post');
            }
    
            // Password Reset Routes
            Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.email');
            Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email.post');
    
            Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
            Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
    
        });
    });
});


/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'user', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     * These routes can not be hit if the password is expired
     */
    include_route_files(__DIR__ . '/backend/');
});

