<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    // CHECKOUT (CREATE ORDER + REDUCE STOCK)
    public function checkout()
{
    $cart = session()->get('cart');

    if(!$cart || count($cart) == 0) {
        return "Cart is empty ❌";
    }
    

    $total = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // 🔥 FINAL STOCK VALIDATION
foreach ($cart as $id => $item) {
    $product = \App\Models\Product::find($id);

    if ($product->stock < $item['quantity']) {
        return "Stock not available for " . $product->name . " ❌";
    }
}

    // CREATE ORDER
    $order = Order::create([
        'user_id' => auth()->id(),
        'total_price' => $total,
        'status' => 'pending'
    ]);

    // SAVE ITEMS + REDUCE STOCK
    foreach ($cart as $id => $item) {

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $id,
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ]);

        // 🔥 REDUCE STOCK
        $product = \App\Models\Product::find($id);
        if ($product) {
            $product->stock -= $item['quantity'];
            $product->save();
        }
    }

    // CLEAR CART
    session()->forget('cart');

    return redirect('/my-orders')
    ->with('success', 'Order placed successfully!');
}

    // MY ORDERS
    public function myOrders()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->get();

        return view('orders.index', compact('orders'));
    }

    // CANCEL ORDER + RESTORE STOCK
    public function cancel($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        // SECURITY CHECK
        if ($order->user_id != auth()->id()) {
            return "Unauthorized ❌";
        }

        if ($order->status != 'paid') {
            return "Cannot cancel this order ❌";
        }

        // RESTORE STOCK
        foreach ($order->items as $item) {
            $product = $item->product;
            $product->stock += $item->quantity;
            $product->save();
        }

        $order->status = 'cancelled';
        $order->save();

        return redirect('/my-orders')->with('success', 'Order cancelled');
    }
}