<?php

namespace App\Http\Controllers;
use App\Models\UsersProduct;
use App\Models\Department;
use App\Models\Product;
use App\Models\Asset;
use Illuminate\Http\Request;

class UsersProductController extends Controller
{
    public function index(Request $request)
{
    $query = UsersProduct::query();
    
    $query = UsersProduct::with('product')
            ->search($request->input('search'));
            

    $sort = $request->get('sort', 'id');
    $direction = $request->get('direction', 'asc');
    $query->sortBy($sort, $direction);

    $products = Product::all();
    $departments = Department::all();
    $usersProducts = $query->paginate(10)->appends(request()->query());


    return view('userproduct.index', compact('usersProducts', 'products', 'departments'));
}


    public function create()
    {
        $departments = Department::all();
        return view('userproduct.create', compact( 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        UsersProduct::create($request->all());

        return redirect()->route('users.index')->with('success', 'UsersProduct created successfully.');
    }

    public function edit($id)
    {
        $usersProducts = UsersProduct::findOrFail($id);
        $products = Product::all();
        $departments = Department::all();
        return view('userproduct.edit', compact('usersProducts', 'products', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $usersProducts = UsersProduct::findOrFail($id);
        $usersProducts->update($request->all());

        return redirect()->route('users.index')->with('success', 'UsersProduct updated successfully');
    }

    public function destroy($id)
    {
        $usersProducts = UsersProduct::findOrFail($id);
        $usersProducts->delete();

        return redirect()->route('users.index')
            ->with('success', 'UsersProduct deleted successfully');
    }
}
