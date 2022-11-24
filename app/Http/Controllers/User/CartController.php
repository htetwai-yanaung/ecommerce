<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Post;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //Direct cart page
    public function cartList()
    {
        $postData = Post::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $cartData = Cart::select('carts.*', 'posts.post_name as postName', 'posts.post_price as price', 'posts.post_id as postId')
            ->leftJoin('posts', 'carts.post_id', 'posts.post_id')
            ->get();
        return view('user.cart.list', compact('postData', 'cartData', 'cart'));
    }

    public function cartOrder()
    {
        $data = [
            'user_id' => Auth::user()->id,
            'post_id' => request('postId'),
            'qty' => request('qty')
        ];
        Cart::create($data);
        return $data;
    }

    //current order delete
    public function cartOrderDelete()
    {
        $cartId = request('cartId');
        Cart::where('id', $cartId)->delete();
        return $cartId;
    }

    //clear cart
    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
        $data = ['message' => 'cart clear success'];
        return $data;
    }

    //final order
    public function order(Request $request)
    {
        $total = 2000;
        foreach ($request->all() as $item) {
            $data = OrderList::create($item);
            $total += $data->total;
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $total,
            'order_code' => $data->order_code
        ]);

        return response()->json(['message' => 'order success'], 200);
    }
}