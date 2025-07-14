@extends('layouts.customer')
@section('title', $product->name)

@section('content')
<div class="container py-5">
    {{-- Kembali ke Daftar Menu --}}
    <div class="mb-4">
        <a href="{{ route('customer.menu.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Menu
        </a>
    </div>

    {{-- ✅ Tampilkan alert error jika produk habis --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    <div class="row g-5">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x400' }}"
                     class="card-img-top rounded-top-4"
                     alt="{{ $product->name }}"
                     style="height: 400px; object-fit: cover;">
            </div>
        </div>

        <div class="col-md-6">
            <div class="d-flex flex-column h-100">
                <h2 class="fw-bold">{{ $product->name }}</h2>
                <p class="text-muted mt-3" style="font-size: 1.1rem;">
                    {{ $product->description }}
                </p>

                <div class="mt-4">
                    <p class="text-primary fw-bold h3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <form action="{{ route('customer.cart.add', $product->id) }}" method="POST" class="mt-auto d-grid gap-2 mt-4">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-cart-plus-fill"></i> Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
