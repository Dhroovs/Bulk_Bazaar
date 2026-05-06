<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $currentQty = $cart[$id]['quantity'] ?? 0;

        // 🔥 STOCK CHECK
        if ($currentQty >= $product->stock) {
            return redirect('/cart')->with('error', 'Stock limit reached');
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect('/cart')->with('success', 'Product added');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect('/cart')->with('success', 'Item removed');
    }

    public function increase($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {

            // 🔥 STOCK CHECK
            if ($cart[$id]['quantity'] >= $product->stock) {
                return redirect('/cart')->with('error', 'Stock limit reached');
            }

            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }

        return redirect('/cart');
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return redirect('/cart');
    }
}