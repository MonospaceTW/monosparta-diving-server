<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TaskController;

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
Route::get("spot/random/", "TaskController@spotRandom");
Route::get("spot/", "TaskController@spotIndex");
Route::get("spot/search/", "TaskController@spotSearch");
Route::get("spot/{id}", "TaskController@spotInfo");
Route::get("shop/random/", "TaskController@shopRandom");
Route::get("shop/", "TaskController@shopIndex");
Route::get("shop/search/","TaskController@shopSearch");
Route::get("shop/{id}", "TaskController@shopInfo");
Route::get("keyword/{keyword}","TaskController@keywordSearch");
/*==========Search API Route end==========*/

/*==========Article API Route==========*/
Route::get("article/","TaskController@articleIndex");
Route::get("article/random/", "TaskController@articleRandom");
Route::get("article/category/{category}","TaskController@articleCategory");
Route::get("article/{id}","TaskController@articleInfo");
/*==========Article API Route end==========*/

/*==========comment API Route ==========*/
Route::post("comment/", "CommentController@create");
Route::get("comment/delete/{id}", "CommentController@destroy");
/*==========comment API Route ==========*/

Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});
