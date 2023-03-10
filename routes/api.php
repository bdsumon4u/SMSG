<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\PusherController;
use App\Http\Controllers\Api\SMSController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('login/with/qr/code', LoginController::class);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', LogoutController::class);

        Route::controller(SMSController::class)->group(function () {
            Route::match(['get', 'post'], 'message');
            Route::post('message/recieved', 'recieved');
            Route::post('message/update/{id}', 'update');
        });
    });

    Route::post('pusher/auth/{socketID?}/{channelName?}', PusherController::class);
});
