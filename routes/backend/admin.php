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
    Route::post('subPackages_mass_destroy', ['uses' => 'Admin\TeachersController@massDestroy', 'as' => 'teachers.mass_destroy']);
    Route::post('subPackages_restore/{id}', ['uses' => 'Admin\TeachersController@restore', 'as' => 'teachers.restore']);
    Route::delete('subPackages_perma_del/{id}', ['uses' => 'Admin\TeachersController@perma_del', 'as' => 'teachers.perma_del']);
       


});
//===== User Account Routes =====//
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::get('account', [AccountController::class, 'index'])->name('account');
    Route::patch('account/{email?}', [UserPasswordController::class, 'update'])->name('account.post');
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});