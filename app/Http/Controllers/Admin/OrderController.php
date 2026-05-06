<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    // SHOW ALL ORDERS
    public function index()
    {
        $orders = Order::with('items.product', 'user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // UPDATE STATUS
    public function updateStatus($id, $status)
    {
        $allowed = ['pending', 'shipped', 'delivered'];

        if (!in_array($status, $allowed)) {
            return redirect('/admin/orders')->with('error', 'Invalid status');
        }

        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        return redirect('/admin/orders')->with('success', 'Status updated');
    }
}