@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Rekap Penjualan</h1>

    {{-- Statistik Umum --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.sales.recap') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Tanggal Selesai</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.sales.recap') }}" class="btn btn-secondary">Reset</a>
            </div>
            </form>
            <h5 class="card-title">Statistik Umum</h5>
            <p><strong>Total Pesanan:</strong> {{ $totalOrders }}</p>
            <p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Rekap 7 Hari Terakhir --}}
    <div class="card mb-4">
        <div class="card-header">
            <strong>Rekap Pendapatan 7 Hari Terakhir</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salesByDate as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">Tidak ada data penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Riwayat Semua Pesanan --}}
    <div class="card">
        <div class="card-header">
            <strong>Riwayat Seluruh Pesanan</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nama Customer</th>
                        <th>No HP</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->customer_phone }}</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pesanan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
