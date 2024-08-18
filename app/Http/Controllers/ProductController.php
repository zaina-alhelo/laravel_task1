<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
public function index(){
        $products = Product::all();

    return view("admin.product", ['products' => $products]);
}
}
