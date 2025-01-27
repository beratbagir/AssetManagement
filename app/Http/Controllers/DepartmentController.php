<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Companies;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {   
        $query = Department::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        // Şirket filtresi
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        $sortableColumns = ['name', 'company_id'];
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');

        if ($sort === 'name') {
            $query->orderBy('name', $direction);
        }

        if ($sort === 'company_id') {
            $query->orderBy('company_id', $direction);
        }

        $departments = $query->paginate(10)->appends(request()->query());
        $companies = Companies::all();
        
        return view('departments.index', compact('departments', 'companies'));
    }

    public function create()
    {
        $companies = Companies::all();
        $departments = Department::all();
        return view('departments.create', compact('companies', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
        ]);

        Department::create([
            'name' => $request->name,
            'company_id' => $request->company_id,
        ]);

        // Başarı mesajıyla yönlendir
        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $companies = Companies::all();
        return view('departments.edit', compact('department', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
        ]);

        $department = Department::findOrFail($id);
        $department->update($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully');
    }
}
