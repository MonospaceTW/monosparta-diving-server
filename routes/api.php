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


/*==========Search API Route==========*/
Route::get("spot/", "TaskController@spotIndex");
Route::get("spot/search/", "TaskController@spotSearch");
Route::get("spot/{spot_id}", "TaskController@spotInfo");
Route::get("shop/", "TaskController@shopIndex");
Route::get("shop/search/","TaskController@shopSearch");
Route::get("shop/{shop_id}", "TaskController@shopInfo");
/*==========Search API Route end==========*/

/*==========comment API Route ==========*/
Route::post("comment", "TaskController@addComment");
/*==========comment API Route ==========*/

Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});
