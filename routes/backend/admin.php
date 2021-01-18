<?php

use App\Http\Controllers\Backend\DashboardController;

/*
 * All route names are prefixed with 'admin.'.
 */

//===== General Routes =====//
Route::redirect('/', '/user/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::group(['middleware' => 'role:administrator'], function () {

    //===== subPackages Routes =====//
    Route::resource('subPackages', 'SubscripPackageController');
    Route::get('get-subPackages-data', ['uses' => 'SubscripPackageController@getData', 'as' => 'subPackages.get_data']);  


});
