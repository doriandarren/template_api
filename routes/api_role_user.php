<?php

use App\Http\Controllers\RoleUsers\RoleUserDestroyController;
use App\Http\Controllers\RoleUsers\RoleUserListController;
use App\Http\Controllers\RoleUsers\RoleUserListPaginateController;
use App\Http\Controllers\RoleUsers\RoleUserShowController;
use App\Http\Controllers\RoleUsers\RoleUserStoreController;
use App\Http\Controllers\RoleUsers\RoleUserUpdateController;
use Illuminate\Support\Facades\Route;
use Src\Api\Shared\Domain\Enums\EnumAbilitySuffix;

/*
|--------------------------------------------------------------------------
| API Roles
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'role_users/'], function () {

    Route::group(['middleware' => 'auth:sanctum'], function() {

        Route::get('list', [RoleUserListController::class, '__invoke'])->middleware('abilities:role_users' . EnumAbilitySuffix::LIST);
        Route::get('list/paginate', [RoleUserListPaginateController::class, '__invoke'])->middleware('abilities:role_users' . EnumAbilitySuffix::LIST);
        Route::get('show/{role_user:id}', [RoleUserShowController::class, '__invoke'])->middleware('abilities:role_users' . EnumAbilitySuffix::SHOW);
        Route::post('store', [RoleUserStoreController::class, '__invoke'])->middleware('abilities:role_users' . EnumAbilitySuffix::STORE);
        Route::put('update/{role_user:id}', [RoleUserUpdateController::class, '__invoke'])->middleware('abilities:role_users' . EnumAbilitySuffix::UPDATE);
        Route::delete('delete/{role_user:id}', [RoleUserDestroyController::class, '__invoke'])->middleware('abilities:role_users' . EnumAbilitySuffix::DESTROY);


    });

});
