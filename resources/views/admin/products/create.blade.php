@extends('layouts.app')

@section('content')
<style>
    .page-header {
        font-size: 1.75rem;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 1.5rem;
    }

    .form-card {
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem;
        font-size: 1rem;
    }

    .btn-primary, .btn-secondary {
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #3b8dff);
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #3b8dff, #0d6efd);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }

    .form-control[type="file"] {
        padding: 0.5rem;
    }
    .page-header { font-size: 1.75rem; font-weight: 700; color: #343a40; margin-bottom: 1.5rem; }
    .form-card { border-radius: 16px; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06); padding: 1.5rem; }
    .form-label { font-weight: 600; }
    .form-control, .form-select { border-radius: 10px; padding: 0.75rem; font-size: 1rem; }
    .btn-primary, .btn-secondary { font-weight: 600; padding: 10px 20px; border-radius: 12px; transition: all 0.3s ease; }
    .btn-primary { background: linear-gradient(135deg, #0d6efd, #3b8dff); border: none; color: white; }
    .btn-primary:hover { background: linear-gradient(135deg, #3b8dff, #0d6efd); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
</style>

<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-lg-8"> {{-- Batasi lebar form di layar besar --}}
            <h1 class="page-header text-center">Tambah Produk Baru</h1>

            <div class="card form-card">
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled selected>Pilih kategori</option>
                                <option value="Dessert">Dessert</option>
                                <option value="Main Course">Main Course</option>
                                <option value="Add On">Add On</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Produk</label>
                            <input class="form-control" type="file" id="image" name="image" required>
                        </div>
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan Produk
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
