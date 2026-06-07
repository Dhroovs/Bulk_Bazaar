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
        $allowed = ['pending', 'approved', 'processing', 'shipped', 'delivered', 'cancelled', 'rejected'];

        if (!in_array($status, $allowed)) {
            return redirect('/admin/orders')->with('error', 'Invalid status');
        }

        $order = Order::with('items.product')->findOrFail($id);

        if ($status === 'delivered' && $order->status !== 'delivered') {
            foreach ($order->items as $item) {
                if ($item->product && $item->product->vendor_id) {
                    $vendor = \App\Models\User::find($item->product->vendor_id);
                    if ($vendor && $vendor->vendorProfile) {
                        $profile = $vendor->vendorProfile;
                        $itemRevenue = $item->price * $item->quantity;
                        $commission = $itemRevenue * ($profile->commission_rate / 100);
                        $netEarnings = $itemRevenue - $commission;
                        
                        $profile->earnings += $netEarnings;
                        $profile->save();
                    }
                }
            }
        }

        $order->status = $status;
        $order->save();

        return redirect('/admin/orders')->with('success', 'Status updated');
    }
}