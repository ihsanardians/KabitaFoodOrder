@extends('layouts.app')

@section('content')
<style>
    .page-header {
        font-weight: 700;
        font-size: 1.75rem;
        color: #343a40;
        margin-bottom: 1rem;
    }

    .form-card {
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.75rem;
        font-size: 1rem;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .text-danger {
        font-size: 0.875rem;
    }

    .btn-primary,
    .btn-secondary {
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #3b8dff);
        border: none;
        color: #fff;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #3b8dff, #0d6efd);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }
</style>

<div class="container-fluid">
    <h1 class="page-header">Tambah Kasir Baru</h1>

    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        required>
                    @error('password_confirmation')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
