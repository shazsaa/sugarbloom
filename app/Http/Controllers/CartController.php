<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $shippings = Shipping::all();

        $cartTotal = 0;

        foreach ($cartItems as $item) {
            $cartTotal += $item->product->price * $item->quantity;
        }

        return view('customer.cart', compact('cartItems', 'shippings', 'cartTotal'));
    }

    public function store(Request $request)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id == Auth::id()) {
            $cart->update(['quantity' => $request->quantity]);
            return redirect()->route('cart.index')->with('success',  $cart->product->title . ' quantity updated successfully.');
        }

        return redirect()->route('cart.index')->with('error',  $cart->product->title . ' quantity failed to update.');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id == Auth::id()) {
            $cart->delete();
            return redirect()->route('cart.index')->with('success',  $cart->product->title . ' deleted successfully.');
        }

        return redirect()->route('cart.index')->with('error',  $cart->product->title . ' failed to delete.');
    }
}
