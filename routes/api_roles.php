<?php

use App\Http\Controllers\Roles\RoleDestroyController;
use App\Http\Controllers\Roles\RoleListController;
use App\Http\Controllers\Roles\RoleListPaginateController;
use App\Http\Controllers\Roles\RoleShowController;
use App\Http\Controllers\Roles\RoleStoreController;
use App\Http\Controllers\Roles\RoleUpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Api\Shared\Domain\Enums\EnumAbilitySuffix;

/*
|--------------------------------------------------------------------------
| API Roles
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'roles/'], function () {

    Route::group(['middleware' => 'auth:sanctum'], function() {

        Route::get('list', [RoleListController::class, '__invoke'])->middleware('abilities:roles' . EnumAbilitySuffix::LIST);
        Route::get('list/paginate', [RoleListPaginateController::class, '__invoke'])->middleware('abilities:roles' . EnumAbilitySuffix::LIST);
        Route::get('show/{role:id}', [RoleShowController::class, '__invoke'])->middleware('abilities:roles' . EnumAbilitySuffix::SHOW);
        Route::post('store', [RoleStoreController::class, '__invoke'])->middleware('abilities:roles' . EnumAbilitySuffix::STORE);
        Route::put('update/{role:id}', [RoleUpdateController::class, '__invoke'])->middleware('abilities:roles' . EnumAbilitySuffix::UPDATE);
        Route::delete('delete/{role:id}', [RoleDestroyController::class, '__invoke'])->middleware('abilities:roles' . EnumAbilitySuffix::DESTROY);

    });

});
