@extends('layouts.customer2')
@section('title', 'Pesanan Berhasil')

@section('content')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .success-card {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        animation: fadeInUp 0.6s ease-in-out;
    }

    .success-icon {
        font-size: 5rem;
        color: #20c997;
        animation: pop 0.4s ease-in-out;
    }

    @keyframes pop {
        0% { transform: scale(0.6); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .queue-number {
        font-size: 4.5rem;
        font-weight: 800;
        color: #0d6efd;
        letter-spacing: 2px;
    }

    .btn-modern {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-modern:hover {
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
        transform: translateY(-2px);
    }

    .text-muted-sm {
        font-size: 0.95rem;
        color: #6c757d;
    }
</style>

<div class="container text-center py-5">
    <div class="card success-card mx-auto px-4 py-5" style="max-width: 550px;">
        <div class="card-body">
            <i class="bi bi-check-circle-fill success-icon"></i>
            <h1 class="mt-4 fw-bold">Pesanan Diterima!</h1>
            <p class="lead mb-3">Terima kasih, <strong>{{ $order->customer_name }}</strong>. Pesanan Anda sedang diproses.</p>
            <hr class="my-4">
            <p class="mb-2">Nomor Antrian Anda:</p>
            <div class="queue-number">{{ $order->queue_number }}</div>
            <p class="mt-4 mb-2 text-muted-sm">Total Pembayaran:</p>
            <h4 class="fw-semibold mb-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h4>
            <p class="mb-4">Silakan lakukan pembayaran di kasir dengan menunjukkan nomor antrian ini.</p>
            <a href="{{ route('customer.menu.index') }}" class="btn btn-modern">Pesan Lagi</a>
        </div>
    </div>
</div>
@endsection
