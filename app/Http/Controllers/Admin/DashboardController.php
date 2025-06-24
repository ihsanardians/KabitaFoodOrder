<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; // Jangan lupa use Order model

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan yang statusnya masih 'diproses', urutkan dari yang terbaru
        $orders = Order::where('status', 'diproses')->latest()->get();

        // Kirim data pesanan tersebut ke view 'admin.dashboard'
        return view('admin.dashboard', compact('orders'));
    }
}