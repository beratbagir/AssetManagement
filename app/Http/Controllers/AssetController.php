<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Product;
use App\Models\Licence;
use App\Models\UsersProduct;
use App\Models\Supplier;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Picqer\Barcode\BarcodeGeneratorPNG;

class AssetController extends Controller
{
    public function index(Request $request)
{
    // Başlangıç sorgusu
    $query = Asset::query();

    // Search Filtresi
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('asset_name', 'like', '%' . $search . '%');
        });
    }

    // Status Filtresi
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Product Filtresi
    if ($request->filled('product_id')) {
        $query->where('product_id', $request->product_id, 'product_id');
    }

    // Assigned To Filtresi
    if ($request->filled('assigned_to')) {
        $query->where('assigned_to', $request->assigned_to);
    }

    $sortableColumns = [ 'asset_name', 'product_id', 'licence_id', 'serial_number', 'quantity', 'status', 'assigned_to'];
    $sort = $request->get('sort', 'asset_id');
    $direction = $request->get('direction', 'asc');

    if ($sort === 'asset_name') {
        $query->orderByRaw('LEFT(asset_name, 1) ' . $direction);
    }

    if ($sort === 'product_id') {
        $query->orderBy('product_id', $direction);
    }

    if ($sort === 'brand') {
        $query->orderBy('brand', $direction);
    }

    if ($sort === 'licence_id') {
        $query->orderBy('licence_id', $direction);
    }

    if ($sort === 'serial_number') {
        $query->orderBy('serial_number', $direction);
    }

    if ($sort === 'quantity') {
        $query->orderBy('quantity', $direction);
    }

    if ($sort === 'status') {
        $query->orderBy('status', $direction);
    }

    // Veriyi al
    $assets = $query->paginate(10)->appends(request()->query());
    $suppliers = Supplier::all();
    $products = Product::all();
    $licenses = Licence::all();

    // View'e veri gönder
    return view('assets.index', compact('assets', 'suppliers', 'products', 'licenses'));
}


    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        $usersProducts = UsersProduct::all();
        return view('assets.create', compact('products', 'usersProducts', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'supplier_id' => 'nullable|exists:suppliers,supplier_id',
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
        $usersProducts = UsersProduct::all();
        
        return view('assets.edit', compact('asset', 'products', 'licences', 'usersProducts'));
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

    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->route('assets.index')
            ->with('success', 'Asset deleted successfully.');
    }
}
