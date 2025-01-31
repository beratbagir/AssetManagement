<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\License;
use App\Models\Manufacturers;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query()->with(['category']); // with() doğrudan sorguya ekleniyor

    // Eğer arama sorgusu varsa filtre uygula
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    };

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $sortableColumns = ['product_name', 'brand', 'support_expire_date', 'purchase_date', 'cost'];
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');

        if ($sort === 'product_name') {
            $query->orderBy('product_name', $direction);
        }

        if ($sort === 'support_expire_date') {
            $query->orderBy('support_expire_date', $direction);
        }

        if ($sort === 'purchase_date') {
            $query->orderBy('purchase_date', $direction);
        }

        if ($sort === 'cost') {
            $query->orderBy('cost', $direction);
        }

    $products = $query->paginate(10)->appends(request()->query()); 
    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
}


    public function showProductHistory($productId)
    {
        $product = Product::with('assets.assignedUser')->findOrFail($productId);

        return view('products.history', compact('product'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $manufacturers = Manufacturers::all();
        $categories = Category::all();
        return view('products.create', compact('categories', 'suppliers', 'manufacturers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
            'product_name' => 'required|string|max:255',
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
        $manufacturers = Manufacturers::all();
        $suppliers = Supplier::all();
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories', 'suppliers', 'manufacturers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
            'category_id' => 'required|exists:categories,id',
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
