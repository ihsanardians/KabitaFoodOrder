@extends('layouts.customer')
@section('title', 'Daftar Menu')

@section('content')

{{-- Bagian untuk menampilkan tombol Logout jika user sudah login --}}
@auth
<div class="container mt-4">
    <div class="d-flex justify-content-end align-items-center p-3 bg-light rounded shadow-sm">
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
</div>
@endauth

<section id="menu-section">
    <div class="container my-5">

        {{-- Tombol Filter untuk Mobile --}}
        <div class="d-grid d-lg-none mb-4">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilter" aria-controls="offcanvasFilter">
                <i class="bi bi-funnel-fill"></i> Tampilkan Filter
            </button>
        </div>

        <div class="row">
            {{-- Filter Sidebar (Hanya Desktop) --}}
            <div class="col-lg-3 d-none d-lg-block">
                <div class="sticky-top" style="top: 90px;">
                    @include('customer.partials._filter-sidebar')
                </div>
            </div>

            {{-- Daftar Produk --}}
            <div class="col-lg-9">
                {{-- KELAS GRID YANG SUDAH DIPERBAIKI UNTUK TAMPILAN MOBILE --}}
                <div class="row row-cols-2 row-cols-lg-3 g-4">
                    @forelse ($products as $product)
                    <div class="col">
                        <a href="{{ route('customer.menu.show', $product->id) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 card-product">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300' }}"
                                    class="card-img-top" alt="{{ $product->name }}" style="height: 150px; object-fit: cover;">
                                <div class="card-body d-flex flex-column p-3">
                                    <h6 class="card-title fw-bold mb-1">{{ $product->name }}</h6>
                                    <p class="card-text text-muted small flex-grow-1">{{ Str::limit($product->description, 50) }}</p>
                                    <div class="mt-auto">
                                        <p class="h6 fw-bolder mb-2">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                            
                                            {{-- Logika untuk menampilkan badge "Habis" --}}
                                            @if (isset($product->is_available) && $product->is_available == 0)
                                                <span class="badge bg-danger ms-2">Habis</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                {{-- Card-footer untuk tombol, dipisah dari card-body --}}
                                <div class="card-footer bg-white border-0 p-3 pt-0">
                                    <form action="{{ route('customer.cart.add', $product->id) }}" method="POST" class="d-grid">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="bi bi-plus-circle-fill"></i> Tambah
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-12">
                       {{-- Pesan jika produk tidak ditemukan --}}
                       <div class="text-center py-5 bg-light rounded">
                           <i class="bi bi-search" style="font-size: 4rem; color: #ccc;"></i>
                           @if(request()->hasAny(['categories', 'sort']))
                               <h4 class="mt-3">Produk Tidak Ditemukan</h4>
                               <p class="text-muted">Coba ubah atau reset filter Anda.</p>
                               <a href="{{ route('customer.menu.index') }}" class="btn btn-outline-primary mt-2">Reset Filter</a>
                           @else
                               <h4 class="mt-3">Maaf, belum ada menu yang tersedia.</h4>
                               <p class="text-muted">Silakan cek lagi nanti.</p>
                           @endif
                       </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Offcanvas untuk Filter Mobile --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasFilter" aria-labelledby="offcanvasFilterLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasFilterLabel">Filter Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    @include('customer.partials._filter-sidebar')
  </div>
</div>

{{-- Script untuk filter otomatis --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterInputs = document.querySelectorAll('.filter-input');
        
        filterInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                // Cari form terdekat dari input yang diubah, lalu submit
                this.closest('form').submit();
            });
        });
    });
</script>
@endpush

@endsection