@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard - Pesanan Masuk') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>No. Order</th>
                                <th>Nama Pemesan</th>
                                <th>No. Antrian</th>
                                <th>Waktu Pesan</th>
                                <th>Total</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td><span class="badge bg-success fs-5">{{ $order->queue_number }}</span></td>
                                    <td>{{ $order->created_at->format('H:i:s') }}</td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        {{-- Form untuk update status, akan kita fungsikan nanti --}}
                                       <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Selesaikan</button>
                                    </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada pesanan yang sedang diproses.</td>
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