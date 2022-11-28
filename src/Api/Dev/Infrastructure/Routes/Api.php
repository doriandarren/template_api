<?php

use Illuminate\Support\Facades\Route;
use Src\Api\Dev\Infrastructure\Controllers\TestController;


Route::get('/', [TestController::class, '__invoke']);
