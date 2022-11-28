<?php


use App\Http\Controllers\AbilityUsers\AbilityUserDestroyController;
use App\Http\Controllers\AbilityUsers\AbilityUserListController;
use App\Http\Controllers\AbilityUsers\AbilityUserListPaginateController;
use App\Http\Controllers\AbilityUsers\AbilityUserShowController;
use App\Http\Controllers\AbilityUsers\AbilityUserStoreController;
use App\Http\Controllers\AbilityUsers\AbilityUserUpdateController;
use Illuminate\Support\Facades\Route;
use Src\Api\Shared\Domain\Enums\EnumAbilitySuffix;

/*
|--------------------------------------------------------------------------
| API Roles
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'ability_users/'], function () {

    Route::group(['middleware' => 'auth:sanctum'], function() {

        Route::get('list', [AbilityUserListController::class, '__invoke'])->middleware('abilities:ability_users' . EnumAbilitySuffix::LIST);
        Route::get('list/paginate', [AbilityUserListPaginateController::class, '__invoke'])->middleware('abilities:ability_users' . EnumAbilitySuffix::LIST);
        Route::get('show/{ability_user:id}', [AbilityUserShowController::class, '__invoke'])->middleware('abilities:ability_users' . EnumAbilitySuffix::SHOW);
        Route::post('store', [AbilityUserStoreController::class, '__invoke'])->middleware('abilities:ability_users' . EnumAbilitySuffix::STORE);
        Route::put('update/{ability_user:id}', [AbilityUserUpdateController::class, '__invoke'])->middleware('abilities:ability_users' . EnumAbilitySuffix::UPDATE);
        Route::delete('delete/{ability_user:id}', [AbilityUserDestroyController::class, '__invoke'])->middleware('abilities:ability_users' . EnumAbilitySuffix::DESTROY);


    });

});
