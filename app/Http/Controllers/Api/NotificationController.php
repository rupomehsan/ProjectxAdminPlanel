<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api;
use App\Models\Blog;
use App\Models\ManageNotification;
use App\Models\Notification;
use Illuminate\Http\Request;
use Validator;
use Http;

class NotificationController extends Controller
{
    public function  store(Request $request){
        $getMngNotification = ManageNotification::first();
//        dd($getMngNotification);
        if (!$getMngNotification) {
            try {
                $validate = Validator::make(request()->all(), [
                    "api_key" => 'required',
                    "app_id" => 'required',
//                    'image' => 'required'
                ]);

//            dd($validate->errors()->messages());

                if ($validate->fails()) {
                    $errors = $validate->errors()->messages();
                    return validateError($errors);
                }
                $mngNotification = new ManageNotification();
                $mngNotification->api_key = $request->api_key;
                $mngNotification->app_id = $request->app_id;
                if ($mngNotification->save()) {
                    return response([
                        'status' => 'success',
                        'message' => "Manage Notification Successfully Create",
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
                    "api_key" => 'required',
                    "app_id" => 'required',
//                    'image' => 'required'
                ]);

//            dd($validate->errors()->messages());

                if ($validate->fails()) {
                    $errors = $validate->errors()->messages();
                    return validateError($errors);
                }

                $getMngNotification->api_key = $request->api_key ?? $getMngNotification->api_key;
                $getMngNotification->app_id = $request->app_id ?? $getMngNotification->app_id;
                if ($getMngNotification->update()) {
                    return response([
                        'status' => 'success',
                        'message' => "Manage Notification Successfully Update",
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
            $getManageNotification = ManageNotification::all();
            return response([
                'status' => 'success',
                'data' => $getManageNotification,
            ], 200);
        } catch (Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }

    }


    public function getAll(){
        $getAllNotification = Notification::all();
        if($getAllNotification){
            return response([
                'status' => 'success',
                'data' => $getAllNotification,
            ], 200);
        }
    }

    public function destroy($id){
//        dd($id);
        $deleteNotification = Notification::where('id',$id)->delete();
        if($deleteNotification){
            return response([
                'status' => 'success',
                'message' => "Notification Successfully Delete",
            ], 200);
        }
    }

    public function sendNotification(Request $request)
    {
//         dd($request->all());
        $api      = ManageNotification::first();
        $apiKey   = $api->api_key;
        $appId    = $api->app_id;
        $validate = Validator::make(request()->all(), [
            'title' => 'required',
        ]);
        if ($validate->fails()) {
            $errors = $validate->errors()->messages();
            return validateError($errors);
        }

        $notification                = new Notification;
        $notification->title         = $request->title;
        $notification->blog_id      = $request->blog_id ;
        $notification->external_link = $request->external_link ;
        $notification->description   = $request->description;
        $notification->image = $request->image;

        $notification->save();

        $content = array(
            "en" => $request->description,
        );
        $headings = array(
            "en" => $request->title, // title
        );

        $hashes_array = array();
        array_push($hashes_array, array(
            "id"   => "like-button",
            "text" => "Like",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url"  => "https://yoursite.com",
        ));
        array_push($hashes_array, array(
            "id"   => "like-button-2",
            "text" => "Like2",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url"  => "https://yoursite.com",
        ));
        $response = Http::withHeaders([
            'Content-Type'  => 'application/json; charset=utf-8',
            'Authorization' => 'Basic ' . $apiKey,
        ])->post('https://onesignal.com/api/v1/notifications', [
            'app_id'            => $appId,
            'included_segments' => array(
                'Subscribed Users',
            ),
            // 'data'              => array(
            //     "foo" => "bar",
            // ),
            'headings'          => ['en' => $request->title],
            'contents'          => $content,
            'contents'          => $content,
            'url'               => 'www.google.com',
            // 'web_buttons'       => $hashes_array,
        ]);
        $jsonResponse = $response->json();
        if (array_key_exists('errors', $jsonResponse)) {
            return response([
                'status' => 'validate_errors',
                'data'   => $jsonResponse,
            ]);
        } else {
            return response([
                'status' => 'success',
                'data'   => $jsonResponse,
            ]);
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
