<?php

namespace App\Http\Controllers;
use App\Models\Companies;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index(Request $request)
    {
        $query = Companies::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%'); // Sadece company_name üzerinden arama
        }

        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $query->sortBy($sort, $direction);
        
        $companies = Companies::all();
        $companies = $query->paginate(10)->appends(request()->query());
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        // Validated verileri kullanarak yeni company oluştur
        Companies::create($request->validated());

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function edit($id)
    {
        $company = Companies::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        // Mevcut company'yi al ve validated verilerle güncelle
        $company = Companies::findOrFail($id);
        $company->update($request->validated());

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Companies::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }


}
