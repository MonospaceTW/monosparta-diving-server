<?php

use Illuminate\Http\Request;

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

Route::get("sites/", "TaskController@index");
Route::get("sites/search/{pram}", "TaskController@search");
Route::get("sites/multiSearch/", "TaskController@multiSearch");
Route::get("sites/{spot_id}", "TaskController@spotInfo");
Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});
// location=${location}&level=${level}