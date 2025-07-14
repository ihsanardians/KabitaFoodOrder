<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f4f7f6;
            margin: 0;
        }

        .sidebar {
            background: linear-gradient(180deg, #0d6efd, #3b8dff);
            padding: 25px 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            color: #fff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }

        .sidebar-header {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            letter-spacing: 1px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: #ffffff;
        }

        .sidebar .nav-link .bi {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px 40px;
            min-height: 100vh;
        }

        .top-nav {
            background-color: #ffffff;
            padding: 12px 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        }

        .nav-link.dropdown-toggle {
            font-weight: 600;
            color: #0d6efd;
        }

        .dropdown-menu a {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="sidebar">
            <div class="sidebar-header">
                Kasir Area
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                        <i class="bi bi-cup-straw"></i> Kelola Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.sales.recap') ? 'active' : '' }}" href="{{ route('admin.sales.recap') }}">
                        <i class="bi bi-journal-text"></i> Rekap Penjualan
                    </a>
                </li>
            </ul>
        </div>

        <!-- Navigation -->
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people-fill"></i> Kelola Kasir
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                    <i class="bi bi-cup-straw"></i> Kelola Menu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.sales.recap') ? 'active' : '' }}" href="{{ route('admin.sales.recap') }}">
                    <i class="bi bi-journal-text"></i> Rekap Penjualan
                </a>
            </li>
        </ul>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navigation -->
            <nav class="top-nav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Halaman Utama -->
            @yield('content')
        </main>
    </div>
</body>
</html>
