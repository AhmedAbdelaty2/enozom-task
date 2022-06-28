<?php

use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\HolidayController;
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

Route::get('sync-countries',[CountryController::class,'syncCountries']);
Route::get('countries/{perPage}/{currentPage}',[CountryController::class,'getAllCountries']);

Route::get('sync-holidays/{countryId}',[HolidayController::class,'syncHolidays']);
Route::get('holidays/{id}',[HolidayController::class,'getHolidays']);
Route::post('holidays',[HolidayController::class,'store']);
Route::delete('holidays/{id}',[HolidayController::class,'destroy']);
Route::put('holidays',[HolidayController::class,'update']);

