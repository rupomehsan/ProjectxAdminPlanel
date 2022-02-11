<?php
use Illuminate\Support\Facades\Route;
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
Route::prefix("installation")->group(function () {
    Route::view('/', 'installation.installer');
    Route::post('/env-update', [\App\Http\Controllers\InstallerController::class, "envUpdate"]);
    Route::post('/db-check', [\App\Http\Controllers\InstallerController::class, "dbCheck"]);
    Route::post('/finished', [\App\Http\Controllers\InstallerController::class, "finished"]);
    Route::post('/license-checker', [\App\Http\Controllers\InstallerController::class, "licenseChecker"]);
});
Route::group(['middleware' => 'installationCheck'], function () {
Route::redirect('/', 'admin/dashboard', 301);
Route::prefix('admin')->group(function(){

    Route::view('dashboard', 'admin.dashboard.index');
    /** user management
     **/
    Route::view('users', 'admin.user.index');
    /** subscription management
     **/
    Route::view('subscription', 'admin.subscription.index');
    /** Weather api management
     **/
    Route::view('weather-api', 'admin.weatherApi.create');
    /** Blog management
     **/
    Route::view('blog', 'admin.blog.index');
    Route::view('blog/create', 'admin.blog.create');
    /** administration management
     **/
    Route::view('manage-admin', 'admin.administration.index');
    Route::view('manage-admin/create', 'admin.administration.create');
    Route::view('manage-admin/profile', 'admin.administration.profile');
    Route::view('manage-admin/change-password', 'admin.administration.change_password');
    Route::view('manage-admin/edit/{id}', 'admin.administration.edit');
    /** advertisement management
     **/
//    Route::view('advertisement', 'admin.advertisement.create');
    Route::get('advertisement', [\App\Http\Controllers\Api\AdvertisementController::class,"mobileAd"]);
    /** Notification management
     **/
    Route::view('notification', 'admin.notification.index');
    Route::view('notification/create', 'admin.notification.create');
    Route::view('notification/manage-notification', 'admin.notification.manage_notification');
    /** settings management
     **/
    Route::view('setting', 'admin.settings.create');
    /** Smtp management
     **/
    Route::view('smtp', 'admin.smtp.create');
});
});
Route::view('login', 'admin.auth.login');
Route::view('forgot-password', 'admin.auth.forgot_password');
