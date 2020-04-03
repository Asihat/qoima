<?php

namespace App\Http\Controllers;

use App\Items;
use App\Users;
use Illuminate\Http\Request;

class ItemController extends Controller
{
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
            $item->status = 3;
            $item->save();
            $result['success'] = true;
            if (!$item) {
                $result['message'] = 'Item not found';

                break;
            }

            $result['item'] = $item;
        } while (false);

        return response()->json($result);
    }
}
