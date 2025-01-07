<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Product;
use App\Models\Licence;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Picqer\Barcode\BarcodeGeneratorPNG;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with(['product', 'licence'])->get();
        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        $products = Product::all();
        $users = \App\Models\User::all();
        return view('assets.create', compact('products', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,product_id',
            'licence_id' => 'required|exists:licences,licence_id',
            'serial_number' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|string|max:255',
            'assigned_to' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $asset = Asset::create($request->all());

        return redirect()->route('assets.index')
            ->with('success', 'Asset created successfully.');
    }

    public function dashboardAssets()
    {
        $assets = Asset::with(['product', 'licence'])->get();
        
        // İstatistikleri hesapla
        $totalAssets = $assets->count();
        $deployedCount = $assets->where('status', 'active')->count();
        $pendingCount = $assets->where('status', 'inactive')->count();
        $readytoDeployCount = $assets->where('status', 'maintenance')->count();

        return view('dashboard', compact(
            'assets',
            'totalAssets',
            'deployedCount',
            'pendingCount',
            'readytoDeployCount'
        ));
    }

    public function getLicences($productId)
    {
        $licences = Licence::where('product_id', $productId)
            ->select('licence_id', 'licence_key', 'status', 'expiration_date')
            ->get()
            ->map(function($licence) {
                return [
                    'licence_id' => $licence->licence_id,
                    'licence_key' => $licence->licence_key . ' (Expires: ' . $licence->expiration_date . ' - ' . $licence->status . ')'
                ];
            });
        
        return response()->json($licences);
    }

    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $products = Product::all();
        $licences = Licence::where('product_id', $asset->product_id)->get();
        $users = \App\Models\User::all();
        
        return view('assets.edit', compact('asset', 'products', 'licences', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,product_id',
            'licence_id' => 'required|exists:licences,licence_id',
            'serial_number' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|string|max:255',
            'assigned_to' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $asset = Asset::findOrFail($id);
        $asset->update($request->all());

        return redirect()->route('assets.index')
            ->with('success', 'Asset updated successfully.');
    }

    public function barcodeIndex($product)
    {
        $asset = Asset::findOrFail($product);
        
        // Barkod oluştur
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($asset->serial_number, $generator::TYPE_CODE_128));
        
        return response()->json([
            'barcode' => $barcode,
            'serial' => $asset->serial_number
        ]);
    }
}
