<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiKeyController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\AdvertisementController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\SmtpController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\AdminController;

/** Authentication management
 *
 **/
Route::post('login',[LoginController::class,'login']);
/** Weather api management
 *store,update,edit,show
 **/
Route::post('weather-api/store',[ApiKeyController::class,'store']);
Route::get('weather-api/show',[ApiKeyController::class,'show']);
/** Blog  management
 *store,update,edit,show,getdata,fileupload,delete
 **/
Route::post('blog/store',[BlogController::class,'store']);
Route::get('blog/edit/{id}',[BlogController::class,'show']);
Route::patch('blog/update/{id}',[BlogController::class,'update']);
Route::get('blog/get-all',[BlogController::class,'getAll']);
Route::delete('blog/delete/{id}',[BlogController::class,'destroy']);
Route::get('blog/search-data',[BlogController::class,'searchBlog']);
Route::post('blog/file-upload',[BlogController::class,'fileUploader']);
/** admin  management
 *store,update,edit,show
 **/
Route::post('manage-admin/store',[AdminController::class,'store']);
Route::get('manage-admin/show/{id}',[AdminController::class,'show']);
Route::patch('manage-admin/update/{id}',[AdminController::class,'update']);
Route::get('manage-admin/get-admin',[AdminController::class,'allAdmin']);
Route::get('manage-admin/get-super-admin',[AdminController::class,'allSuperAdmin']);
Route::delete('manage-admin/delete/{id}',[AdminController::class,'destroy']);
Route::patch('manage-admin/profile/update',[AdminController::class,'updateProfile']);
Route::patch('manage-admin/profile/change-password',[AdminController::class,'profileChangePassword']);
Route::post('manage-admin/search-data',[AdminController::class,'searchAdmin']);
Route::post('admin/file-upload',[AdminController::class,'fileUploader']);
/** notification  management
 *store,update,edit,show
 **/
Route::post('manage-notification/store',[NotificationController::class,'store']);
Route::get('manage-notification/show',[NotificationController::class,'show']);
Route::get('notification/get-all',[NotificationController::class,'getAll']);
Route::delete('notification/delete/{id}',[NotificationController::class,'destroy']);
Route::post('notification/send-notification',[NotificationController::class,'sendNotification']);
Route::post('notification/file-upload',[NotificationController::class,'fileUploader']);
/** setting  management
 *store,update,edit,show
 **/
Route::post('setting/store',[SettingsController::class,'store']);
Route::get('setting/show',[SettingsController::class,'show']);
Route::post('setting/file-upload',[SettingsController::class,'fileUploader']);
/** Smtp  management
 *store,update,edit,show
 **/
Route::post('smtp/store',[SmtpController::class,'store']);
Route::get('smtp/show',[SmtpController::class,'show']);
/** User Recoveery password  management
 *store,update,edit,show
 **/
Route::post('user/forgot-password', [ResetPasswordController::class, "forgotPassword"]);
Route::post('user/user-verify', [ResetPasswordController::class, "UserVerify"]);
Route::post('user/resend-code', [ResetPasswordController::class, "resendCode"]);
Route::post('user/change-password', [ResetPasswordController::class, "changePassword"]);
/** Advertisement   management
 *store,update
 **/
Route::post('advertisement/store',[AdvertisementController::class,'store']);
