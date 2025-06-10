<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $query = Wishlist::where('user_id', Auth::id())->with('product');

        if ($search = $request->input('search')) {
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }

        $wishlists = $query->paginate(9);

        return view('customer.wishlist', compact('wishlists'));
    }

    public function store($id)
    {
        $wishlist = Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
        ]);

        if ($wishlist) {
            return redirect()->route('products.show', $id)->with('success', 'Product successfully added to wishlist');
        }

        return redirect()->route('products.show', $id)->with('error', 'Product failed to add to wishlist');
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::where('product_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return redirect()->route('products.show', $id)->with('success', 'Product successfully deleted from wishlist');
        }

        return redirect()->route('products.show', $id)->with('error', 'Product not found in your wishlist');
    }
}
