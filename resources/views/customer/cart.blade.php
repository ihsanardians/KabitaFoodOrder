@extends('layouts.customer2')
@section('title', 'Keranjang Belanja')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="bi bi-cart3"></i> Keranjang Anda</h3>
    </div>
    <div class="card-body">
        @if(!empty($cart))
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th width="100px">Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $details)
                    <tr>
                        <td>
                            <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://via.placeholder.com/50' }}" width="50" class="me-2 rounded">
                            {{ $details['name'] }}
                        </td>
                        <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                        <td>
                             <form action="{{ route('customer.cart.update', $id) }}" method="POST" class="d-flex">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control form-control-sm text-center" min="1">
                                <button type="submit" class="btn btn-sm btn-outline-primary ms-1"><i class="bi bi-arrow-repeat"></i></button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('customer.cart.remove', $id) }}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="d-flex justify-content-end align-items-center">
                <h4 class="me-4">Total: <span class="fw-bold" style="color: #0d6efd;">Rp {{ number_format($total, 0, ',', '.') }}</span></h4>
            </div>
            <hr>
            {{-- Ganti form lama dengan ini --}}
<div class="mt-4">
    <h4>Lengkapi Data Pemesan</h4>
    <form action="{{ route('customer.order.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="customer_name" class="form-label fw-bold">Nama Anda</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="customer_phone" class="form-label fw-bold">Nomor HP</label>
                <input type="tel" name="customer_phone" id="customer_phone" class="form-control" placeholder="Contoh: 08123456789" required>
            </div>
        </div>
        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-success btn-lg">
                <i class="bi bi-check-circle-fill"></i> Dapatkan Nomor Antrian & Pesan
            </button>
        </div>
    </form>
</div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-cart-x" style="font-size: 5rem; color: #ccc;"></i>
                <h4 class="mt-3">Keranjang Anda masih kosong.</h4>
                <a href="{{ route('customer.menu.index') }}" class="btn btn-primary mt-3">Kembali ke Menu</a>
            </div>
        @endif
    </div>
</div>
@endsection