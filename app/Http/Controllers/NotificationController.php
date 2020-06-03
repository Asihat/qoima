<?php

namespace App\Http\Controllers;

use App\Notifcation;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function usernotifications(Request $request)
    {
        $result['success'] = false;
        $id = $request->input('id');
        $unic = $request->input('unique');

        do {
            if (!$id || !$unic) {
                $result['message'] = 'INPUT ERROR';

                break;
            }

            $user = User::where('id', $id)->where('unique', $unic)->first();

            if (!$user) {
                $result['message'] = 'ERROR 1';

                break;
            }

            $notifications = Notifcation::where('userID', $id)->get();


            $result['notifications'] = $notifications;
            $result['success'] = true;

        } while (false);


        return response()->json($result);
    }

    public function deletenotifications(Request $request)
    {
        $result['success'] = false;
        $id = $request->input('id');
        $unic = $request->input('unique');

        do {
            if (!$id || !$unic) {
                $result['message'] = 'INPUT ERROR';

                break;
            }

            $user = User::where('id', $id)->where('unique', $unic) ->first();

            if(!$user) {
                $result['message'] = 'User Error';

                break;
            }

            $notifications = Notifcation::where('userID', $id) -> delete();

            $result['success'] = true;
        } while (false);


        return response()->json($result);
    }
}
