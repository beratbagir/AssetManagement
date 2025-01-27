<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Models\Asset;
use App\Models\Product;
use App\Models\Licence;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        
        $suppliers = Supplier::withCount( 'licences', 'products')->get();
        
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $licences = Licence::all();
        return view('suppliers.create', compact('products', 'licences', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
        ]);

        Supplier::create($request->all());
        return redirect()->route('supplier.index');
    }

    public function edit($id)
    {
        $assets = Asset::all();
        $licences = Licence::all();
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier', 'assets', 'licences'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
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
