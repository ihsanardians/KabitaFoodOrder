@extends('layouts.app')

@section('content')
<style>
    .dashboard-card {
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        animation: fadeIn 0.4s ease-in-out;
    }

    .dashboard-card-header {
        background: linear-gradient(135deg, #0d6efd, #3b8dff);
        color: #fff;
        font-weight: bold;
        font-size: 1.2rem;
        padding: 1rem 1.5rem;
    }

    .table thead th {
        background-color: #eaf4ff;
        font-weight: 600;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .badge.queue-number {
        display: inline-block;
        font-size: 1.1rem;
        font-weight: bold;
        background: linear-gradient(135deg, #198754, #20c997);
        color: #fff;
        padding: 6px 14px;
        border-radius: 30px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        letter-spacing: 1px;
        transition: transform 0.2s ease;
    }

    .badge.queue-number:hover {
        transform: scale(1.05);
    }

    .btn-finish {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: linear-gradient(135deg, #198754, #157347);
        color: white;
        border: none;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 8px 16px;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .btn-finish:hover {
        background: linear-gradient(135deg, #157347, #11613a);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-finish i {
        font-size: 1.1rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .product-list {
        padding-left: 1rem;
        margin-bottom: 0;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card dashboard-card">
                <div class="dashboard-card-header">
                    <i class="bi bi-list-check me-2"></i> Dashboard - Pesanan Masuk
                </div>

                <div class="card-body bg-white">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover table-bordered mt-3">
                        <thead>
                            <tr class="text-center">
                                <th>No. Order</th>
                                <th>Nama Pemesan</th>
                                <th>No. Antrian</th>
                                <th>Waktu Pesan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="text-center">#{{ $order->id }}</td>
                                    <td class="text-center">{{ $order->customer_name }}</td>
                                    <td class="text-center">
                                        <span class="badge queue-number">
                                            {{ $order->queue_number }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $order->created_at->format('H:i:s') }}</td>
                                    <td class="text-center">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <ul class="product-list" style="list-style: none; padding-left: 0; margin: 0;">
                                            @foreach ($order->items as $index => $item)
                                                <li style="margin-bottom: 12px; padding: 8px; border-bottom: 1px solid #eee;">
                                                    <div style="font-weight: bold;">{{ $index + 1 }}. {{ $item->product->name }}</div>
                                                    <div>{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}</div>
                                                    <div><strong>Total: Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</strong></div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-finish">
                                                <i class="bi bi-check-circle-fill"></i> Selesaikan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-light"></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Tidak ada pesanan yang sedang diproses.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
