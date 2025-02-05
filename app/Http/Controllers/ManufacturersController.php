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

     // Query başlat
    $query = Manufacturers::query()
    ->search($request->input('search')); // Search scope'u uygula

// İlgili ürün sayısını ekle
    $manufacturers = $query->withCount('products') // Ürün sayısını ekler
    ->paginate(10) // Sayfalama ekle
    ->appends(request()->query()); // Sayfa numarası ve arama parametrelerini korur
        return view('manufacturers.index', compact('manufacturers'));
    }

    public function create()
    {
        return view('manufacturers.create');
    }

    public function store(StoreManufacturerRequest $request)
    {
        // FormRequest'ten gelen validated verilerle yeni bir üretici oluştur
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
        // FormRequest'ten gelen validated verilerle üreticiyi güncelle
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
