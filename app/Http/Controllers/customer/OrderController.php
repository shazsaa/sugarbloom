<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders;

        return view('customer.order-history', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        if (Gate::authorize('view', $order)) {
            return view('customer.order-details', compact('order'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_type' => 'required',
            'shipping_price' => 'required|numeric',
            'payment' => 'required|string',
            'address' => 'required|string',
        ]);

        $cartItems = Auth::user()->cartItems;
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subTotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $shippingPrice = (float) $request->shipping_price;
        $grandTotal = $subTotal + $shippingPrice;

        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_type' => $request->shipping_type,
            'shipping_price' => $shippingPrice,
            'sub_total' => $subTotal,
            'grand_total' => $grandTotal,
            'payment' => $request->payment,
            'address' => $request->address,
            'status' => 'Pending',
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_title' => $item->product->title,
                'product_category' => $item->product->category->name,
                'product_description' => $item->product->description,
                'product_image' => $item->product->product_image,
                'product_price' => $item->product->price,
                'quantity' => $item->quantity,
                'total' => $item->product->price * $item->quantity,
            ]);
        }

        $cartItems->each->delete();

        return redirect()->route('orderHistory')->with('success', 'Order placed successfully!');
    }
}
