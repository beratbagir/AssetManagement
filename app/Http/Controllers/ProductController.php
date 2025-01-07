<?php

namespace App\Http\Controllers;
use App\Models\Licence;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $licences = Licence::with('product')->get();
        return view('products', compact('products', 'licences'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'support_expire_date' => 'required|date',
            'purchase_date' => 'required|date',
            'cost' => 'required|integer'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::all();
        $licences = Licence::with('product')->get();
        return view('products.edit', compact('product', 'products', 'licences'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'support_expire_date' => 'required|date',
            'purchase_date' => 'required|date',
            'cost' => 'required|integer'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
