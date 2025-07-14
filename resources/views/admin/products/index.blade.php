@extends('layouts.app')

@section('content')
<style>
    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #343a40;
    }

    .btn-add {
        background: linear-gradient(135deg, #0d6efd, #3b8dff);
        border: none;
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 20px;
        transition: all 0.3s ease;
        color: white;
    }

    .btn-add:hover {
        background: linear-gradient(135deg, #3b8dff, #0d6efd);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .btn-action {
        font-weight: 500;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
        transition: 0.2s ease-in-out;
        white-space: nowrap;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #212529;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #bb2d3b;
    }

    /* Tombol Sold Out (abu-abu) */
    .btn-soldout {
        background-color: #6c757d !important;
        color: #fff !important;
        border: none;
    }

    .btn-soldout:hover {
        background-color: #5a6268 !important;
    }

    /* Tombol Ready (hijau) */
    .btn-ready {
        background-color: #198754 !important;
        color: #fff !important;
        border: none;
    }

    .btn-ready:hover {
        background-color: #157347 !important;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title">Kelola Menu</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle me-1"></i> Tambah Produk Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <!-- Gambar Produk -->
                            <td>
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="product-img">
                            </td>

                            <!-- Nama Produk -->
                            <td><strong>{{ $product->name }}</strong></td>

                            <!-- Kategori -->
                            <td>{{ ucfirst($product->category) }}</td>

                            <!-- Harga -->
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>

                            <!-- Aksi -->
                            <td class="align-middle">
                                <div class="d-flex flex-column align-items-stretch gap-2">
                                    <!-- Baris atas: Edit & Hapus -->
                                    <div class="d-flex justify-content-between gap-2">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                                           class="btn btn-sm btn-warning btn-action w-100 text-center">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Anda yakin ingin menghapus produk ini?')" 
                                              class="w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-action w-100 text-center">
                                                <i class="bi bi-trash3"></i> Hapus
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Baris bawah: Status -->
                                    <form action="{{ route('admin.admin.products.toggleAvailability', $product->id) }}" 
                                          method="POST" class="w-100">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-action w-100 text-center {{ $product->is_available ? 'btn-soldout' : 'btn-ready' }}">
                                            <i class="bi {{ $product->is_available ? 'bi-x-circle' : 'bi-check-circle' }}"></i>
                                            {{ $product->is_available ? 'Sold Out' : 'Ready' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
