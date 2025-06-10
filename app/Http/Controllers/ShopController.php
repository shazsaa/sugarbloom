<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($search = $request->input('search')) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($sort = $request->input('sort')) {
            if ($sort === 'highest') {
                $query->orderBy('price', 'desc');
            } elseif ($sort === 'lowest') {
                $query->orderBy('price', 'asc');
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(9);

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $similar_products = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $inWishlist = Wishlist::where('product_id', $id)
            ->where('user_id', Auth::id())
            ->exists();

        return view('products.details', compact('product', 'similar_products', 'inWishlist'));
    }
}
