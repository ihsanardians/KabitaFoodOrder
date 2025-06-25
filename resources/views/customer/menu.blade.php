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

@if($products->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-box-seam" style="font-size: 5rem; color: #ccc;"></i>
        <h4 class="mt-3">Maaf, belum ada menu yang tersedia.</h4>
        <p class="text-muted">Silakan cek lagi nanti.</p>
    </div>
@else

<!-- SECTION: Filter dan Menu -->
<section id="menu-section">
    <div class="container mb-5">
        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-md-3 mb-4">
                <div class="bg-primary text-white p-4 rounded-3 sticky-top" style="top: 80px;">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">Filter</h5>

                    <p class="fw-bold">Kategori</p>
                    @foreach(['Makanan', 'Minuman', 'Dessert', 'Seblak', 'Snack', 'Cocktail'] as $i => $kategori)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="kategori{{ $i }}">
                            <label class="form-check-label" for="kategori{{ $i }}">{{ $kategori }}</label>
                        </div>
                    @endforeach

                    <hr class="text-white">

                    <p class="fw-bold">Urutan Harga</p>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="harga" id="lowToHigh">
                        <label class="form-check-label" for="lowToHigh">Terendah - Tertinggi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="harga" id="highToLow">
                        <label class="form-check-label" for="highToLow">Tertinggi - Terendah</label>
                    </div>
                </div>
            </div>

            <!-- Produk Menu -->
            <div class="col-md-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300' }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($product->description, 50) }}</p>
                                <div class="mt-auto">
                                    <p class="h5 fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
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
            </div>

        </div>
    </div>
</section>
@endif

@endsection