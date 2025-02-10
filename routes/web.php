<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\licenceController;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManufacturersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersProductController;
use App\Http\Controllers\SupplierController;

Route::get('/login', function(){
    return view('/back/page/auth/login');
})->name('author.login');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [RegisterController::class, 'showRegistrationForm'])->name('author.signup');
Route::post('/signup', [RegisterController::class, 'register'])->name('signup.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->middleware('auth');

    Route::get('/forgot-password', function(){
        return view('back.page.auth.forgot');
    })->name('author.forgot-password');

    Route::get('/home', function () {
        return view('home');
    });

    Route::get('/home', [HomeController::class, 'showusername'])->name('username');
    Route::get('/home', [HomeController::class, 'showtittle'])->name('showtittle');
    Route::get('/settings', [HomeController::class, 'showemail'])->name('showemail');
    Route::get('/settings', [HomeController::class, 'showpassword'])->name('userpassword');

    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::delete('/settings', [HomeController::class, 'deleteAccount'])->name('deleteaccount');
    Route::post('/settings', [HomeController::class, 'profileUpdate'])->name('updateprofile');

    Route::get('/check-user', [UserController::class, 'checkUser'])->name('check.user');

    Route::get('/settings', function(){
        return view('/back/page/auth/settings');
    })->name('author.settings');

    // Asset rotaları
    Route::prefix('assets')->group(function () {
        Route::get('/', [AssetController::class, 'index'])->name('assets.index');
        Route::get('/create', [AssetController::class, 'create'])->name('assets.create');
        Route::post('/', [AssetController::class, 'store'])->name('assets.store');
        Route::get('/licences/{productId}', [AssetController::class, 'getLicences'])->name('assets.getLicences');
        Route::get('/{id}/edit', [AssetController::class, 'edit'])->name('assets.edit');
        Route::put('/{id}', [AssetController::class, 'update'])->name('assets.update');
        Route::delete('/{id}', [AssetController::class, 'destroy'])->name('assets.destroy');
    });

    // Dashboard ve diğer rotalar
    Route::get('/', [AssetController::class, 'dashboardAssets'])->name('dashboard.assets');
    Route::get('/barcode', [AssetController::class, 'barcodeAssets'])->name('barcode.assets');

    Route::get('/barcode', function() {
        $assets = \App\Models\Asset::with(['product', 'licence'])->get();
        return view('barcode', compact('assets'));
    })->name('barcode.page');

    // Barkod okuma
    Route::get('/barcode/{product}', [AssetController::class, 'barcodeIndex'])->name('asset.barcode');

    // Product rotaları
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/{id}', [ProductController::class, 'showProductHistory'])->name('products.history');

        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    Route::get('/products/{id}/history', [ProductController::class, 'showProductHistory'])->name('products.history');

    // Licence rotaları
    Route::prefix('licences')->group(function () {
        Route::get('/', [LicenceController::class, 'index'])->name('licences.index');
        Route::get('/create', [LicenceController::class, 'create'])->name('licences.create');
        Route::post('/', [LicenceController::class, 'store'])->name('licences.store');
        Route::get('/{id}/edit', [LicenceController::class, 'edit'])->name('licences.edit');
        Route::put('/{id}', [LicenceController::class, 'update'])->name('licences.update');
        Route::delete('/{id}', [LicenceController::class, 'destroy'])->name('licences.destroy');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    Route::prefix('companies')->group(function () {
        Route::get('/', [CompaniesController::class, 'index'])->name('companies.index');
        Route::get('/create', [CompaniesController::class, 'create'])->name('companies.create');
        Route::post('/', [CompaniesController::class, 'store'])->name('companies.store');
        Route::put('/{id}', [CompaniesController::class, 'update'])->name('companies.update');
        Route::get('/{id}/edit', [CompaniesController::class, 'edit'])->name('companies.edit');
        Route::delete('/{id}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
    });

    Route::prefix('departments')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('departments.index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('departments.create');
        Route::post('/', [DepartmentController::class, 'store'])->name('departments.store');
        Route::put('/{id}', [DepartmentController::class, 'update'])->name('departments.update');
        Route::get('/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
        Route::delete('/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UsersProductController::class, 'index'])->name('users.index');
        Route::get('/create', [UsersProductController::class, 'create'])->name('users.create');
        Route::post('/', [UsersProductController::class, 'store'])->name('users.store');
        Route::put('/{id}', [UsersProductController::class, 'update'])->name('users.update');
        Route::get('/{id}/edit', [UsersProductController::class, 'edit'])->name('users.edit');
        Route::delete('/{id}', [UsersProductController::class, 'destroy'])->name('users.destroy');
    });

    Route::prefix('suppliers')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
        Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('/', [SupplierController::class, 'store'])->name('supplier.store');
        Route::put('/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    });

    Route::prefix('manufacturers')->group(function () {
        Route::get('/', [ManufacturersController::class, 'index'])->name('manufacturer.index');
        Route::get('/create', [ManufacturersController::class, 'create'])->name('manufacturer.create');
        Route::post('/', [ManufacturersController::class, 'store'])->name('manufacturer.store');
        Route::put('/{id}', [ManufacturersController::class, 'update'])->name('manufacturer.update');
        Route::get('/{id}/edit', [ManufacturersController::class, 'edit'])->name('manufacturer.edit');
        Route::delete('/{id}', [ManufacturersController::class, 'destroy'])->name('manufacturer.destroy');
    });

    Route::prefix('components')->group(function () {
        Route::get('/', [ComponentController::class, 'index'])->name('components.index');
        Route::get('/create', [ComponentController::class, 'create'])->name('components.create');
        Route::post('/', [ComponentController::class, 'store'])->name('components.store');
        Route::put('/{id}', [ComponentController::class, 'update'])->name('components.update');
        Route::get('/{id}/edit', [ComponentController::class, 'edit'])->name('components.edit');
        Route::delete('/{id}', [ComponentController::class, 'destroy'])->name('components.destroy');
    });

    Route::prefix('accessories')->group(function () {
        Route::get('/', [AccessoryController::class, 'index'])->name('accessories.index');
        Route::get('/create', [AccessoryController::class, 'create'])->name('accessories.create');
        Route::post('/', [AccessoryController::class, 'store'])->name('accessories.store');
        Route::put('/{id}', [AccessoryController::class, 'update'])->name('accessories.update');
        Route::get('/{id}/edit', [AccessoryController::class, 'edit'])->name('accessories.edit');
        Route::delete('/{id}', [AccessoryController::class, 'destroy'])->name('accessories.destroy');
    });
});
