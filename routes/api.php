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

    Route::group(['prefix' => 'company'], function (){
        Route::get('/', \App\Http\Controllers\Api\Company\GetCompany::class);
        Route::get('/{id}', \App\Http\Controllers\Api\Company\GetCompanyById::class);
        Route::post('/', \App\Http\Controllers\Api\Company\CreateCompany::class);
        Route::put('/{id}', \App\Http\Controllers\Api\Company\UpdateCompany::class);
        Route::delete('/{id}', \App\Http\Controllers\Api\Company\DeleteCompany::class);
        
    });
    Route::group(['prefix' => 'crew'], function (){
        Route::get('/', \App\Http\Controllers\Api\Crew\GetCrew::class);
        Route::get('/{id}', \App\Http\Controllers\Api\Crew\GetCrewById::class);
        Route::post('/', \App\Http\Controllers\Api\Crew\CreateCrew::class);
        Route::put('/{id}', \App\Http\Controllers\Api\Crew\UpdateCrew::class);
        Route::delete('/{id}', \App\Http\Controllers\Api\Crew\DeleteCrew::class);
        
    });

    Route::group(['prefix' => 'pelabuhan'], function (){
        Route::get('/', \App\Http\Controllers\Api\Pelabuhan\GetPelabuhan::class);
        Route::get('/{id}', \App\Http\Controllers\Api\Pelabuhan\GetPelabuhanById::class);
        Route::post('/', \App\Http\Controllers\Api\Pelabuhan\CreatePelabuhan::class);
        Route::put('/{id}', \App\Http\Controllers\Api\Pelabuhan\UpdatePelabuhan::class);
        Route::delete('/{id}', \App\Http\Controllers\Api\Pelabuhan\DeletePelabuhan::class);
        
    });

    Route::group(['prefix' => 'vessel'], function (){
        Route::get('/', \App\Http\Controllers\Api\Vessel\GetVessel::class);
        Route::get('/{id}', \App\Http\Controllers\Api\Vessel\GetVesselById::class);
        Route::post('/', \App\Http\Controllers\Api\Vessel\CreateVessel::class);
        Route::put('/{id}', \App\Http\Controllers\Api\Vessel\UpdateVessel::class);
        Route::delete('/{id}', \App\Http\Controllers\Api\Vessel\DeleteVessel::class);
        
    });



});
