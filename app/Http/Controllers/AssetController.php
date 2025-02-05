<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Product;
use App\Models\Licence;
use App\Models\UsersProduct;
use App\Models\Supplier;
use App\Models\Manufacturers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Picqer\Barcode\BarcodeGeneratorPNG;

class AssetController extends Controller
{
    public function index(Request $request)
{
    // Sıralama yapılacak sütunlar
    $sortableColumns = ['asset_name', 'product_id', 'licence_id', 'serial_number', 'quantity', 'status', 'assigned_to', 'brand'];
    
    // Varsayılan sıralama kriterleri
    $sort = $request->get('sort', 'asset_id');
    $direction = $request->get('direction', 'asc');

    // Filtreleme sorgusu
    $query = Asset::query()
        ->search($request->input('search'))
        ->filterByStatus($request->input('status'))
        ->filterByProduct($request->input('product_id'))
        ->filterByAssignedTo($request->input('assigned_to'));

    // Verileri getirme (get() yerine paginate() kullanıldı)
    $assets = $query->paginate(10)->appends(request()->query());

    // Diğer verileri çekme
    $manufacturers = Manufacturers::all();
    $suppliers = Supplier::all();
    $users = User::all();
    $products = Product::all();
    $licenses = Licence::all();

    // Görünüme verileri gönderme
    return view('assets.index', compact('assets', 'suppliers', 'products', 'users', 'licenses', 'manufacturers'));
}



    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        $usersProducts = UsersProduct::all();
        return view('assets.create', compact('products', 'usersProducts', 'suppliers'));
    }

    public function store(StoreAssetRequest $request)
{
    $asset = Asset::create($request->validated());

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

    public function update(UpdateAssetRequest $request, $id)
    {
    $asset = Asset::findOrFail($id);
    $asset->update($request->validated());

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
