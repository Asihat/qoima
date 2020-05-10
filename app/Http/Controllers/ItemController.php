<?php

namespace App\Http\Controllers;

use App\Items;
use App\ItemsPhoto;
use App\User;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function additem(Request $request)
    {
        Log::info('something happends here');
        $result['success'] = false;
        $id = $request->input('id');
        $unic = $request->input('unique');
        $name = $request->input('name');
        $description = $request->input('description');
        $qoimaID = $request->input('qoima_id');
        $length = $request->input('length');
        $width = $request->input('width');
        $height = $request->input('height');
        $amount = $request->input('amount');
        $price = $request->input('sum');

        info('price');
        info($price);

        info("one");
        if ($request->file('photo')) {
            info('error1');
            $path = $request->file('photo')->store('images', ['disk' => 'public']);
        } else {
            $path = null;
            info('error2');
        }

        info("two");
        while (true) {
            info('while loop');
            if (!$id) {
                $result['message'] = 'id required';

                break;
            }

            if (!$unic) {
                $result['message'] = 'Unique required';

                break;
            }

            if (!$name) {
                $result['message'] = 'Name required';

                break;
            }

            if (!$description) {
                $result['message'] = 'Description required';

                break;
            }

            if (!$qoimaID) {
                $result['message'] = 'Qoima ID required';

                break;
            }

            if ($path === null) {
                $result['message'] = 'Photo file required';

                break;
            }

            // Create Item
            $item = new Items;

            $item->name = $name;
            $item->description = $description;
            $item->user_id = $id;
            $item->qoima_id = $qoimaID;
            $item->status = 0;
            $item->length = $length;
            $item->width = $width;
            $item->height = $height;
            $item->amount = $amount;
            $item->price = $price;


            $item->save();

            // Create item_photo
            $item_photo = new ItemsPhoto;

            $item_photo->itemID = $item->id;
            $item_photo->photoOne = $path;
            $item_photo->photoTwo = $path;
            $item_photo->photoThree = $path;
            $item_photo->photoFour = $path;

            $item->photo = $item_photo;

            $item_photo->save();

            $result['item'] = $item;
            $result['success'] = true;
            break;
        }

        info($result);
        return $result;
    }

    public function listofitems(Request $request)
    {
        $result['success'] = false;
        $id = $request->input('id');
        $unic = $request->input('unique');

        do {
            if (!$id || !$unic) {
                $result['message'] = "INPUT ERROR";

                break;
            }

            $user = Users::find($id);

            if (!$user) {
                $result['message'] = "USER DO NOT EXISTS";

                break;
            }

            if ($user->unique != $unic) {
                $request['message'] = "UNIC NOT CORRECT";

                break;
            }

            $items = Items::where('user_id', $id)->get();

            $result['success'] = true;

            if (!$items) {
                $result['message'] = "ITEMS NOT FOUND";

                break;
            }

            foreach ($items as $item) {
                $item_photo = ItemsPhoto::find($item->id);

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

    public function bringitems(Request $request)
    {
        $result['success'] = false;

        $id = $request->input('id', false);
        $unic = $request->input('unique', false);
        $itemsID = $request->input('itemsID', false);

        do {
            if (!$id) {
                $result['message'] = 'ID is not found';

                break;
            }

            if (!$unic) {
                $result['message'] = 'Unic is not found';

                break;
            }

            if (!$itemsID) {
                $result['message'] = 'Items not found';

                break;
            }

            $user = Users::find($id);

            if (!$user) {
                $result['message'] = 'User not found';

                break;
            }

            if ($user->unique != $unic) {
                $result['message'] = 'Unic not correct';

                break;
            }

            $item = Items::find($itemsID);

            if (!$item) {
                $result['message'] = 'Item not found';

                break;
            }

            $item->status = 3;
            $item->save();
            $result['success'] = true;

            $result['item'] = $item;
        } while (false);

        return response()->json($result);
    }

    public function getiteminfo(Request $request)
    {
        $result['success'] = false;

        $id = $request->input('id');
        $unic = $request->input('unique');
        $itemID = $request->input('item_id');

        do {
            if (!$id) {
                $result['message'] = 'NO ID';

                break;
            }

            if (!$unic) {
                $result['message'] = 'No unic';

                break;
            }

            if (!$itemID) {
                $result['message'] = 'No Item ID';

                break;
            }

            $user = User::where('id', $id)->where('unique', $unic)->first();

            if (!$user) {
                $result['message'] = 'error1';

                break;
            }

            $item = Items::where('id', $itemID)->where('user_id', $id)->first();

            if (!$item) {
                $result['message'] = 'error2';

                break;
            }

            $item_photo = ItemsPhoto::where('itemID', $itemID)->first();

            if (!$item_photo) {
                $item['photo'] = 'nophoto.png';
            } else {
                $item['photo'] = $item_photo->photoOne;
            }

            $result['item'] = $item;

            $result['success'] = true;
        } while (false);


        return response()->json($result);
    }

    public function planitem(Request $request)
    {
        $result['success'] = false;

        $id = $request->input('id');
        $unic = $request->input('unique');
        $itemID = $request->input('item_id');
        $planned_data = $request->input('planned_data'); // TODO NOTIFICATION

        do {
            if (!$id) {
                $result['message'] = 'NO ID';

                break;
            }

            if (!$unic) {
                $result['message'] = 'No unic';

                break;
            }

            if (!$itemID) {
                $result['message'] = 'No Item ID';

                break;
            }

            $user = User::where('id', $id)->where('unique', $unic)->first();

            if (!$user) {
                $result['message'] = 'error1';

                break;
            }

            $item = Items::where('id', $itemID)->where('user_id', $id)->where('status', 0)->first();

            if (!$item) {
                $result['message'] = 'error2';

                break;
            }

            info('update item');
            Items::where('id', $itemID)->where('user_id', $id)->update(['status'=> 1]);

            $item->status = 1;

            $result['item'] = $item;

            $result['success'] = true;
        } while (false);


        return response()->json($result);
    }

    public function deliveritem(Request $request) {
        $result['success'] = false;

        $id = $request->input('id');
        $unic = $request->input('unique');
        $itemID = $request->input('item_id');
        $planned_data = $request->input('planned_data'); // TODO NOTIFICATION

        do {
            if (!$id) {
                $result['message'] = 'NO ID';

                break;
            }

            if (!$unic) {
                $result['message'] = 'No unic';

                break;
            }

            if (!$itemID) {
                $result['message'] = 'No Item ID';

                break;
            }

            $user = User::where('id', $id)->where('unique', $unic)->first();

            if (!$user) {
                $result['message'] = 'error1';

                break;
            }

            $item = Items::where('id', $itemID)->where('user_id', $id)->first();

            if (!$item) {
                $result['message'] = 'error2';

                break;
            }

            info('update item');
            Items::where('id', $itemID)->where('user_id', $id)->update(['status'=> 3]);

            $item->status = 3;

            $result['item'] = $item;

            $result['success'] = true;
        } while (false);


        return response()->json($result);
    }

}
