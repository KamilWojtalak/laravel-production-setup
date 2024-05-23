<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::get();

        return view('orders.index', [
            'orders' => $orders
        ]);
    }
}
