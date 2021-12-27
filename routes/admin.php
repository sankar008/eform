<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\AboutUsController;
use App\Http\Controllers\admin\ForgotPasswordController;

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

Route::get('/', function () {
    return view('admin.login');
});
Route::prefix('/admin')-> group(function(){
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/forgot-password',[ForgotPasswordController::class, 'forgotPasswordForm']);
    Route::post('/forgot-password-verificationcode',[ForgotPasswordController::class, 'send_verification_code']);
    Route::get('/verify-code', [ForgotPasswordController::class, 'verify_code']);
    Route::post('/verify-code',[ForgotPasswordController::class, 'Check_verification_code']);
    Route::get('/reset-password', [ForgotPasswordController::class, 'reset_password']);
    Route::post('/reset-email-password', [ForgotPasswordController::class, 'reset_password']);


    Route::get('/company',[CompanyController::class,'list']);
    Route::get('/company/upate/{id}',[CompanyController::class,'update']);
    Route::post('/company/update',[CompanyController::class,'update']);

    Route::get('/company/about-us',[AboutUsController::class,'aboutUsUpdate']);
    Route::get('/company/about-us/update/{id}',[AboutUsController::class,'update']);
    Route::post('/company/about-us/update',[AboutUsController::class,'update']);





    

});    