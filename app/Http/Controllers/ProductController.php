<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $products = Product::with('category')->get();
        return view('product.index',compact('products'));
    }
    public function create(){
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $imageName = time() . '.' . $request->image->extension();
        Storage::putFileAs('public/product', $request->image, $imageName);
        $product = Product::create([
            'product_name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
        ]);

        return redirect()->route('product.index');
    }
    public function edit($id)
    {
        $product = Product::where('id', $id)->with('category')->first();
        $categories = Category::all();

        return view('product.edit', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $old_image = Product::find($id)->image;
            Storage::delete('public/product/'.$old_image);
            $imageName = time() . '.' . $request->image->extension();
            Storage::putFileAs('public/product', $request->image, $imageName);
            Product::where('id', $id)->update([
                'product_name' => $request->name,
                'category_id' => $request->category,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $imageName,
            ]);
        } else {
            Product::where('id', $id)->update([
                'product_name' => $request->name,
                'category_id' => $request->category,
                'description' => $request->description,
                'price' => $request->price,
            ]);
        }

        return redirect()->route('product.index');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('product.index');
    }
}