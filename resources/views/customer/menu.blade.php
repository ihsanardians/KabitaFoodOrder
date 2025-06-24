@extends('layouts.customer')
@section('title', 'Daftar Menu')

@section('content')
@auth
<div class="d-flex justify-content-end align-items-center mb-4 p-3 bg-light rounded shadow-sm">
    <span class="me-3">Anda login sebagai: <strong>{{ Auth::user()->name }}</strong></span>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="btn btn-outline-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
@endauth
<h2 class="mb-4 text-center" style="color: #0d6efd;">Pilih Menu Anda</h2>

@if($products->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-box-seam" style="font-size: 5rem; color: #ccc;"></i>
        <h4 class="mt-3">Maaf, belum ada menu yang tersedia.</h4>
        <p class="text-muted">Silakan cek lagi nanti.</p>
    </div>
@else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($products as $product)
        <div class="col">
            <div class="card h-100">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300' }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->description, 50) }}</p>
                    <div class="mt-auto">
                        <p class="h4 fw-bold" style="color: #0d6efd;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <form action="{{ route('customer.cart.add', $product->id) }}" method="POST" class="d-grid">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle-fill"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection