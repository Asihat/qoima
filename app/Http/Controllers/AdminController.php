<?php

namespace App\Http\Controllers;

use App\Admins;
use App\Categories;
use App\ItemCategories;
use App\Items;
use App\ItemsPhoto;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function signin(Request $request)
    {
        $result['success'] = false;
        $admin = $request->email;
        $password = $request->password;

        do {
            if (!$admin || !$password) {
                $result['message'] = 'email and password required';
            }

            $admin_user = Admins::where('email', $admin)->first();

            if (!$admin_user) {
                $result['message'] = 'User does not exists';

                break;
            }

            if (!($admin_user->password == $password)) {
                $result['message'] = 'Password is incorrect';

                break;
            }

            $result['success'] = true;
            $admin_user->token = Str::random(60);
            $admin_user->save();
            $result['token'] = $admin_user->token;
            $result['user'] = $admin_user;
        } while(false);

        return response()->json($result);
    }

    public function getMe(Request $request)
    {
        $result['success'] = false;
        $token = $request->token;

        do {
            if (!$token) {
                $result['message'] = 'Token required';

                break;
            }

            $admin = Admins::where('token', $token)->first();

            if (!$admin) {
                $result['message'] = 'error6665';

                break;
            }


            $result['success'] = true;
            $result['admin'] = $admin;
        } while (false);

        return response()->json([
            'result' => $result
        ]);
    }

    public function listofitems(Request $request) {
        $result['success'] = false;
        $token = $request->input('token');

        do {
            if(!$token) {
                $result['message'] = 'token missmatch';

                break;
            }

            $admin = Admins::where('token', $token)->first();

            if(!$admin) {
                $result['message'] = 'Error';

                break;
            }

            $items = Items::where('qoima_id', $admin->qoima_id) -> get();

            $result['success'] = true;

            if (!$items) {
                $result['message'] = "ITEMS NOT FOUND";

                break;
            }

            foreach($items as $item) {
                $item_photo = ItemsPhoto::find($item->id);
                $item['photo'] = 'images/nophoto.png';
                if(!$item_photo) {
                    $item['photo'] = 'images/nophoto.png';

                    continue;
                }

                $item['photo'] = $item_photo->photoOne;
            }

            $result['items'] = $items;
        } while (false);


        return response()->json($result);
    }

    public function item(Request $request) {
        $result['success'] = false;
        $token = $request->input('token');
        $ItemID = $request->input('item_id');

        do {
            if(!$token) {
                $result['message'] = 'Token missmatch';

                break;
            }

            $admin = Admins::where('token', $token)->first();

            if(!$admin) {
                $result['message'] = 'Invalid';

                break;
            }


            if(!$ItemID) {
                $result['message'] = 'Item ID missmatch';
            }

            $item = Items::where('id', $ItemID) -> where('qoima_id', $admin->qoima_id) -> first();

            $user = Users::where('id', $item->user_id)->first();

            if(!$user) {
                $item['userName'] = 'Unknown';
            } else {
                $item['userName'] = $user->name . ' ' . $user->surname;
            }

            $item_photo = ItemsPhoto::find($item->id);

            if(!$item_photo) {
                $item['photo'] = 'images/nophoto.png';

            } else {
                $item['photo'] = $item_photo->photoOne;
            }

            $categoryItem = ItemCategories::where('itemID', $item->id)-> first();

            if(!$categoryItem) {
                $item['category'] = 'undefined';
            } else {

                $category = Categories::find($categoryItem->categoryID);

                if(!$category) {
                    $item['category'] = 'undefined';
                } else {
                    $item['category'] =  $category->name;
                }
            }

            $categories = Categories::all();

            $result['categories'] = $categories;
            $result['item'] = $item;
            $result['success'] = true;
        }while(false);


        return response()->json($result);
    }

    public function updateitem(Request $request) {
        $result['success'] = false;
        $token = $request->input('token');
        $id = $request->input('id');
        $name = $request->input('name');
        $description = $request->input('description');
        $status = $request->input('status');
        $updated_at = $request->input('updated_at');

        do {
            $item = Items::where('id', $id)->first();

            $item->name = $name;
            $item->description = $description;
            $item->status = $status;
            $item->updated_at = $updated_at;

            $item->save();

            $result['success'] = true;
        }while(false);

        return response()->json($result);
    }

    public function deleteitem(Request $request) {
        $result['success'] = false;

        $token = $request->input('token');
        $id = $request->input('id');

        $item = Items::where('id', $id) -> first();

        $item->delete();

        $result['success'] = true;


        return response()->json($result);
    }

    public function totalsum(Request $request) {
        $sum = 0;

        $items = Items::all();

        foreach($items as $item) {
            $sum = $sum + $item->sum;
        }


        return response()->json(['sum' => $sum]);
    }

    public function changename(Request $request) {
        $result['success'] = false;
        $token = $request->input('token');
        $name = $request->input('name');
        $id = $request->input('id');

        $admins = Admins::all();

        $admin = Admins::where('id', $id)->first();

        $admin->name = $name;

        $admin->save();

        $result['success'] = true;
        return response()->json($result);
    }
}
