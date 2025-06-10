<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($search = $request->input('search')) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        }

        $products = $query->latest()->paginate(9);

        return view('admin.products.list', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'category' => 'required'
        ]);

        if ($request->hasFile('product_image')) {
            $customPath = 'uploads/products';
            $image = $request->file('product_image');
            $imageName = $image->hashName();
            $image->move(public_path($customPath), $imageName);
            $imagePath = $customPath . '/' . $imageName;
        }

        Product::create([
            'category_id' => $request->category,
            'product_image' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('product.list')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'category' => 'required'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('product_image')) {
            $customPath = 'uploads/products';
            $image = $request->file('product_image');
            $imageName = $image->hashName();
            $image->move(public_path($customPath), $imageName);
            $imagePath = $customPath . '/' . $imageName;

            File::delete($product->product_image);

            $product->update([
                'category_id' => $request->category,
                'product_image' => $imagePath,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);
        } else {
            $product->update([
                'category_id' => $request->category,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);
        }

        return redirect()->route('product.list')->with('success', 'Product edited successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $filePath = public_path($product->product_image);

        if (File::exists($filePath)) {
            File::delete($filePath);
        } else {
            return redirect()->route('product.list')->with(['error' => 'File not found. Product not deleted.']);
        }

        $product->delete();

        return redirect()->route('product.list')->with(['success' => 'Product deleted successfully!']);
    }
}
