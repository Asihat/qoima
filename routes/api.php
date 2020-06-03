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
Route::post('/userinfo', 'UserController@userinfo');
Route::post('/updateuser', 'UserController@updateuser');
Route::post('/changepassword', 'UserController@changepassword');
Route::post('/changeaddress', 'UserController@changeaddress');

Route::post('/additem', 'ItemController@additem');
Route::post('/listofitems', 'ItemController@listofitems');
Route::post('/getiteminfo', 'ItemController@getiteminfo');
Route::post('/bringitems', 'ItemController@bringitems');
Route::post('/planitem', 'ItemController@planitem');
Route::post('/deliveritem', 'ItemController@deliveritem');
Route::post('/listofstores', 'QoimaController@listofstores');
Route::post('/getinfoqoima', 'QoimaController@getinfoqoima');

Route::get('image/{filename}', 'ImageController@displayImage')->name('image.displayImage');

Route::post('/user/notifications', 'NotificationController@usernotifications');
Route::post('/user/notifications/delete', 'NotificationController@deletenotifications');
Route::post('/get/categories', 'ItemController@listofcategories');

Route::post('/qoima/list', 'QoimaController@listofqoima');


Route::middleware('cors')->group(function () {

    Route::post('/admin/signin', 'AdminController@signin');
    Route::get('/admin/get/me', 'AdminController@getMe');
    Route::post('/admin/get/listofitems', 'AdminController@listofitems');
    Route::post('/admin/get/item', 'AdminController@item');
    Route::post('/admin/update/item', 'AdminController@updateitem');
    Route::post('/admin/delete/item', 'AdminController@deleteitem');
    Route::get('/admin/total/sum', 'AdminController@totalsum');
    Route::post('/admin/change/name', 'AdminController@changename');
    Route::get('/admin/check', function () {
       return "HELLO WORLD";
    });
    Route::post('/admin/changepassword', 'AdminController@changepassword');
    Route::post('/admin/qoima/information', 'AdminController@qoimainformation');
    Route::post('/admin/qoima/changeinformation', 'AdminController@changeqoimainformation');
});


Route::post('/contact/us', 'AdminController@contactus');

