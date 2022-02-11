<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Validator;

class SettingsController extends Controller
{

    public function  store(Request $request){
//        dd($request->all());
        $getSettings = Setting::first();
//        dd($getMngNotification);
        if (!$getSettings) {
            try {
                $validate = Validator::make(request()->all(), [
                    "system_name" => 'required',
                    "app_version" => 'required',
                    "mail_address" => 'required',
                    "update_app" => 'required',
//                    'image' => 'required'
                ]);

//            dd($validate->errors()->messages());

                if ($validate->fails()) {
                    $errors = $validate->errors()->messages();
                    return validateError($errors);
                }
                $setting = new Setting();
                $setting->system_name = $request->system_name;
                $setting->app_version = $request->app_version;
                $setting->mail_address = $request->mail_address;
                $setting->update_app = $request->update_app;
                $setting->developed_by = $request->developed_by;
                $setting->facebook = $request->facebook;
                $setting->instagram = $request->instagram;
                $setting->twitter = $request->twitter;
                $setting->youtube = $request->youtube;
                $setting->copyright = $request->copyright;
                $setting->image = $request->image;
                $setting->description = $request->description;
                $setting->privacy_policy = $request->privacy_policy;
                $setting->cookies_policy = $request->cookies_policy;
                $setting->terms_policy = $request->terms_policy;
                if ($setting->save()) {
                    return response([
                        'status' => 'success',
                        'message' => "Settings Successfully Create",
                    ], 200);
                }
            } catch (Exception$e) {
                return response([
                    'status' => 'server_error',
                    'message' => $e->getMessage(),
                ], 500);
            }
        }else{
            try {
                $validate = Validator::make(request()->all(), [
                    "system_name" => 'required',
                    "app_version" => 'required',
                    "mail_address" => 'required',
                    "update_app" => 'required',
//                    'image' => 'required'
                ]);

//            dd($validate->errors()->messages());

                if ($validate->fails()) {
                    $errors = $validate->errors()->messages();
                    return validateError($errors);
                }
                $setting =  Setting::first();
                $setting->system_name = $request->system_name ?? $setting->system_name;
                $setting->app_version = $request->app_version ?? $setting->app_version;
                $setting->mail_address = $request->email ?? $setting->mail_address;
                $setting->update_app = $request->update_app ?? $setting->update_app;
                $setting->developed_by = $request->developed_by ?? $setting->developed_by;
                $setting->facebook = $request->facebook ?? $setting->facebook;
                $setting->instagram = $request->instagram ?? $setting->instagram;
                $setting->twitter = $request->twitter ?? $setting->twitter;
                $setting->youtube = $request->youtube ?? $setting->youtube;
                $setting->copyright = $request->copyright ?? $setting->copyright;
                $setting->image = $request->image ?? $setting->image;
                $setting->description = $request->description ?? $setting->description;
                $setting->privacy_policy = $request->privacy_policy ?? $setting->privacy_policy;
                $setting->cookies_policy = $request->cookies_policy ?? $setting->cookies_policy;
                $setting->terms_policy = $request->terms_policy ?? $setting->terms_policy;
                if ($setting->update()) {
                    return response([
                        'status' => 'success',
                        'message' => "Settings Successfully Update",
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
            $getsettings = Setting::all();
            return response([
                'status' => 'success',
                'data' => $getsettings,
            ], 200);
        } catch (Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function fileUploader(Request $request)
    {
//        dd($request->all());
        $validate = Validator::make(request()->only('file'), [
            'file' => 'required|max:10240',
        ]);
        if ($validate->fails()) {
            return response([
                'status' => 'validation_error',
                'data'   => $validate->errors(),
            ], 422);
        }
        try {
            if (request()->has('file')) {
                $folder    = $request->folder ?? 'all';
                $image     = $request->file('file');
                $imageName = $folder . "/" . time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('/uploads/' . $folder), $imageName);
                $protocol = request()->secure();

                return response([
                    'status'  => 'success',
                    'message' => 'File uploaded successfully',
                    'data'    => $protocol ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $imageName,
                ], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
