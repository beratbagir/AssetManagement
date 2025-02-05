<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\License;
use App\Models\Manufacturers;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query()->with(['category']) 

    ->search($request->input('search'))
            ->filterByCategory($request->input('category_id'));

    $sortableColumns = ['product_name', 'brand', 'support_expire_date', 'purchase_date', 'cost'];
    $sort = $request->get('sort', 'name');
    $direction = $request->get('direction', 'asc');

    $sort = $request->get('sort', 'product_name'); 
    $direction = $request->get('direction', 'asc'); 

    // Scope'ları kullanarak sıralama işlemleri
    switch ($sort) {
        case 'product_name':
            $query->sortByProductName($direction);
            break;

        case 'support_expire_date':
            $query->sortBySupportExpireDate($direction);
            break;

        case 'purchase_date':
            $query->sortByPurchaseDate($direction);
            break;

        case 'cost':
            $query->sortByCost($direction);
            break;

        default:
            $query->sortByProductName($direction); // Varsayılan sıralama
            break;
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

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());

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

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
