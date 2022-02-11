<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api;
use Exception;
use Illuminate\Http\Request;
use Response;
use Validator;

class ApiKeyController extends Controller
{
    public function store(Request $request)
    {
//        dd($request->all());
        $getApiKey = Api::first();
        if (!$getApiKey) {
            try {
                $validate = Validator::make(request()->all(), [
                    'api_key' => 'required'
                ]);

//            dd($validate->errors()->messages());

                if ($validate->fails()) {
                    $errors = $validate->errors()->messages();
                    return validateError($errors);
                }
                $target = new Api;
                $target->api_key = $request->api_key;
                $target->status = 'active';
                if ($target->save()) {
                    return response([
                        'status' => 'success',
                        'message' => "Api Key Successfully Create",
                        "data" => $target
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
                    'api_key' => 'required'
                ]);

//            dd($validate->errors()->messages());

                if ($validate->fails()) {
                    $errors = $validate->errors()->messages();
                    return validateError($errors);
                }

                $getApiKey->api_key = $request->api_key ?? $getApiKey->api_key;
                if ($getApiKey->update()) {
                    return response([
                        'status' => 'success',
                        'message' => "Api Key Successfully Update",
                        "data" => $getApiKey
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
            $api_key = Api::all();
            return response([
                'status' => 'success',
                'data' => $api_key,
            ], 200);
        } catch (Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }

    }


}
