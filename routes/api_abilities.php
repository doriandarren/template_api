<?php


use App\Http\Controllers\Abilities\AbilityDestroyController;
use App\Http\Controllers\Abilities\AbilityListController;
use App\Http\Controllers\Abilities\AbilityListPaginateController;
use App\Http\Controllers\Abilities\AbilityShowController;
use App\Http\Controllers\Abilities\AbilityStoreController;
use App\Http\Controllers\Abilities\AbilityUpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Api\Shared\Domain\Enums\EnumAbilitySuffix;

/*
|--------------------------------------------------------------------------
| API Roles
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'abilities/'], function () {

    Route::group(['middleware' => 'auth:sanctum'], function() {

        Route::get('list', [AbilityListController::class, '__invoke'])->middleware('abilities:abilities' . EnumAbilitySuffix::LIST);
        Route::get('list/paginate', [AbilityListPaginateController::class, '__invoke'])->middleware('abilities:abilities' . EnumAbilitySuffix::LIST);
        Route::get('show/{ability:id}', [AbilityShowController::class, '__invoke'])->middleware('abilities:abilities' . EnumAbilitySuffix::SHOW);
        Route::post('store', [AbilityStoreController::class, '__invoke'])->middleware('abilities:abilities' . EnumAbilitySuffix::STORE);
        Route::put('update/{ability:id}', [AbilityUpdateController::class, '__invoke'])->middleware('abilities:abilities' . EnumAbilitySuffix::UPDATE);
        Route::delete('delete/{ability:id}', [AbilityDestroyController::class, '__invoke'])->middleware('abilities:abilities' . EnumAbilitySuffix::DESTROY);


    });

});
