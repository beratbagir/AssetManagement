<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Models\Asset;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Product;
use App\Models\Licence;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {

        $query = Supplier::query()
        ->search($request->input('search')); 
        
        $suppliers = $query->withCount('licences', 'products') 
    ->paginate(10) 
    ->appends(request()->query());
        
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $licences = Licence::all();
        return view('suppliers.create', compact('products', 'licences', 'suppliers'));
    }

    public function store(StoreSupplierRequest $request)
    {
        Supplier::create($request->validated());
        return redirect()->route('supplier.index');
    }

    public function edit($id)
    {
        $assets = Asset::all();
        $licences = Licence::all();
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier', 'assets', 'licences'));
    }

    public function update(UpdateSupplierRequest $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->validated());
        return redirect()->route('supplier.index');
    }

    public function destroy($id)
    {
        $assets = Asset::all();
        $licences = Licence::all();
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('supplier.index', compact('assets', 'licences'));
    }

}
