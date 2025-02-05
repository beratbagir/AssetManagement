<?php

namespace App\Http\Controllers;
use App\Models\Manufacturers;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{
    public function index(Request $request)
    {
    $query = Manufacturers::query()
    ->search($request->input('search')); 

    $manufacturers = $query->withCount('products') 
    ->paginate(10) 
    ->appends(request()->query());
        return view('manufacturers.index', compact('manufacturers'));
    }

    public function create()
    {
        return view('manufacturers.create');
    }

    public function store(StoreManufacturerRequest $request)
    {
        Manufacturers::create($request->validated());
        return redirect()->route('manufacturer.index');
    }

    public function edit($id)
    {
        $manufacturer = Manufacturers::findOrFail($id);
        return view('manufacturers.edit', compact('manufacturer'));
    }

    public function update(UpdateManufacturerRequest $request, $id)
    {
        $manufacturer = Manufacturers::findOrFail($id);
        $manufacturer->update($request->validated());

        return redirect()->route('manufacturer.index');
    }

    public function destroy($id)
    {
        $manufacturer = Manufacturers::findOrFail($id);
        $manufacturer->delete();
        return redirect()->route('manufacturer.index');
    }

}
