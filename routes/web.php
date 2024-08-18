<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
Route::get ('/home', [AdminController::class,"index"]);

Route::get('/product', [ProductController::class, 'index']);