<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter berdasarkan KATEGORI
        if ($request->filled('categories')) {
            // Ambil kategori dari request, contoh: ['main-course', 'add-on']
            $selectedCategories = $request->input('categories');

            // "Terjemahkan" value dari URL ke format di database
            $dbCategories = [];
            foreach ($selectedCategories as $category) {
                if ($category === 'main-course') {
                    $dbCategories[] = 'Main Course';
                } elseif ($category === 'add-on') {
                    $dbCategories[] = 'Add On';
                } elseif ($category === 'dessert') {
                    $dbCategories[] = 'Dessert';
                }
                // Tambahkan kondisi lain jika ada kategori baru
            }

            // Lakukan query dengan nama kategori yang sudah benar
            if (!empty($dbCategories)) {
                $query->whereIn('category', $dbCategories);
            }
        }

        // Urutkan berdasarkan HARGA
        if ($request->filled('sort')) {
            if ($request->input('sort') == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->input('sort') == 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->get();

        return view('customer.menu', compact('products'));
    }
}