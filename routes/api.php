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
    Route::get('/dashboard', \App\Http\Controllers\Api\Dashboard\GetDataDashboard::class);


    Route::get('/dashboard', \App\Http\Controllers\Api\Dashboard\GetDataDashboard::class);

    Route::group(['prefix' => 'company'], function () {
        Route::get('/', \App\Http\Controllers\Api\Company\GetCompany::class);
        Route::get('/{id}', \App\Http\Controllers\Api\Company\GetCompanyById::class);
        Route::get('/self', \App\Http\Controllers\Api\Company\GetCompanySelf::class);
        Route::post('/', \App\Http\Controllers\Api\Company\CreateCompany::class);
        Route::put('/{id}', \App\Http\Controllers\Api\Company\UpdateCompany::class);
        Route::delete('/{id}', \App\Http\Controllers\Api\Company\DeleteCompany::class);
    });
    Route::group(['prefix' => 'crew'], function () {
        Route::get('/', \App\Http\Controllers\Api\Crew\GetCrew::class);
        Route::get('/{id}', \App\Http\Controllers\Api\Crew\GetCrewById::class);
        Route::get('/activity/{id}', \App\Http\Controllers\Api\Crew\GetCrewByCompanyId::class);
        Route::post('/activity', \App\Http\Controllers\Api\Crew\AddCrewDeparture::class);
        Route::delete('/activity/{id}', \App\Http\Controllers\Api\Crew\DeleteCrewDeparture::class);
        Route::post('/', \App\Http\Controllers\Api\Crew\CreateCrew::class);
        Route::put('/{id}', \App\Http\Controllers\Api\Crew\UpdateCrew::class);
        Route::delete('/{id}', \App\Http\Controllers\Api\Crew\DeleteCrew::class);
        Route::get('/company/{id}', \App\Http\Controllers\Api\Crew\GetCrewByCompany::class);
    });

    Route::group(['prefix' => 'pelabuhan'], function () {
        Route::get('/', \App\Http\Controllers\Api\Pelabuhan\GetPelabuhan::class);
        Route::get('/{id}', \App\Http\Controllers\Api\Pelabuhan\GetPelabuhanById::class);
        Route::post('/', \App\Http\Controllers\Api\Pelabuhan\CreatePelabuhan::class);
        Route::put('/{id}', \App\Http\Controllers\Api\Pelabuhan\UpdatePelabuhan::class);
        Route::delete('/{id}', \App\Http\Controllers\Api\Pelabuhan\DeletePelabuhan::class);
    });

    Route::group(['prefix' => 'vessel'], function () {
        Route::get('/{id}/position', [\App\Http\Controllers\Api\PositionController::class, 'vesselPosition'])->withoutMiddleware("auth:sanctum")->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$');
        Route::get('/position', [\App\Http\Controllers\Api\PositionController::class, 'index'])->withoutMiddleware("auth:sanctum");

        Route::get('/search', [\App\Http\Controllers\Api\PositionController::class, 'search'])->withoutMiddleware("auth:sanctum");
        Route::get('/{id}/positions', [\App\Http\Controllers\Api\PositionController::class, 'show'])->withoutMiddleware("auth:sanctum");
        Route::group(['prefix' => 'type'], function () {
            Route::get('/', \App\Http\Controllers\Api\Type\GetTypeController::class);
            Route::post('/', \App\Http\Controllers\Api\Type\CreateTypeController::class);
            Route::put('/{id}', \App\Http\Controllers\Api\Type\UpdateTypeController::class);
        });

        Route::group(['prefix' => 'vessel', 'middleware' => 'cors'], function () {
            Route::get('/', \App\Http\Controllers\Api\Vessel\GetVessel::class);
            Route::get('/company/{id}', \App\Http\Controllers\Api\Vessel\GetVessel::class);
            Route::get('/{id}', \App\Http\Controllers\Api\Vessel\GetVesselById::class);
            Route::post('/', \App\Http\Controllers\Api\Vessel\CreateVessel::class);
            Route::put('/{id}', \App\Http\Controllers\Api\Vessel\UpdateVessel::class);
            Route::delete('/{id}', \App\Http\Controllers\Api\Vessel\DeleteVessel::class);
        });

        Route::group(['prefix' => 'activity'], function () {
            Route::get('/', \App\Http\Controllers\Api\Activity\GetActivity::class);
            Route::get('/{id?}', \App\Http\Controllers\Api\Activity\GetActivity::class);
            Route::post('/', \App\Http\Controllers\Api\Activity\CreateActivity::class);
            Route::put('/{id}', \App\Http\Controllers\Api\Activity\UpdateActivity::class);
            Route::post('/{id}/berth', \App\Http\Controllers\Api\Activity\BerthActivityController::class);
        });

        Route::group(['prefix' => 'owner'], function () {
            Route::get('/', \App\Http\Controllers\Api\Owner\GetOwner::class);
            Route::get('/{id?}', \App\Http\Controllers\Api\Owner\GetOwnerById::class);
            Route::post('/', \App\Http\Controllers\Api\Owner\CreateOwner::class);
            Route::put('/{id?}', \App\Http\Controllers\Api\Owner\UpdateOwner::class);
        });
        Route::group(['prefix' => 'activity'], function () {
            Route::get('/', \App\Http\Controllers\Api\Activity\GetActivity::class);
            Route::get('/{id?}', \App\Http\Controllers\Api\Activity\GetActivity::class);
            Route::post('/', \App\Http\Controllers\Api\Activity\CreateActivity::class);
            Route::put('/{id}', \App\Http\Controllers\Api\Activity\UpdateActivity::class);
            Route::post('/{id}/berth', \App\Http\Controllers\Api\Activity\BerthActivityController::class);
        });

        Route::group(['prefix' => 'type'], function () {
            Route::get('/', \App\Http\Controllers\Api\Type\GetTypeController::class);
            Route::post('/', \App\Http\Controllers\Api\Type\CreateTypeController::class);
            Route::put('/{id}', \App\Http\Controllers\Api\Type\UpdateTypeController::class);
        });
    });
});
