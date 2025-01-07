<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Product;
use Illuminate\Http\Request;

class LicenceController extends Controller
{
    public function index()
    {
        $licences = Licence::with('product')->get();
        $products = Product::all();
        return view('products', compact('licences', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('licences.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'licence_key' => 'required|string|max:255',
            'expiration_date' => 'required|date',
            'cost' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);

        $licence = Licence::create($request->all());

        return redirect()->route('licences.index')
            ->with('success', 'Licence created successfully.');
    }

    public function edit($id)
    {
        $licence = Licence::findOrFail($id);
        $products = Product::all();
        return view('licences.edit', compact('licence', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'licence_key' => 'required|string|max:255',
            'expiration_date' => 'required|date',
            'cost' => 'required|integer',
            'status' => 'required|string|max:255',
        ]);

        $licence = Licence::findOrFail($id);
        $licence->update($request->all());

        return redirect()->route('licences.index')
            ->with('success', 'Licence updated successfully.');
    }

    public function destroy($id)
    {
        $licence = Licence::findOrFail($id);
        $licence->delete();

        return redirect()->route('licences.index')->with('success', 'Licence deleted successfully.');
    }
    
}
