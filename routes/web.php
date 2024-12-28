<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/login', function(){
    return view('/back/page/auth/login');
})->name('author.login');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/forgot-password', function(){
    return view('back.page.auth.forgot');
})->name('author.forgot-password');

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/home', [HomeController::class, 'showusername'])->name('username');
Route::get('/home', [HomeController::class, 'showtittle'])->name('showtittle');
Route::get('/settings', [HomeController::class, 'showemail'])->name('showemail');
Route::get('/settings', [HomeController::class, 'showpassword'])->name('userpassword');

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::delete('/settings', [HomeController::class, 'deleteAccount'])->name('deleteaccount');
Route::post('/settings',[HomeController::class, 'profileUpdate'])->name('updateprofile');

Route::get('/signup', [RegisterController::class, 'showRegistrationForm'])->name('author.signup');
Route::post('/signup', [RegisterController::class, 'register'])->name('signup.submit');

Route::get('/check-user', [UserController::class, 'checkUser'])->name('check.user');

Route::get('/settings', function(){
    return view('/back/page/auth/settings');
})->name('author.settings');

//users sayfası
Route::get('/users', function(){
    return view('admin.users');
})->name('users');
Route::get('/users', [UserController::class, 'getUser'])->name('getuser');
Route::post('/users', [UserController::class, 'postUser'])->name('postuser');
Route::delete('/users/{id}', [UserController::class, 'deleteAdmin'])->name('users.delete');


// Asset oluşturma sayfası
Route::post('/home', [AssetController::class, 'store'])->name('assets.store');
Route::delete('/home/{id}', [AssetController::class, 'assetDelete'])->name('delete.asset');

Route::get('/barcode', function(){
    return view('barcode');
})->name('barcode.page');

// Asset listeleme (GET)
Route::get('/home', [AssetController::class, 'index'])->name('assets.index');

// Asset güncelleme (PUT)
Route::put('/home/{id}', [AssetController::class, 'assetUpdate'])->name('assets.update');

//barkod okuma
Route::get('/home/{product}', [AssetController::class, 'barcodeIndex'])->name('asset.barcode');

Route::get('/barcode', [AssetController::class, 'barcodeAssets'])->name('barcode.assets');

Route::get('/', [AssetController::class, 'dashboardAssets'])->name('dashboard.assets');

Route::get('/roles', function () {
    return view('admin.roles');
});


