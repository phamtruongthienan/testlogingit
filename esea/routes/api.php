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

Route::group(['middleware' => 'api', 'throttle:60,1'], function () {
    Route::get('/get/test', 'Helper\Front\Helper@getSchoolDetail')->name('api.get.city');
    Route::get('/get/city', 'Api\ApiController@api_get_city')->name('api.get.city');
    Route::post('/subscribe', 'Api\ApiController@api_post_subscribe')->name('api.post.subscribe');
    Route::post('/map', 'Api\ApiController@api_post_map')->name('api.post.map');
    Route::post('/map/other/{location?}', 'Api\ApiController@api_post_map_other')->name('api.post.map.other');
    Route::post('/map/get/{id?}', 'Api\ApiController@api_post_map_get')->name('api.post.map.get');
});
