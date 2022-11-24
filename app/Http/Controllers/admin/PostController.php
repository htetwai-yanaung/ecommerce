<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //Direct post page
    public function postPage()
    {
        $post = Post::when(request('key'), function ($query) {
            $query->orWhere('post_name', 'LIKE', '%' . request('key') . '%')
                ->orWhere('post_description', 'LIKE', '%' . request('key') . '%');
        })->orderBy('created_at', 'desc')->paginate(4);
        $category = Category::get();
        return view('admin.post', compact('category', 'post'));
    }

    //Create post
    public function postCreate(Request $request)
    {
        // dd($request->all());
        $this->checkPostValidation(($request));
        $imageName = uniqid() . '_' . $request->file('postImage')->getClientOriginalName();
        $request->file('postImage')->storeAs('public/image', $imageName);
        $data = [
            'post_name' => $request->postName,
            'post_category' => $request->postCategory,
            'post_description' => $request->postDescription,
            'post_price' => $request->postPrice,
            'post_image' => $imageName,
        ];
        Post::create($data);
        return back()->with(['createSuccess' => 'Post create success.']);
    }

    //Delete post
    public function postDelete($id)
    {
        //63693749e6f5c_image_1.jpg
        $post = Post::where('post_id', $id)->first();
        $image = $post->post_image;
        if (File::exists(public_path() . '/storage/image/' . $image)) {
            File::delete(public_path() . '/storage/image/' . $image);
        }
        Post::where('post_id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Post delete success.']);
    }

    //Edit page
    public function postEdit($id)
    {
        $category = Category::get();
        $postData = Post::where('post_id', $id)->first();
        return view('admin.postEdit', compact('category', 'postData'));
    }

    //Post update
    public function postUpdate(Request $request)
    {
        $this->checkPostValidation($request);
        $dbImage = $request->dbImage;
        $newImage = uniqid() . '_' . $request->file('postImage')->getClientOriginalName();

        if (File::exists(public_path() . '/storage/image/' . $dbImage)) {
            File::delete(public_path() . '/storage/image/' . $dbImage);
        }

        $request->file('postImage')->move(public_path() . '/storage/image/', $newImage);

        $updateData = [
            'post_name' => $request->postName,
            'post_description' => $request->postDescription,
            'post_category' => $request->postCategory,
            'post_price' => $request->postPrice,
            'post_image' => $newImage,
        ];

        Post::where('post_id', $request->postId)->update($updateData);
        $post = Post::orderBy('created_at', 'desc')->paginate(4);
        $category = Category::get();
        return view('admin.post', compact('category', 'post'))->with(['updateSuccess' => 'Post update success.']);
    }






    //Check post validation
    private function checkPostValidation($request)
    {
        Validator::make($request->all(), [
            'postName' => 'required',
            'postCategory' => 'required',
            'postDescription' => 'required',
            'postPrice' => 'required',
            'postImage' => 'required|mimes:jpg,jpeg,png,webp',
        ])->validate();
    }
}