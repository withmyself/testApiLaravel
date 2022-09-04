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

Route::get('street', 'App\Http\Controllers\Streets\StreetController@street');
Route::get('street/{id}', 'App\Http\Controllers\Streets\StreetController@streetById');

Route::post('street', 'App\Http\Controllers\Streets\StreetController@streetCreate');

Route::put('street/{id}', 'App\Http\Controllers\Streets\StreetController@streetEdit');

Route::delete('street/{id}', 'App\Http\Controllers\Streets\StreetController@streetDelete');