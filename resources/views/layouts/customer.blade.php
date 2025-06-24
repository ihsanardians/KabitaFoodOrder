<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pesan Menu') - Resto Gacoan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f0f8ff; /* AliceBlue - soft blue-white */ }
        .navbar-brand { font-weight: bold; color: #0d6efd !important; }
        .card { border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: transform .2s; }
        .card:hover { transform: scale(1.03); }
        .btn-primary { background-color: #0d6efd; border-color: #0d6efd; }
        .btn-primary:hover { background-color: #0b5ed7; border-color: #0a58ca; }
        .header-main { background-color: #ffffff; padding: 2rem 0; text-align: center; margin-bottom: 2rem; border-bottom: 3px solid #0d6efd; }
        .header-main h1 { color: #0d6efd; font-weight: 700; }
        .cart-icon { position: fixed; bottom: 20px; right: 20px; z-index: 1000; }
    </style>
</head>
<body>

    <header class="header-main">
        <div class="container">
            <h1>Selamat Datang di Resto Kami</h1>
            <p class="lead">Pesan menu favoritmu tanpa antri!</p>
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

    <a href="{{ route('customer.cart.index') }}" class="btn btn-primary btn-lg rounded-circle cart-icon shadow-lg">
        <i class="bi bi-cart-fill"></i>
        @if(session('cart') && count(session('cart')) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ count(session('cart')) }}
            </span>
        @endif
    </a>

    <footer class="text-center py-4 mt-5">
        <p>&copy; {{ date('Y') }} Resto Gacoan KW. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>