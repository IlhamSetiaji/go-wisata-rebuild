<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\UserController;
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

Route::post('roles', [UserController::class, 'fetchRoles']);
Route::post('fetch-districts', [AddressController::class, 'fetchDistrictsByProvinceId']);
Route::post('fetch-sub-districts', [AddressController::class, 'fetchSubDistrictsByDistrictId']);
Route::post('fetch-villages', [AddressController::class, 'fetchVillagesBySubDistrictId']);
