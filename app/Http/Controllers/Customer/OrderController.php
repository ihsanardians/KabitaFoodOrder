<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import Carbon untuk bekerja dengan tanggal
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;



class OrderController extends Controller
{
    // private function sendWhatsApp($name, $phone, $order)
    // {
    //     $token = '63jffwm6PJvZbuHfEazAmi5ZvBDnhiNOu2nFl1kYQT8m3vp7zOF0CkK'; // ganti dengan token dari akun Wablas Anda
    //     $url = 'https://sby.wablas.com/api/send-message'; // Endpoint API Wablas

    //     // Format nomor HP: ubah awalan 0 jadi 62
    //     $phone = preg_replace('/^0/', '62', $phone);

    //     $message = "Halo *$name*,\n"
    //             . "Terima kasih atas pesanan Anda di *FoodCourt Kami*.\n\n"
    //             . "🧾 *Nomor Antrian:* {$order->queue_number}\n"
    //             . "💰 *Total:* Rp " . number_format($order->total_price, 0, ',', '.') . "\n\n"
    //             . "Silakan tunggu pesanan Anda diproses. 🙏";

    //     Http::withHeaders([
    //         'Authorization' => $token,
    //     ])->post($url, [
    //         'phone' => $phone,
    //         'message' => $message,
    //         'secret' => false,
    //         'priority' => true,
    //     ]);
    // }
    
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15', // Validasi nomor HP
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('customer.menu.index')->with('error', 'Keranjang Anda kosong!');
        }

        // 2. Logika untuk membuat Nomor Antrian
        // Nomor antrian akan reset menjadi 1 setiap hari
        $today = Carbon::today();
        $lastOrderToday = Order::whereDate('created_at', $today)->orderBy('id', 'desc')->first();
        $queueNumber = $lastOrderToday ? $lastOrderToday->queue_number + 1 : 1;

        $totalPrice = 0;
        foreach ($cart as $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        

        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'queue_number' => $queueNumber,
                'total_price' => $totalPrice,
                'status' => 'diproses'
            ]);

            foreach ($cart as $id => $details) {
                $product = \App\Models\Product::find($id); // ambil data produk

                //dd($product->name);
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $id,
                    'product_name' => $product->name, // ambil nama dari database
                    'quantity'     => $details['quantity'],
                    'price'        => $details['price']
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('customer.order.success', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.cart.index')->with('error', 'Error: ' . $e->getMessage());
        }


    }

    


    public function success(Order $order)
    {
        // Tidak ada perubahan di sini, hanya view-nya yang akan kita ubah
        return view('customer.success', compact('order'));
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        $order = Order::with('items.product')->findOrFail($id);


        $pdf = Pdf::loadView('customer.pdf_invoice', compact('order'))->setPaper('A5', 'portrait');
        return $pdf->stream("invoice-pesanan-{$order->id}.pdf");
    }

}