<?php

use App\Http\Controllers\UserStatuses\UserStatusDestroyController;
use App\Http\Controllers\UserStatuses\UserStatusListController;
use App\Http\Controllers\UserStatuses\UserStatusListPaginateController;
use App\Http\Controllers\UserStatuses\UserStatusShowController;
use App\Http\Controllers\UserStatuses\UserStatusStoreController;
use App\Http\Controllers\UserStatuses\UserStatusUpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Api\Shared\Domain\Enums\EnumAbilitySuffix;

/*
|--------------------------------------------------------------------------
| API User Statuses
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'users_statuses/'], function () {

    Route::group(['middleware' => 'auth:sanctum'], function() {

        Route::get('list', [UserStatusListController::class, '__invoke'])->middleware('abilities:user_statuses' . EnumAbilitySuffix::LIST);
        Route::get('list/paginate', [UserStatusListPaginateController::class, '__invoke'])->middleware('abilities:user_statuses' . EnumAbilitySuffix::LIST);
        Route::get('show/{user_status:id}', [UserStatusShowController::class, '__invoke'])->middleware('abilities:user_statuses' . EnumAbilitySuffix::SHOW);
        Route::post('store', [UserStatusStoreController::class, '__invoke'])->middleware('abilities:user_statuses' . EnumAbilitySuffix::STORE);
        Route::put('update/{user_status:id}', [UserStatusUpdateController::class, '__invoke'])->middleware('abilities:user_statuses' . EnumAbilitySuffix::UPDATE);
        Route::delete('delete/{user_status:id}', [UserStatusDestroyController::class, '__invoke'])->middleware('abilities:user_statuses' . EnumAbilitySuffix::DESTROY);

    });

});
