<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class LicenceController extends Controller
{
    public function index(Request $request)
{
    $query = Licence::with('product'); // Licence ile birlikte Product ilişkisini getir

    // Eğer arama yapılmışsa filtre uygula
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('product_id', 'like', '%' . $search . '%');
        });
    }

    if ($request->filled('licence_id')) {
        $query->where('licence_id', $request->licence_id);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $sortableColumns = ['licence_id', 'licence_key', 'cost', 'expiration_date', 'status', 'product_id'];
    $sort = $request->get('sort', 'licence_id');
    $direction = $request->get('direction', 'asc');

    if ($sort === 'licence_id') {
        $query->orderBy('licence_id', $direction);
    }

    if ($sort === 'licence_key') {
        $query->orderBy('licence_key', $direction);
    }

    if ($sort === 'cost') {
        $query->orderBy('cost', $direction);
    }

    if ($sort === 'expiration_date') {
        $query->orderBy('expiration_date', $direction);
    }

    if ($sort === 'status') {
        $query->orderBy('status', $direction);
    }

    if ($sort === 'product_id') {
        $query->orderBy('product_id', $direction);
    }


    // Filtrelenmiş ve ilişkilendirilmiş lisansları al
    $licences = $query->paginate(10)->appends(request()->query()); // Sayfalama ekle

    // Ürünlerin tam listesini al (eğer gerekliyse)
    $products = Product::all();

    return view('licences.index', compact('licences', 'products'));
}


    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('licences.create', compact('products', 'suppliers'));
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
        $suppliers = Supplier::all();
        $licence = Licence::findOrFail($id);
        $products = Product::all();
        return view('licences.edit', compact('licence', 'suppliers', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'licence_key' => 'required|string|max:255',
            'expiration_date' => 'required|date',
            'supplier_id' => 'nullable|exists:suppliers,supplier_id',
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
