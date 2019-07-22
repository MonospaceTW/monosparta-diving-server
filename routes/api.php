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

/*Search API Route*/
Route::get("sites/", "TaskController@spotIndex");
Route::get("sites/search/", "TaskController@search");
Route::get("sites/{spot_id}", "TaskController@spotInfo");
Route::get("shops/", "TaskController@shopIndex");
Route::get("shops/search/","TaskController@searchShop");
Route::get("shops/{shop_id}", "TaskController@shopInfo");

Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});
