<?php

namespace App\Http\Controllers;
use App\Models\Accessory;
use App\Models\Category;
use App\Models\Companies;
use App\Models\Supplier;
use App\Http\Requests\AccessoriesUpdateRequest;
use App\Http\Requests\AccessoriesStoreRequest;
use App\Models\Manufacturers;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    
    $accessories = Accessory::search($search)->get();
    $manufacturers = Manufacturers::all();
    $suppliers = Supplier::all();
    $categories = Category::all();
    $companies = Companies::all();
    
    return view('accessories.index', compact('categories', 'suppliers', 'manufacturers', 'companies', 'accessories'));
}


    public function create()
    {
        $accessories = Accessory::all();
        $manufacturers = Manufacturers::all();
        $suppliers = Supplier::all();
        $categories = Category::all();
        $companies = Companies::all();
        return view('accessories.create', compact('categories', 'suppliers', 'manufacturers', 'companies', 'accessories'));
    }

    public function store(AccessoriesStoreRequest $request)
{
    Accessory::create($request->validated());

    return redirect()->route('accessories.index')
        ->with('success', 'Accessory created successfully.');
}

    public function edit($id)
    {
        $accessory = Accessory::findOrFail($id);
        $suppliers = Supplier::all();
        $manufacturers = Manufacturers::all();
        $categories = Category::all();
        $companies = Companies::all();
        return view('accessories.edit', compact('accessory', 'categories', 'suppliers', 'manufacturers', 'companies'));
    }

    public function update(AccessoriesUpdateRequest $request, $id)
{
    $accessory = Accessory::findOrFail($id);
    $accessory->update($request->validated());

    return redirect()->route('accessories.index')
        ->with('success', 'Accessory updated successfully');
}


    public function destroy($id)
    {
        $accessory = Accessory::findOrFail($id);
        $accessory->delete();

        return redirect()->route('accessories.index')
            ->with('success', 'Accessory deleted successfully');
    }

}
