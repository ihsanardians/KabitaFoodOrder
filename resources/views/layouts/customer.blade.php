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
        html { scroll-behavior: smooth;}

        .logo-kabita {
            width: 160px;
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Responsive scaling jika diperlukan */
        @media (min-width: 768px) {
            .logo-kabita {
                width: 140px;
            }
        }

        @media (min-width: 992px) {
            .logo-kabita {
                width: 180px;
            }
        }

    </style>
</head>
<body>

    <header class="bg-white shadow-sm sticky-top py-3 mb-4" style="border-bottom: 4px solid #0d6efd;">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a href="{{ route('customer.menu.index') }}" class="text-decoration-none text-dark d-flex align-items-center">
                <img src="{{ asset('images/logo/logo-kabita.png') }}" alt="Logo Kabita" style="height: 40px;" class="me-2">
                <span class="fs-4 fw-bold">Kabita Food</span>
            </a>

            <a href="{{ route('customer.cart.index') }}" class="btn btn-primary position-relative">
                <i class="bi bi-cart-fill"></i>
                <span class="ms-1 d-none d-sm-inline">Keranjang</span>

                @if(session('cart') && count(session('cart')) > 0)
                    {{-- Beri ID di sini --}}
                    <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count(session('cart')) }}
                    </span>
                @else
                    {{-- Sediakan juga elemennya walau kosong, agar bisa diisi oleh JS --}}
                    <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">0</span>
                @endif
            </a>
        </div>
    </header>


    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

            <!-- ------------------------ Menu Hero Section ------------------------ -->
    <section>
        <div class="container">
            <div class="mt-4 mt-md-0 mb-3 bg-primary text-white rounded-3">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8 p-5 my-auto align-center">
                            <h1 class="display-5 fw-bold">Katalog Menu Makanan & Minuman Kabita Food</h1>
                            <p class="col-md-10">
                                Disini kalian bisa nemuin semua menu dengan berbagai macam kategori yang dapat kalian
                                pesan
                                di restoran kami, scroll kebawah ya!
                            </p>
                            <a href="{{ route('customer.menu.index') }}#menu-section" class="btn btn-outline-light text-white px-4 fw-bold">
                                Lihat semua &nbsp; <i class="bi bi-arrow-down-circle-fill"></i>
                            </a>
                        </div>
                        <div class="col-md-4 my-auto p-0 mb-4">
                            <img src="{{ url('images/logo/logo-kabita.png') }}"
                                alt="Logo Kabita"
                                class="d-block mx-auto"
                                style="width: 160px; height: auto;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

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
    @stack('scripts')
</body>
</html>