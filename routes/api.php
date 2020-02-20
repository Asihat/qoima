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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registeruser', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::post('/forgotpassword', 'UserController@forgotpassword');
Route::get('/userinfo', 'UserController@userinfo');
Route::post('/updateuser', 'UserController@updateuser');
Route::post('/changepassword', 'UserController@changepassword');
Route::post('/changeaddress', 'UserController@changeaddress');

Route::get('/listofitems', 'ItemController@listofitems');
Route::post('/bringitems', 'ItemController@bringitems');

Route::get('/listofstores', 'QoimaController@listofstores');
Route::get('/getinfoqoima', 'QoimaController@getinfoqoima');







