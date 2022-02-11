<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Smtp;
use Illuminate\Http\Request;
use Validator;


class SmtpController extends Controller
{
    public function store(Request $request)
    {
//        dd($request->all());
        $getSmtp = Smtp::first();
//        dd($getMngNotification);
        if (!$getSmtp) {
            try {
                $validate = Validator::make(request()->all(), [
                    "host" => 'required',
                    "port" => 'required',
                    "encryption" => 'required',
                    "username" => 'required',
                    "password" => 'required',
//                    'image' => 'required'
                ]);

//            dd($validate->errors()->messages());

                if ($validate->fails()) {
                    $errors = $validate->errors()->messages();
                    return validateError($errors);
                }
                $smtp = new Smtp();
                $smtp->name = $request->name;
                $smtp->host = $request->host;
                $smtp->port = $request->port;
                $smtp->encryption = $request->encryption;
                $smtp->username = $request->username;
                $smtp->email = $request->email;
                $smtp->password = $request->password;

                if ($smtp->save()) {
                    return response([
                        'status' => 'success',
                        'message' => "Smtp Successfully Create",
                    ], 200);
                }
            } catch (Exception$e) {
                return response([
                    'status' => 'server_error',
                    'message' => $e->getMessage(),
                ], 500);
            }
        } else {
            try {
                $validate = Validator::make(request()->all(), [
                    "host" => 'required',
                    "port" => 'required',
                    "encryption" => 'required',
                    "username" => 'required',
                    "password" => 'required',
//                    'image' => 'required'
                ]);

//            dd($validate->errors()->messages());

                if ($validate->fails()) {
                    $errors = $validate->errors()->messages();
                    return validateError($errors);
                }
                $smtp = Smtp::first();
                $smtp->name = $request->name ?? $smtp->name;
                $smtp->host = $request->host ?? $smtp->host;
                $smtp->port = $request->port ?? $smtp->port;
                $smtp->encryption = $request->encryption ?? $smtp->encryption;
                $smtp->username = $request->username ?? $smtp->username;
                $smtp->email = $request->email ?? $smtp->email;
                $smtp->password = $request->password ?? $smtp->password;
                if ($smtp->update()) {
                    return response([
                        'status' => 'success',
                        'message' => "Smtp Successfully Update",
                    ], 200);
                }
            } catch (Exception$e) {
                return response([
                    'status' => 'server_error',
                    'message' => $e->getMessage(),
                ], 500);
            }
        }
    }

    public function show()
    {
        try {
            $getSmtp = Smtp::all();
            return response([
                'status' => 'success',
                'data' => $getSmtp,
            ], 200);
        } catch (Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }

    }
}
