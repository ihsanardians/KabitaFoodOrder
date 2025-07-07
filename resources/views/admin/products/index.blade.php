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
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #212529;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger:hover {
        background-color: #bb2d3b;
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
                            <td>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ ucfirst($product->category) }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>

                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">

                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-warning btn-action me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="#" method="POST" class="d-inline">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-action"
                                            onclick="return confirm('Anda yakin ingin menghapus produk ini?')">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
