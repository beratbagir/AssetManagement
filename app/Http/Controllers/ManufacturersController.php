<?php

namespace App\Http\Controllers;
use App\Models\Manufacturers;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{
    public function index(Request $request)
    {
        $manufacturers = Manufacturers::withCount('products')->get();
        return view('manufacturers.index', compact('manufacturers'));
    }

    public function create()
    {
        return view('manufacturers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'support_email' => 'required|email',
            'support_phone' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'support_url' => 'required|string|max:255',
            'warranty_lookup_url' => 'required|string|max:255',
        ]);

        Manufacturers::create($request->all());
        return redirect()->route('manufacturer.index');
    }

    public function edit($id)
    {
        $manufacturer = Manufacturers::findOrFail($id);
        return view('manufacturers.edit', compact('manufacturer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'support_email' => 'required|email',
            'support_phone' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'support_url' => 'required|string|max:255',
            'warranty_lookup_url' => 'required|string|max:255',
        ]);

        $manufacturer = Manufacturers::findOrFail($id);
        $manufacturer->update($request->all());

        return redirect()->route('manufacturer.index');
    }

    public function destroy($id)
    {
        $manufacturer = Manufacturers::findOrFail($id);
        $manufacturer->delete();
        return redirect()->route('manufacturer.index');
    }

}
