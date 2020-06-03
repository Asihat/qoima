<?php

namespace App\Http\Controllers;

use App\Qoima_list;
use App\User;
use Illuminate\Http\Request;

class QoimaController extends Controller
{
    public function listofqoima(Request $request)
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
                $result['message'] = 'ERROR 123';

                break;
            }

            $qoimalist = Qoima_list::all();

            foreach ($qoimalist as $qoima) {


                $maps = explode(",", $qoima->map_address);

                $longitude = $maps[0];
                $latitude = $maps[1];

                $qoima['longitude'] = $latitude;
                $qoima['latitude'] = $longitude;
            }

            $result['qoima'] = $qoimalist;

            $result['success'] = true;
        } while (false);


        return response()->json($result);
    }
}
