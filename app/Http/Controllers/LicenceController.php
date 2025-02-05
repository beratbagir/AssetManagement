<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Http\Requests\StoreLicencesRequest;
use App\Http\Requests\UpdateLicencesRequest;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class LicenceController extends Controller
{
    public function index(Request $request)
{
    $query = Licence::with('product')
            ->search($request->input('search'))
            ->filterByStatus($request->input('status'))
            ->filterByLicence($request->input('licence_id'));

            $sort = $request->get('sort', 'licence_id');
            $direction = $request->get('direction', 'asc');
            $query->sortBy($sort, $direction);


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

    public function store(StoreLicencesRequest $request)
    {
        // FormRequest'ten gelen validated verilerle yeni bir licence oluştur
        Licence::create($request->validated());

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

    public function update(UpdateLicencesRequest $request, $id)
    {
        $licence = Licence::findOrFail($id);
        // FormRequest'ten gelen validated verilerle licence'ı güncelle
        $licence->update($request->validated());

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
