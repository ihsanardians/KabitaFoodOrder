@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="makanan" {{ $product->category == 'makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="minuman" {{ $product->category == 'minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="snack" {{ $product->category == 'snack' ? 'selected' : '' }}>Snack</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <input class="form-control" type="file" id="image" name="image">

                    @if ($product->image)
                        <div class="mt-2">
                            <p>Gambar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" width="150">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
