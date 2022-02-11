<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Hash;

class AdminController extends Controller
{
    public  function  store(Request $request){
//        dd($request);
        try {
            $validate = Validator::make(request()->all(), [
                "name" => 'required',
                "email" => 'required|unique:users',
                "phone" => 'required',
                "password" => 'required',
//                    'image' => 'required'
            ]);

//            dd($validate->errors()->messages());

            if ($validate->fails()) {
                $errors = $validate->errors()->messages();
                return validateError($errors);
            }
            $access = '';
            if (!empty($request->access)) {
                $access = json_encode($request->access);
            }
            $admin = new User;
            $admin->name = $request->name;
            $admin->email= $request->email;
            $admin->phone = $request->phone;
            $admin->password = Hash::make($request->password);
            $admin->image = $request->image;
            $admin->access = $access;
            $admin->user_role_id = $request->user_role_id;
            if ($admin->save()) {
                return response([
                    'status' => 'success',
                    'message' => "Admin Successfully Create",
                ], 200);
            }
        } catch (Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id){
        $getData = User::where("id",$id)->get();
        return response([
            "status" => "success",
            "data" => $getData
        ]);
    }

    public function  allAdmin(){
        $allAdmin = User::where("user_role_id",2)->get();
        return response([
            "status" => "success",
            "data" => $allAdmin
        ]);
    }
    public function  allSuperAdmin(){
        $allSuperAdmin = User::where("user_role_id",1)->get();
        return response([
            "status" => "success",
            "data" => $allSuperAdmin
        ]);
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

    public  function  update(Request $request,$id){
//        dd($request);
        try {
            $validate = Validator::make(request()->all(), [
                "name" => 'required',
                "phone" => 'required',
//                    'image' => 'required'
            ]);

//            dd($validate->errors()->messages());

            if ($validate->fails()) {
                $errors = $validate->errors()->messages();
                return validateError($errors);
            }
            $access = '';
            if (!empty($request->access)) {
                $access = json_encode($request->access);
            }
            $admin =  User::where('id',$id)->first();
            $admin->name = $request->name?? $admin->name;
            $admin->phone = $request->phone ?? $admin->phone;
            $admin->image = $request->image ?? $admin->image;
            $admin->access = $access ?? $admin->access;
            $admin->user_role_id = $request->user_role_id ?? $admin->user_role_id;
            if ($admin->update()) {
                return response([
                    'status' => 'success',
                    'message' => "Admin Successfully Update",
                ], 200);
            }
        } catch (Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
//        dd($request->all());
        try {
            $validate = Validator::make(request()->all(), [
                "name" => 'required',
                "phone" => 'required',
//                    'image' => 'required'
            ]);
            if ($validate->fails()) {
                $errors = $validate->errors()->messages();
                return validateError($errors);
            }

            $target = User::where('id', $request->id)->first();
            // dd($target);
            $target->name  = $request->name ?? $target->name;
            $target->phone = $request->phone ?? $target->phone;
            $target->image = $request->image ?? $target->image;
            if ($target->update()) {
                return response([
                    'status'  => 'success',
                    'message' => 'Profile updated successfully',
                ], 200);
            }

        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function profileChangePassword(Request $request)
    {
//         dd($request->all());
        $validate = Validator::make(request()->all(), [
            'current_password' => 'required|min:6',
            'new_password'     => 'required|min:6',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors()->messages();
            return validateError($errors);
        }

        try {
            $user = User::where('id',$request->id)->first();
//            dd($user->password);
            if (Hash::check(request('current_password'), $user->password)) {
                $user->password = Hash::make(request('new_password'));
                $user->update();
                return response([
                    'status'  => 'success',
                    'message' => 'Password changed successfully',
                ], 200);
            } else {
                $errors = [
                    'current_password' => ['Current password not matched...'],
                ];
                return validateError($errors);
                // return response([
                //     'status' => 'validate_error',
                //     'data'   => [
                //         'current_password' => ['Current password not matched...'],
                //     ],
                // ], 422);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function searchAdmin(Request $request){

//        dd($request->all());

        $searchData = User::where('status', 'active');
        //begin filtering
        $searchText = $request->searchdata;
//        dd($searchText);
        if (!empty($searchText)) {
            $searchData->where(function ($query) use ($searchText) {
                $query->where('name', 'LIKE', '%' . $searchText . '%');
            });
        }
        //end filtering
        $searchData = $searchData->get();
        return response([
            'status' => 'success',
            'data' => $searchData,
        ], 200);
    }

    public function destroy($id){
        $deleteUser = User::where('id',$id)->delete();
        if($deleteUser){
            return response([
                'status' => 'success',
                'message' => "Blog Successfully Delete",
            ], 200);
        }
    }

}
