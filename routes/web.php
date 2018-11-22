<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('rela','MyController@relationship');
Route::get('rela2','MyController@relationship');

// Route::post('login',['as'=>'login','uses'=>'MyController@submit_login']);
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/logout','MyController@logout');

Route::get('login','LoginController@login');
// Route::post('xulylogin',['as'=>'login','uses'=>'LoginController@submit_login']);
Route::post('login',['as'=>'login','uses'=>'LoginController@submit_login']);

// Route::get('regis','LoginController@login');
Route::get('/regis', 'RegistrationController@regis')->name('regis');
Route::post('xulyregis',['as'=>'regis','uses'=>'RegistrationController@submit_regis']);

Route::get('/change', 'ChangePasswordController@change')->name('change');
Route::post('change',['as'=>'change','uses'=>'ChangePasswordController@submit_change']);