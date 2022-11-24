<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //Direct Order page
    public function orderPage()
    {
        $data = Order::select('orders.*', 'users.name as userName')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->when(request('key'), function ($query) {
                $query->orWhere('users.name', 'LIKE', request('key'))
                    ->orWhere('orders.order_code', 'LIKE', request('key'));
            })
            ->get();
        return view('admin.order', compact('data'));
    }

    //Change order state
    public function orderState(Request $request)
    {
        Order::where('order_code', $request->order_code)->update([
            'order_state' => $request->order_state,
        ]);
        return response()->json(['message' => 'success'], 200);
    }
}