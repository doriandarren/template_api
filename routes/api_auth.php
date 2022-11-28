<?php

use App\Http\Controllers\Auth\AuthLoginController;
use App\Http\Controllers\Auth\AuthLogoutController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\PasswordResets\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordResets\RestorePasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Auth
|--------------------------------------------------------------------------
|
*/


/**
 * AUTH
 */

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', [AuthLoginController::class, '__invoke']);
    //Route::post('register', [AuthController::class, 'register']);


    //Password Reset
    Route::post('password/email', [ForgotPasswordController::class, '__invoke']);
    Route::post('password/restore', [RestorePasswordController::class, '__invoke']);




    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('logout', [AuthLogoutController::class, '__invoke']);
        Route::get('user', [AuthUserController::class, '__invoke']);
    });
});
