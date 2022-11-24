<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Post;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Direct user home page
    public function homePage()
    {
        $category = Category::get();
        $postData = Post::get();
        if (Auth::user() != null) {
            $cart = Cart::where('user_id', Auth::user()->id)->get();
        } else {
            $cart = [];
        }
        $post = Post::when(request('key'), function ($query) {
            $query->orWhere('post_name', 'LIKE', '%' . request('key') . '%')
                ->orWhere('post_description', 'LIKE', '%' . request('key') . '%');
        })->orderBy('created_at', 'desc')->paginate(8);
        return view('user.post.postList', compact('category', 'post', 'postData', 'cart'));
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect('user/home');
    }

    //filter
    public function filterCategory($cid)
    {
        $category = Category::get();
        $postData = Post::get();
        if (Auth::user() != null) {
            $cart = Cart::where('user_id', Auth::user()->id)->get();
        } else {
            $cart = [];
        }
        if ($cid == 'all') {
            return redirect('/user/home');
        }
        $post = Post::where('post_category', $cid)->paginate(8);
        return view('user.post.postList', compact('category', 'post', 'postData', 'cart'));
    }

    //post details
    public function postDetails($id)
    {
        $category = Category::get();
        $postData = Post::get();
        if (Auth::user() != null) {
            $cart = Cart::where('user_id', Auth::user()->id)->get();
        } else {
            $cart = [];
        }
        $data = Post::select('posts.*', 'categories.category_name as c_name')
            ->leftJoin('categories', 'posts.post_category', 'categories.id')
            ->where('post_id', $id)->first();
        return view('user.post.details', compact('category', 'data', 'postData', 'cart'));
    }

    //Direct history page
    public function history()
    {
        $category = Category::get();
        $postData = Post::get();
        if (Auth::user() != null) {
            $cart = Cart::where('user_id', Auth::user()->id)->get();
        } else {
            $cart = [];
        }
        $post = Post::when(request('key'), function ($query) {
            $query->orWhere('post_name', 'LIKE', '%' . request('key') . '%')
                ->orWhere('post_description', 'LIKE', '%' . request('key') . '%');
        })->orderBy('created_at', 'desc')->paginate(8);
        $order = Order::where('user_id', Auth::user()->id)->get();
        return view('user.cart.history', compact('category', 'post', 'postData', 'cart', 'order'));
    }
}