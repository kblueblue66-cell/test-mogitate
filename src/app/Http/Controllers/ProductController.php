<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    $query = Product::query();

    if ($request->filled('keyword')) {
        $query->where('name', 'LIKE', '%' . $request->keyword . '%');
    }

    if ($request->filled('sort')) {
        if ($request->sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('price', 'desc');
        }
    } else {
        $query->latest();
    }

    $products = $query->paginate(6)->appends($request->all());

        return view('products.index',compact('products'));
    }

    public function create()
    {
        return view('products.register');
    }

    public function store(ProductRequest $request)
    {
        $imagePath = $request->file('image')->store('images','public');

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $imagePath;
        $product->description = $request->description;
        $product->save();

        if ($request->has('seasons')) {
        $product->seasons()->attach($request->seasons);
    }

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show',compact('product'));
    }

    public function update(ProductRequest $request,$id)
    {
        $product = Product::findOrFail($id);

        $updateData = $request->only(['name', 'price', 'description']);

    if ($request->hasFile('image')){
        if ($product->image){
            Storage::disk('public')->delete($product->image);
            $updateData['image'] = $request->file('image')->store('images', 'public');
    }
        $product->update($updateData);
        $product->seasons()->sync($request->seasons);

        return redirect()->route('products.index');
    }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if($product->image){
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index');
    }
}
