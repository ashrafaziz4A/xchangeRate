<?php

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
Route::group(['middleware' => 'api'], function () {
	Route::post('update', [\App\Http\Controllers\Api\ExchangeRate::class, 'update']);
	Route::post('delete/{id}', [\App\Http\Controllers\Api\ExchangeRate::class, 'destroy']);
	Route::get('get-all/{id}', [\App\Http\Controllers\Api\ExchangeRate::class, 'index']);
});
