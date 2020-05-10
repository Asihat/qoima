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

Route::post('/additem', 'ItemController@additem');
Route::post('/listofitems', 'ItemController@listofitems'); // TODO done
Route::post('/getiteminfo', 'ItemController@getiteminfo'); // TODO
Route::post('/bringitems', 'ItemController@bringitems'); // TODO done
Route::post('/planitem', 'ItemController@planitem'); // TODO
Route::post('/deliveritem', 'ItemController@deliveritem'); // TODO
Route::post('/listofstores', 'QoimaController@listofstores'); // TODO done
Route::post('/getinfoqoima', 'QoimaController@getinfoqoima'); // TODO done

Route::get('image/{filename}', 'ImageController@displayImage')->name('image.displayImage');



Route::post('/admin/signin', 'AdminController@signin');
Route::get('/admin/get/me', 'AdminController@getMe');
Route::post('/admin/get/listofitems', 'AdminController@listofitems');
Route::post('/admin/get/item', 'AdminController@item');
Route::post('/admin/update/item', 'AdminController@updateitem');
Route::post('/admin/delete/item', 'AdminController@deleteitem');
Route::get('/admin/total/sum', 'AdminController@totalsum');
Route::post('/admin/change/name', 'AdminController@changename');
