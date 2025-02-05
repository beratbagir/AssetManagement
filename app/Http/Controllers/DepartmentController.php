<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Companies;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {   
        $query = Department::query()
            ->search($request->input('search'))
            ->filterByCompany($request->input('company_id'));


            $sort = $request->get('sort', 'name');
            $direction = $request->get('direction', 'asc');
            $query->sortBy($sort, $direction);

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

    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $companies = Companies::all();
        return view('departments.edit', compact('department', 'companies'));
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->update($request->validated());

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
