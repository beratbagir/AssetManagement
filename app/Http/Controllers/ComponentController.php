<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use App\Models\Component;
use App\Models\Category;
use App\Models\Manufacturers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $components = Component::search($search)->get();
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('components.index', compact('components', 'categories', 'suppliers'));
    }

    public function create()
    {
        $manufacturers = Manufacturers::all();
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('components.create', compact('categories', 'suppliers', 'manufacturers'));
    }

    public function store(StoreComponentRequest $request)
    {
        Component::create($request->all());

        return redirect()->route('components.index')
            ->with('success', 'Component created successfully.');
    }

    public function edit($id)
{
    $component = Component::findOrFail($id);
    $categories = Category::all();
    $suppliers = Supplier::all();
    $manufacturers = Manufacturers::all();

    return view('components.edit', compact('component', 'categories', 'suppliers', 'manufacturers'));
}

    public function update(UpdateComponentRequest $request, $id)
    {
        $component = Component::findOrFail($id);
        $component->update($request->all());

        return redirect()->route('components.index')
            ->with('success', 'Component updated successfully');
    }

    public function destroy($id)
    {
        $component = Component::findOrFail($id);
        $component->delete();

        return redirect()->route('components.index')
            ->with('success', 'Component deleted successfully');
    }

}
