<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        info('register user');
        $result = [
            'success' => false,
        ];

        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $phoneNo = $request->input('phoneNo');
        $password = $request->input('password');

        $allUsers = User::all();
        $account = count($allUsers) + 100000;

        $user = User::where('email', $email)->first();
        if ($user) {
            $result += [
                'message' => 'User exists',
            ];
        } else {
            $newUser = new User();

            $newUser->name = $name;
            $newUser->surname = $surname;
            $newUser->email = $email;
            $newUser->phoneNo = $phoneNo;
            $newUser->password = $password;
            $newUser->account = $account;

            $newUser->save();

            $result = [
                'success' => true,
                'message' => 'success',
            ];
        }

        return response()->json($result);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $result = [
            'success' => false,
        ];

        $user = User::where('email', $email)->first();
        if ($user) {
            if ($user->password == $password) {
                $user->unique = md5(uniqid(rand(), true));

                $user->save();

                $result = [
                    'success' => true,
                    'message' => 'Correct authentication',
                    'unique' => $user->unique,
                    'user' => $user
                ];

            } else {
                $result['message'] = 'Incorrect password';
            }
        } else {
            $result['message'] = 'Email do not exists';
        }


        return $result;
    }

    public function userinfo(Request $request)
    {
        $result = [
            'success' => false,
        ];

        $user_id = $request->input('user_id');
        $unique = $request->input('unique');

        $user = User::where('id', $user_id)
            ->where('unique', $unique)
            ->first();

        if ($user) {
            $result['user'] = $user;
            $result['success'] = true;
        } else {
            $result['message'] = 'ERROR 505';
        }

        return response()->json($result);
    }

    public function updateuser(Request $request)
    {
        $result['success'] = false;

        $id = $request->input('id');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $description = $request->input('description');

        $unic = $request->input('unique');

        do {
            if (!$id || !$name || !$surname || !$description || !$unic) {
                $result['message'] = 'ERROR INPUT';

                break;
            }

            $user = User::find($id);

            if (!$user) {
                $result['message'] = "USER NOT FOUND";

                break;
            }

            if ($user->unique != $unic) {
                $result['message'] = "NOT CORRECT UNIC";

                break;
            }

            $user->name = $name;
            $user->surname = $surname;
            $user->description = $description;

            $user->save();

            $result['success'] = true;
            $result['message'] = 'User updated.';

        } while (false);

        return response()->json($result);
    }

    public function changepassword(Request $request)
    {
        $result['success'] = false;
        $id = $request->input('id');
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $unic = $request->input('unique');

        do {
            if (!$id || !$old_password || !$new_password || !$unic) {
                $result['message'] = "INPUT ERROR";

                break;
            }

            $user = User::find($id);

            if (!$user) {
                $result['message'] = "USER NOT FOUND";

                break;
            }

            if ($user->password != $old_password) {
                $result['message'] = "PASSWORD IS INCORRECT";

                break;
            }
            if ($user->unique != $unic) {
                $result['message'] = "NOT CORRECT UNIC";

                break;
            }

            if ($old_password == $new_password) {
                $result['message'] = "PASSWORDS EQUAL";

                break;
            }

            $user->password = $new_password;
            $user->save();

            $result['success'] = true;
            $result['message'] = "SUCCESS";
        } while (false);

        return response()->json($result);
    }

    public function changeaddress(Request $request)
    {
        $result['success'] = false;

        $id = $request->input('id');
        $unic = $request->input('unique');
        $newaddress = $request->input('new_address');

        do {
            if (!$id || !$newaddress || !$unic) {
                $result['message'] = 'ERROR INPUT';

                break;
            }

            $user = User::where('id', $id)->where('unique', $unic) ->first();

            $user->address = $newaddress;

            $user->save();

            $result['success'] = true;
        } while (false);

        return response()->json($result);
    }
}
