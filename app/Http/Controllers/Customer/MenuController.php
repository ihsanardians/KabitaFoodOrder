<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product; // <-- PASTIKAN BARIS INI ADA

class MenuController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('category')->get();
        return view('customer.menu', compact('products'));
    }
}