<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pesan Menu') - Kabita Food</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f0f8ff; /* AliceBlue - soft blue-white */ }
        .navbar-brand { font-weight: bold; color: #0d6efd !important; }
        .card { border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: transform .2s; }
        .card:hover { transform: scale(1.03); }
        .btn-primary { background-color: #0d6efd; border-color: #0d6efd; }
        .btn-primary:hover { background-color: #0b5ed7; border-color: #0a58ca; }
        .header-main { background-color: #ffffff; padding: 1rem 0; text-align: center; margin-bottom: 2rem; border-bottom: 3px solid #0d6efd; }
        .header-main h1 { color: #0d6efd; font-weight: 700; }
        .cart-icon { position: fixed; bottom: 20px; right: 20px; z-index: 1000; }
    </style>
</head>
<body>

    <header class="header-main">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Kiri: Judul -->
            <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <img src="{{ asset('images/logo/logo-kabita.png') }}"
                alt="Logo Kabita"
                class="me-3"
                style="height: 48px; width: auto;">
            <span class="fs-3 fw-bold">Kabita Food</span>
            </a>
            

        <!-- Kanan: Tombol Keranjang -->
        <button class="btn btn-primary text-white fw-500 px-4 position-relative"
            onclick="location.href='{{ route('customer.cart.index') }}'" type="button">
            <i class="bi bi-cart-fill"></i> &nbsp; Keranjang
            @if(session('cart') && count(session('cart')) > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count(session('cart')) }}
                </span>
            @endif
        </button>


        </div>
    </header>


    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')

    </main>


    <footer class="footer bg-primary text-white mt-auto py-5">
        <div class="container">
            <div class="row">
                {{-- Kolom Kiri: Diberi kelas text-center dan text-md-start --}}
                <div class="col-lg-8 col-md-7 mb-4 mb-md-0 text-center text-md-start">
                    <h4 class="fw-bold">Kabita Food - Harga kaki lima rasa bintang lima!</h4>
                    <p class="text-white-50">
                        Kabita Food adalah restoran yang menyediakan berbagai macam kategori makanan mulai dari minuman, dessert dan lain lain dengan harga kaki lima namun rasanya bintang lima. Outlet kita selalu rame, jadi jangan lupa reservasi ya!
                    </p>
                    <small>&copy; {{ date('Y') }} Kabita Food. All rights reserved.</small>
                </div>

                {{-- Kolom Kanan: Diberi kelas text-center dan text-md-start --}}
                <div class="col-lg-4 col-md-5 text-center text-md-start">
                    <h5 class="fw-bold">Sosial Media</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="bi bi-whatsapp"></i> Whatsapp
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="bi bi-instagram"></i> Instagram
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>