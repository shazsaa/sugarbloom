<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user', 'items');

        if ($search = $request->input('search')) {
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
        }

        $orders = $query->latest()->paginate(15);

        return view('admin.orders.list', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'items')->findOrFail($id);

        $products = $order->items->map(function ($item) {
            return [
                'name' => $item->product_title,
                'quantity' => $item->quantity
            ];
        });

        return response()->json([
            'id' => $order->id,
            'name' => $order->user->name,
            'email' => $order->user->email,
            'address' => $order->address,
            'products' => $products,
            'payment' => $order->payment,
            'subTotal' => number_format($order->sub_total, 2, ',', '.'),
            'grandTotal' => number_format($order->grand_total, 2, ',', '.'),
            'shipping' => [
                'type' => $order->shipping_type,
                'cost' => number_format($order->shipping_price, 2, ',', '.')
            ]
        ]);
    }

    public function update(Request $request, Order $order)
    {
        try {
            $order->update(['status' => $request->status]);
            return redirect()->route('order.list')->with('success',  'Order Id #' . $order->id . ' status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('order.list')->with('error',  'Order Id #' . $order->id . ' status failed to update.');
        }
    }
}
