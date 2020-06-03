<?php

namespace App\Http\Controllers;

use App\Admins;
use App\Categories;
use App\Contact;
use App\ItemCategories;
use App\Items;
use App\ItemsPhoto;
use App\Qoima_list;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        } while (false);

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

    public function listofitems(Request $request)
    {
        $result['success'] = false;
        $token = $request->input('token');

        do {
            if (!$token) {
                $result['message'] = 'token missmatch';

                break;
            }

            $admin = Admins::where('token', $token)->first();

            if (!$admin) {
                $result['message'] = 'Error';

                break;
            }

            $items = Items::orderBy('id', 'DESC')->where('qoima_id', $admin->qoima_id)->paginate(5);

            $result['success'] = true;

            if (!$items) {
                $result['message'] = "ITEMS NOT FOUND";

                break;
            }

//            foreach ($items as $item) {
//                $item_photo = ItemsPhoto::find($item->id);
//                $item['photo'] = 'images/nophoto.png';
//
//                if (!$item_photo) {
//                    $item['photo'] = 'images/nophoto.png';
//
//                    continue;
//                }
//
//                if (file_exists(public_path() . '/' . $item_photo->photoOne)) {
//                    $item['photo'] = $item_photo->photoOne;
//                } else {
//                    $item['photo'] = 'images/nophoto.png';
//                }
//            }
            foreach ($items as $item) {
                $item_photo = ItemsPhoto::where('itemID', $item->id)->first();

                if (!$item_photo) {
                    $item['photo'] = 'nophoto.png';

                    continue;
                }
                $item['photo'] = $item_photo->photoOne;
            }

            $result['items'] = $items;
        } while (false);


        return response()->json($result);
    }

    public function item(Request $request)
    {
        $result['success'] = false;
        $token = $request->input('token');
        $ItemID = $request->input('item_id');

        do {
            if (!$token) {
                $result['message'] = 'Token missmatch';

                break;
            }

            $admin = Admins::where('token', $token)->first();

            if (!$admin) {
                $result['message'] = 'Invalid';

                break;
            }


            if (!$ItemID) {
                $result['message'] = 'Item ID missmatch';
            }

            $item = Items::where('id', $ItemID)->where('qoima_id', $admin->qoima_id)->first();

            $user = Users::where('id', $item->user_id)->first();

            if (!$user) {
                $item['userName'] = 'Unknown';
            } else {
                $item['userName'] = $user->name . ' ' . $user->surname;
            }

            $item_photo = ItemsPhoto::find($item->id);

            if (!$item_photo) {
                $item['photo'] = 'images/nophoto.png';

            } else {
                $item['photo'] = $item_photo->photoOne;
            }

            $categoryItem = ItemCategories::where('itemID', $item->id)->first();

            if (!$categoryItem) {
                $item['category'] = 'undefined';
            } else {

                $category = Categories::find($categoryItem->categoryID);

                if (!$category) {
                    $item['category'] = 'undefined';
                } else {
                    $item['category'] = $category->name;
                }
            }

            $categories = Categories::all();

            $result['categories'] = $categories;
            $result['item'] = $item;
            $result['success'] = true;
        } while (false);


        return response()->json($result);
    }

    public function updateitem(Request $request)
    {
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
        } while (false);

        return response()->json($result);
    }

    public function deleteitem(Request $request)
    {
        $result['success'] = false;

        $token = $request->input('token');
        $id = $request->input('id');

        $item = Items::where('id', $id)->first();

        $item->delete();

        $result['success'] = true;


        return response()->json($result);
    }

    public function totalsum(Request $request)
    {
        $sum = 0;

        $items = Items::all();

        foreach ($items as $item) {
            $sum = $sum + $item->price;
        }

        return response()->json(['sum' => $sum]);
    }

    public function changename(Request $request)
    {
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

    public function changepassword(Request $request)
    {
        $result['success'] = false;
        $token = $request->input('token');
        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');

        do {
            if (!$token || !$oldpassword || !$newpassword) {
                $result['message'] = 'Something is missmatch';

                break;
            }

            $admin = Admins::where('token', $token)->where('password', $oldpassword)->first();

            if (!$admin) {
                $result['message'] = 'error';
                break;
            }

            $admin->password = $newpassword;
            $admin->save();

            $result['message'] = 'Password changed';
            $result['success'] = true;
        } while (false);

        return response()->json($result);
    }

    public function qoimainformation(Request $request)
    {
        $result['success'] = false;
        $token = $request->input('token');

        do {
            if (!$token) {
                $result['message'] = 'Parameters is mismatch';

                break;
            }

            $admin = Admins::where('token', $token)->first();

            if (!$admin) {
                $result['message'] = 'Error';

                break;
            }

            $qoima = Qoima_list::where('id', $admin->qoima_id)->first();

            if (!$qoima) {
                $result['message'] = 'Error';

                break;
            }

            $maps = explode(",", $qoima->map_address);

            $longitude = $maps[0];
            $latitude = $maps[1];

            $qoima['longitude'] = $latitude;
            $qoima['latitude'] = $longitude;

            $result['qoima'] = $qoima;
            $result['success'] = true;
        } while (false);


        return response()->json($result);
    }

    public function changeqoimainformation(Request $request)
    {
        $result['success'] = false;
        $token = $request->input('token');
        $name = $request->input('name');
        $description = $request->input('description');
        $address = $request->input('address');
        $latitude = $request->input('latitude');
        $longtitude = $request->input('longtitude');
        $url_address = $request->input('url_address');
        $working_time = $request->input('working_time');
        $phone = $request->input('phone');
        $email = $request->input('email');


        do {
            if (!$token || !$name || !$description || !$address || !$latitude || !$longtitude || !$url_address || !$working_time || !$phone || !$email) {
                $result['message'] = 'Parameter is mismatch';

                break;
            }

            $admin = Admins::where('token', $token)->first();

            if (!$admin) {
                $result['message'] = 'Error';

                break;
            }

            $qoima = Qoima_list::where('id', $admin->qoima_id)->first();

            if (!$qoima) {
                $result['message'] = 'Error';

                break;
            }

            $qoima->name = $name;
            $qoima->description = $description;
            $qoima->address = $address;
            $qoima->map_address = $latitude . ', ' . $longtitude;
            $qoima->url_address = $url_address;
            $qoima->working_time = $working_time;
            $qoima->phone = $phone;
            $qoima->email = $email;

            $qoima->save();

            $result['message'] = 'Changed';
            $result['success'] = true;
        } while (false);

        return response()->json($result);
    }

    public function contactus(Request $request) {
        $result['success'] = false;

        $name = $request->input('name');
        $email = $request->input('email');
        $phoneno = $request->input('phone');
        $message = $request->input('message');

        $contact = new Contact();

        $contact->name = $name;
        $contact->email = $email;
        $contact->phoneno = $phoneno;
        $contact->message = $message;

        $contact->save();

        $result['contact'] = $contact;

        return response()->json($result);
    }
}
