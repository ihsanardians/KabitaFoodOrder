@extends('layouts.app')

@section('content')
<style>
    .page-header {
        font-weight: 700;
        font-size: 1.75rem;
        color: #343a40;
    }

    .btn-add {
        background: linear-gradient(135deg, #0d6efd, #3b8dff);
        border: none;
        font-weight: 600;
        border-radius: 12px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        background: linear-gradient(135deg, #3b8dff, #0d6efd);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-custom {
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #0d6efd, #3b8dff);
        color: #fff;
        font-weight: bold;
        font-size: 1.1rem;
        padding: 1rem 1.25rem;
    }

    .table thead {
        background-color: #f0f8ff;
    }

    .table th {
        font-weight: 600;
        color: #495057;
    }

    .table td {
        vertical-align: middle;
    }

    .badge-date {
        background-color: #e2e3e5;
        color: #495057;
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 500;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-header mb-0">Kelola Kasir</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-add">
            <i class="bi bi-person-plus-fill me-1"></i> Tambah Kasir Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-custom">
        <div class="card-header card-header-custom">Daftar Akun Kasir / Admin</div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge badge-date">{{ $user->created_at->format('d M Y') }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
