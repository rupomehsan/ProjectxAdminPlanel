<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;



class LoginController extends Controller
{
    public function login(Request $request)
    {
//        dd($request->all());
//        $data = json_decode(file_get_contents("php://input"));
        try {
            $validator = Validator::make(request()->all(), [
                'email'    => 'required|exists:users',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->messages();
                return validateError($errors);
            }
            if (!auth()->attempt($validator->validated())) {
                $errors = [
                    'password' => ["Password doesn't matched..."]
                ];
                return validateError($errors);
            }

            // if ((auth()->user()->status) == 'pending') {
            //     return response([
            //         'status'  => 'error',
            //         'message' => 'Please verified your email.',
            //     ], 404);
            // }

            $accessToken = auth()->user()->createToken('authToken');

            return response([
                'status'  => 'success',
                'message' => 'Successfully logged in...',
                'data'    => [
                    'token' => 'Bearer ' . $accessToken->plainTextToken,
                    'user'  => auth()->user(),
                ],
            ], 200);
        } catch (Exception $e) {
            return response([
                'status'  => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
