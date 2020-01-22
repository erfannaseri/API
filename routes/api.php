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

Route::group(['prefix'=>'/v1'],function (){
    Route::post('/register','Api\AuthController@register');
    route::post('login','Api\AuthController@login');
});

Route::middleware('auth:api')->get('/user', function () {
    return 'gfeg';
});
Route::group(['middleware'=>['auth:api'],'prefix'=>'/v1'], function () {
    Route::get('/users',function (Request $request){
        return $request->user();
    });
});
Route::group(['prefix' => '/v1'],function (){
    Route::apiresource('/products','ProductController');
});

Route::group(['prefix' => 'v1/products'],function (){
   Route::apiresource('/{product}/review','ReviewController');
});
