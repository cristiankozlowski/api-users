<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthUserController;

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

Route::group(['as' => 'api.'], function () {

    Route::group(['prefix' => 'v1'], function () {

        Route::post('/auth', [AuthUserController::class, 'auth'])->name('auth');

        Route::middleware('auth:sanctum')->group(function () {

            Route::get('/auth/me', [AuthUserController::class, 'me'])->name('auth.me');
            Route::delete('/auth/logout', [AuthUserController::class, 'logout'])->name('auth.logout');

            Route::get('/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
            Route::get('/users/restore/{uuid}', [UserController::class, 'restore'])->name('users.restore');
            Route::apiResource('/users', UserController::class);
        });
    });
});
