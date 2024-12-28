<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/signup', function (Request $request) {
    return $request->user();
})->middleware(middleware: 'auth:sanctum');
