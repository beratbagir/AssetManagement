<?php

namespace App\Http\Controllers;
use App\Models\Asset;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetController extends Controller
{
    public function store(Request $request)
{
    // Validation
    $validated = $request->validate([
        'product' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'asset_name' => 'required|string|max:255',
        'serial' => 'required|string|max:255',
        'quantity' => 'required|integer',
        'assigned_user' => 'required|string',
        'pdf' => 'required|file|mimes:pdf|max:2048',
    ]);

    if ($request->hasFile('pdf')) {
        $filePath = $request->file('pdf')->store('assets/pdfs', 'public');
    } else {
        return redirect()->back()->withErrors(['pdf' => 'PDF file is required.']);
    }

    $asset = new Asset();
    $asset->product = $validated['product'];
    $asset->status = $validated['status'];
    $asset->asset_name = $validated['asset_name'];
    $asset->serial = $validated['serial'];
    $asset->quantity = $validated['quantity'];
    $asset->assigned_user = $validated['assigned_user'];
    $asset->pdf = $filePath;

    $asset->save();

    return redirect()->route('assets.index');
}


    public function index()
{
    $assets = Asset::all();
    $users = User::all();
    return view('home', compact('assets', 'users'));
}


    public function assetDelete($id)
    {
    $asset = Asset::find($id);
    $asset->delete();
    return redirect()->route('assets.index');
    }

    public function assetUpdate(Request $request, $id)
{
    // Validation
    $request->validate([
        'product' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'asset_name' => 'required|string|max:255',
        'serial' => 'required|integer',
        'quantity' => 'required|integer',
        'assigned_user' => 'required|string',
        'pdf' => 'file|mimes:pdf|max:2048',
    ]);

    // Create new asset
    $asset = Asset::find($id);
    $asset->product = $request['product'];
    $asset->status = $request['status'];
    $asset->asset_name = $request['asset_name'];
    $asset->serial = $request['serial'];
    $asset->quantity = $request['quantity'];
    $asset->assigned_user = $request['assigned_user'];
    if ($request->hasFile('pdf')) {
        $filePath = $request->file('pdf')->store('assets/pdfs', 'public');
        $asset->pdf = $filePath;
    }

    $asset->save();

    return redirect()->route('assets.index');
}

public function barcodeIndex(Request $request, $serial)
    {
        $asset = Asset::findOrFail($serial);
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $image = $generator->getBarcode($asset->serial, $generator::TYPE_CODE_128);

        return response($image)->header('Content-type','image/png');
    }
public function barcodeAssets()
    {
        $assets = Asset::all();
        $users = User::all();
        return view('barcode', compact('assets', 'users'));
    }

    public function dashboardAssets()
{
    $assets = Asset::all();

    $totalAssets = Asset::count();
    $deployedCount = Asset::where('status', 'Deploy')->count();
    $readytoDeployCount = Asset::where('status', 'Ready to Deploy')->count();
    $pendingCount = Asset::where('status', 'Pending')->count();

    return view('dashboard', compact('assets', 'totalAssets', 'deployedCount', 'readytoDeployCount', 'pendingCount'));
}






}
