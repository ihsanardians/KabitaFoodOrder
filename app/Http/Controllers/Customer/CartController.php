<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return view('customer.cart', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        
        // ❗ Cek ketersediaan produk
        if (!$product->is_available) {
            return redirect()->back()->with('error', 'Produk ini sedang tidak tersedia atau sudah habis.');
        }

        // Ambil cart dari session
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }


    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart');
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->route('customer.cart.index')->with('success', 'Keranjang berhasil diperbarui.');
        }
        return redirect()->route('customer.cart.index')->with('error', 'Produk tidak ditemukan.');
    }


    public function remove(Product $product)
    {
        $cart = session()->get('cart');
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}