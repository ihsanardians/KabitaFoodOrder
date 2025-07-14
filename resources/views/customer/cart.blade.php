@extends('layouts.customer2')
@section('title', 'Keranjang Belanja')

@section('content')
<style>

    /* Animasi Fade In */
    @keyframes fadeIn {x
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    /* Tombol Gradasi Modern */
    .btn-gradient-blue {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        color: #fff;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-gradient-blue:hover {
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.4);
        transform: translateY(-2px);
    }

</style>
<div class="container my-5">
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="bi bi-cart-fill"></i> &nbsp; Keranjang Anda</h3>
    </div>
    <div class="card-body mb-10">
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
    <div class="mt-5">
    
        <h4 class="fw-bold mb-4 text-primary-emphasis"><i class="bi bi-person-vcard"></i> Lengkapi Data Pemesan</h4>

        {{-- ============================================= --}}
        {{-- BAGIAN UNTUK MENAMPILKAN PESAN ERROR VALIDASI --}}
        {{-- ============================================= --}}
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <h6 class="alert-heading">Terdapat Kesalahan!</h6>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.order.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="customer_name" class="form-label">Nama Anda</label>
                    {{-- Tambahkan 'is-invalid' jika ada error & 'old()' untuk data lama --}}
                    <input type="text" name="customer_name" id="customer_name" class="form-control form-control-lg rounded-pill @error('customer_name') is-invalid @enderror" placeholder="Masukkan nama Anda" value="{{ old('customer_name') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="customer_phone" class="form-label">Nomor HP</label>
                    {{-- Tambahkan 'is-invalid' jika ada error & 'old()' untuk data lama --}}
                    <input type="tel" name="customer_phone" id="customer_phone" class="form-control form-control-lg rounded-pill @error('customer_phone') is-invalid @enderror" placeholder="Contoh: 08123456789" value="{{ old('customer_phone') }}" required>
                </div>
            </div>
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-gradient-blue btn-lg rounded-pill">
                    <i class="bi bi-check-circle-fill me-1"></i> Dapatkan Nomor Antrian & Pesan
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