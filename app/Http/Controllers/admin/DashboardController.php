<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::count();
        $products = Product::count();
        $customers = Order::distinct('user_id')->count('user_id');

        return view('admin.dashboard', compact('orders', 'products', 'customers'));
    }
}
