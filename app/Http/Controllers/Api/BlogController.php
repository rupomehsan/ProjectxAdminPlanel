<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Validator;

class BlogController extends Controller
{
    public function store(Request $request)
    {
//        dd($request->all());
            try {
                $validate = Validator::make(request()->all(), [
                   "title" => 'required',
                   "description" => 'required',
//                    'image' => 'required'
                ]);

//            dd($validate->errors()->messages());

                if ($validate->fails()) {
                    $errors = $validate->errors()->messages();
                    return validateError($errors);
                }

                $blog = new Blog;
                $blog->title = $request->title;
                $blog->description = $request->description;
                $blog->image = $request->image;
                if ($blog->save()) {
                    return response([
                        'status' => 'success',
                        'message' => "Blog Successfully Create",
                    ], 200);
                }
            } catch (Exception$e) {
                return response([
                    'status' => 'server_error',
                    'message' => $e->getMessage(),
                ], 500);
            }
    }

    public function getAll(){
        $getAllBlog = Blog::all();
        if($getAllBlog){
            return response([
                'status' => 'success',
                'data' => $getAllBlog,
            ], 200);
        }
    }

    public function show($id){
        $getBlog = Blog::where('id',$id)->first();
        return view('admin.blog.edit',compact('getBlog'));

    }

    public function update(Request $request ,$id){
//        dd($request->all());
        try {
            $validate = Validator::make(request()->all(), [
                "title" => 'required',
                "description" => 'required',
//                    'image' => 'required'
            ]);
            if ($validate->fails()) {
                $errors = $validate->errors()->messages();
                return validateError($errors);
            }
            $blog = Blog::where('id',$id)->first();
            $blog->title = $request->title ?? $blog->title;
            $blog->description = $request->description ?? $blog->description;
            $blog->image = $request->image ??  $blog->image;
            if ($blog->save()) {
                return response([
                    'status' => 'success',
                    'message' => "Blog Successfully Update",
                ], 200);
            }
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

    public function searchBlog(Request $request){

//        dd($request->searchdata);

        $searchData = Blog::where('status', 'active');
        //begin filtering
        $searchText = $request->searchdata;
//        dd($searchText);
        if (!empty($searchText)) {
            $searchData->where(function ($query) use ($searchText) {
                $query->where('title', 'LIKE', '%' . $searchText . '%');
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
        $deleteBlog = Blog::where('id',$id)->delete();
        if($deleteBlog){
            return response([
                'status' => 'success',
                'message' => "Blog Successfully Delete",
            ], 200);
        }
    }

}
