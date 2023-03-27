<?php

use App\Http\Controllers\API\v1\MenuController;
use App\Http\Controllers\API\v1\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'SetLocale'], function() {
    Route::group([
        'prefix' => 'v1'
    ], function () {
        Route::group([
            'prefix' => 'users'
        ], function () {
            Route::post('register', [UsersController::class, 'register']);
            Route::post('login', [UsersController::class, 'login']);
            Route::get('profile', [UsersController::class, 'profile']);
            Route::post('logout', [UsersController::class, 'logout']);
        });
        Route::group([
            'prefix' => 'menu'
        ], function () {
            Route::get('/', [MenuController::class, 'index']);
            Route::post('create', [MenuController::class, 'create']);
            Route::put('update/{id}', [MenuController::class, 'update']);
            Route::delete('delete/{id}', [MenuController::class, 'delete']);
        });
    });
});
