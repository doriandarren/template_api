<?php

use App\Http\Controllers\Users\UserDestroyController;
use App\Http\Controllers\Users\UserListController;
use App\Http\Controllers\Users\UserListPaginateController;
use App\Http\Controllers\Users\UserShowController;
use App\Http\Controllers\Users\UserStoreController;
use App\Http\Controllers\Users\UserUpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Api\Shared\Domain\Enums\EnumAbilitySuffix;

/*
|--------------------------------------------------------------------------
| API Auth
|--------------------------------------------------------------------------
|
*/


/**
 * AUTH
 */



Route::group(['prefix' => 'users/'], function () {

    Route::group(['middleware' => 'auth:sanctum'], function() {

        Route::get('list', [UserListController::class, '__invoke'])->middleware('abilities:users' . EnumAbilitySuffix::LIST);
        Route::get('list/paginate', [UserListPaginateController::class, '__invoke'])->middleware('abilities:users' . EnumAbilitySuffix::LIST);
        Route::get('show/{user:id}', [UserShowController::class, '__invoke'])->middleware('abilities:users' . EnumAbilitySuffix::SHOW);
        Route::post('store', [UserStoreController::class, '__invoke'])->middleware('abilities:users' . EnumAbilitySuffix::STORE);
        Route::put('update/{user:id}', [UserUpdateController::class, '__invoke'])->middleware('abilities:users' . EnumAbilitySuffix::UPDATE);
        Route::delete('delete/{user:id}', [UserDestroyController::class, '__invoke'])->middleware('abilities:users' . EnumAbilitySuffix::DESTROY);

    });

});
