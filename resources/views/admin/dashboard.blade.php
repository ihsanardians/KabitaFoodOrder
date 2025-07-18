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
        border-color: #dee2e6;
    }
    .table tbody td {
        vertical-align: middle;
    }
    .badge.queue-number {
        font-size: 1.1rem;
        font-weight: bold;
        background: linear-gradient(135deg, #198754, #20c997);
        padding: 6px 14px;
        border-radius: 30px;
    }
    .btn-finish {
        display: flex; align-items: center; justify-content: center; gap: 6px;
        background: linear-gradient(135deg, #198754, #157347);
        color: white; border: none; font-weight: 600; font-size: 0.9rem; padding: 8px 16px;
        border-radius: 12px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;
    }
    .btn-finish:hover {
        background: linear-gradient(135deg, #157347, #11613a);
        transform: translateY(-2px); box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    .btn-finish i { font-size: 1.1rem; }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .order-card-mobile {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        margin-bottom: 1rem;
        animation: fadeIn 0.4s ease-in-out;
    }
</style>

<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card dashboard-card">
                <div class="dashboard-card-header">
                    <i class="bi bi-list-check me-2"></i> Dashboard - Pesanan Masuk
                </div>
                <div class="card-body bg-white p-0 p-lg-3">
                    @if (session('status'))
                        <div class="alert alert-success m-3" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Tampilan Tabel untuk Desktop (d-none d-lg-block) --}}
                    <div class="table-responsive d-none d-lg-block">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th>No. Antrian</th>
                                    <th>Pemesan</th>
                                    <th>Detail Pesanan</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge queue-number">{{ $order->queue_number }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $order->customer_name }}</strong><br>
                                            <small class="text-muted">Order #{{ $order->id }} | {{ $order->created_at->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled mb-0 small">
                                                @foreach ($order->items as $item)
                                                    <li>{{ $item->quantity }}x {{ $item->product->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="text-center fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="selesai">
                                                <button type="submit" class="btn btn-finish">
                                                    <i class="bi bi-check-circle-fill"></i> Selesaikan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted py-4">Tidak ada pesanan yang sedang diproses.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Tampilan Kartu untuk Mobile (d-lg-none) --}}
                    <div class="d-lg-none p-3">
                        @forelse ($orders as $order)
                        <div class="card order-card-mobile">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="h5 fw-bold">{{ $order->customer_name }}</p>
                                        <small class="text-muted">Order #{{ $order->id }} | {{ $order->created_at->format('H:i') }}</small>
                                    </div>
                                    <span class="badge queue-number">{{ $order->queue_number }}</span>
                                </div>
                                <hr>
                                <ul class="list-unstyled mb-2 small">
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->quantity }}x {{ $item->product->name }}</li>
                                    @endforeach
                                </ul>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <small class="text-muted">Total</small>
                                        <p class="h5 fw-bold mb-0">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="btn btn-finish">
                                            <i class="bi bi-check-circle-fill"></i> Selesaikan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-muted py-5">Tidak ada pesanan yang sedang diproses.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection