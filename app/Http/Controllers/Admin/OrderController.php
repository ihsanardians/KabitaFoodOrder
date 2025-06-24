<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Pastikan use Carbon ada

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('customer.menu.index')->with('error', 'Keranjang Anda kosong!');
        }

        // 2. Logika untuk membuat Nomor Antrian
        $today = Carbon::today();
        $lastOrderToday = Order::whereDate('created_at', $today)->orderBy('id', 'desc')->first();
        $queueNumber = $lastOrderToday ? $lastOrderToday->queue_number + 1 : 1;

        $totalPrice = 0;
        foreach ($cart as $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        DB::beginTransaction();
        try {
            // 3. Simpan order dengan data baru
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'queue_number' => $queueNumber,
                'total_price' => $totalPrice,
                'status' => 'diproses'
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('customer.order.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.cart.index')->with('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }

    public function success(Order $order)
    {
        return view('customer.success', compact('order'));
    }
}