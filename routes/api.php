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

Route::post('/registeruser', 'UserController@register'); // TODO done
Route::post('/login', 'UserController@login'); // TODO done
Route::post('/forgotpassword', 'UserController@forgotpassword'); // TODO
Route::post('/userinfo', 'UserController@userinfo'); // TODO done
Route::post('/updateuser', 'UserController@updateuser'); // TODO  done
Route::post('/changepassword', 'UserController@changepassword'); // TODO done
Route::post('/changeaddress', 'UserController@changeaddress'); // TODO

Route::post('/listofitems', 'ItemController@listofitems'); // TODO done
Route::post('/bringitems', 'ItemController@bringitems'); // TODO

Route::post('/listofstores', 'QoimaController@listofstores'); // TODO
Route::post('/getinfoqoima', 'QoimaController@getinfoqoima'); // TODO







