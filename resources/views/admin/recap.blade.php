@extends('layouts.app')

@section('content')
<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .rekap-card {
        border-radius: 1rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .rekap-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .rekap-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .rekap-badge {
        padding: 5px 10px;
        font-size: 0.85rem;
        border-radius: 20px;
    }
</style>

<div class="container mt-4">
    <h1 class="mb-4"><i class="bi bi-clipboard-data"></i> Rekap Penjualan</h1>

    {{-- Filter Tanggal --}}
    <div class="rekap-card bg-white mb-4 p-4">
        <form action="{{ route('admin.sales.recap') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-filter"></i> Filter</button>
                <a href="{{ route('admin.sales.recap') }}" class="btn btn-secondary w-100"><i class="bi bi-arrow-clockwise"></i> Reset</a>
            </div>
        </form>
    </div>

    {{-- Statistik Umum --}}
    <div class="rekap-card bg-white mb-4 p-4">
        <h5 class="mb-3"><i class="bi bi-bar-chart-line"></i> Statistik Umum</h5>
        <p><strong>Total Pesanan:</strong> {{ $totalOrders }}</p>
        <p><strong>Total Pendapatan:</strong> 
            <span class="text-success fw-bold">Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
        </p>
    </div>

    {{-- Rekap 7 Hari Terakhir --}}
    <div class="rekap-card bg-white mb-4">
        <div class="p-3 border-bottom bg-light">
            <h6 class="mb-0 fw-semibold"><i class="bi bi-calendar-range me-1"></i> Rekap Pendapatan 7 Hari Terakhir</h6>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th style="width: 50%;">Tanggal</th>
                            <th style="width: 50%;">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salesByDate as $item)
                            <tr class="text-center">
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">Tidak ada data penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Riwayat Semua Pesanan --}}
    <div class="rekap-card bg-white mb-4">
        <div class="p-3 border-bottom bg-dark text-white">
            <h6 class="mb-0 fw-semibold"><i class="bi bi-clock-history me-1"></i> Riwayat Seluruh Pesanan</h6>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>#</th>
                            <th><i class="bi bi-calendar"></i> Tanggal</th>
                            <th><i class="bi bi-person"></i> Customer</th>
                            <th><i class="bi bi-telephone"></i> No HP</th>
                            <th><i class="bi bi-cash"></i> Total</th>
                            <th><i class="bi bi-flag"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allOrders as $order)
                            <tr class="text-center">
                                <td>{{ $order->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $order->status === 'completed' ? 'bg-success' : 
                                        ($order->status === 'pending' ? 'bg-warning text-dark' : 
                                        ($order->status === 'cancelled' ? 'bg-danger' : 'bg-secondary')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada pesanan yang masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
