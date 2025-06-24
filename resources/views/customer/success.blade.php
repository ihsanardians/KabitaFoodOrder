@extends('layouts.customer')
@section('title', 'Pesanan Berhasil')

@section('content')
<div class="container text-center py-5">
    <div class="card shadow-lg mx-auto" style="max-width: 500px;">
        <div class="card-body p-5">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
            <h1 class="mt-3">Pesanan Diterima!</h1>
            <p class="lead">Terima kasih, {{ $order->customer_name }}. Pesanan Anda sedang diproses.</p>
            <hr>
            <p>Nomor Antrian Anda:</p>
            <h2 class="display-1 fw-bold" style="color: #0d6efd;">{{ $order->queue_number }}</h2>
            <p class="mt-4">Total Pembayaran: <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
            <p>Silakan lakukan pembayaran di kasir dengan menunjukkan nomor antrian ini.</p>
            <a href="{{ route('customer.menu.index') }}" class="btn btn-primary mt-3">Pesan Lagi</a>
        </div>
    </div>
</div>
@endsection