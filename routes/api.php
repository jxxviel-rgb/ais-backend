<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login', LoginController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'vessel-type'], function() {
        Route::post('/', \App\Http\Controllers\Api\Vessels\CreateVesselType::class);
        Route::get('/', \App\Http\Controllers\Api\Vessels\GetVesselTypes::class);
        Route::get('/{id}', \App\Http\Controllers\Api\Vessels\GetVesselTypeById::class);
        Route::put('/{id}', \App\Http\Controllers\Api\Vessels\UpdateVesselType::class);
        Route::delete('/{id}', \App\Http\Controllers\Api\Vessels\DeleteVesselType::class);
    });

    Route::group(['prefix' => 'fisherman'], function() {
        Route::post('/', \App\Http\Controllers\Api\Fisherman\CreateFisherman::class);
        Route::get('/', \App\Http\Controllers\Api\Fisherman\GetFisherman::class);
        Route::get('/{id}', \App\Http\Controllers\Api\Fisherman\GetFishermanById::class);
        Route::put('/{id}', \App\Http\Controllers\Api\Fisherman\UpdateFisherman::class);
        Route::delete('/{id}', \App\Http\Controllers\Api\Fisherman\DeleteFisherman::class);
    });

    Route::group(['prefix' => 'vessels'], function() {
        Route::post('/', \App\Http\Controllers\Api\Vessel\CreateVessel::class);
        Route::get('/', \App\Http\Controllers\Api\Vessel\GetVessel::class);
        Route::get('/{id}', \App\Http\Controllers\Api\Vessel\GetVesselById::class);
        Route::put('/{id}', \App\Http\Controllers\Api\Vessel\UpdateVessel::class);
        Route::delete('/{id}', \App\Http\Controllers\Api\Vessel\DeleteVessel::class);
    });
});
