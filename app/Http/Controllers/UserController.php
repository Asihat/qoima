<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $result = [
            'success' => false,
        ];

        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $description = $request->input('description');
        $password = $request->input('password');
        $account = 10000;

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
            $newUser->description = $description;
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
                $result = [
                    'success' => true,
                    'message' => 'Correct authentication',
                ];
                $user->unique = md5(uniqid(rand(), true));

                $user->save();
            } else {
                $result['message'] = 'Incorrect password';
            }
        } else {
            $result['message'] = 'Email do not exists';
        }


        return $result;
    }
}
