<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CashierGO</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --sidebar-bg: #1e40af;
            --sidebar-text: #ffffff;
            --sidebar-active-bg: #ffffff;
            --sidebar-active-text: #1e40af;
            --sidebar-hover-bg: #3b82f6;
            --sidebar-hover-text: #ffffff;
        }

        body {
            display: flex;
            min-height: 100vh;
        }

        #app {
            display: flex;
            flex: 1;
        }

        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            height: 100vh;
            position: sticky;
            top: 0;
            padding: 20px 0;
            transition: all 0.3s;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand {
            color: var(--sidebar-text);
            font-size: 1.5rem;
            font-weight: 600;
            padding: 0 20px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-link {
            display: block;
            padding: 12px 20px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-left: 4px solid transparent;
            transition: all 0.3s;
            margin: 5px 10px;
            border-radius: 5px;
        }

        .sidebar-link:hover {
            background-color: var(--sidebar-hover-bg);
            color: var(--sidebar-hover-text);
        }

        .sidebar-link.active {
            background-color: var(--sidebar-active-bg);
            color: var(--sidebar-active-text);
            border-left: 4px solid var(--sidebar-active-text);
            font-weight: 500;
        }

        .main-content {
            flex: 1;
            overflow-x: hidden;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar-brand,
            .sidebar-link span {
                display: none;
            }

            .sidebar-link {
                text-align: center;
                padding: 12px 5px;
                margin: 5px;
            }

            .sidebar-link i {
                font-size: 1.2rem;
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div id="app">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-brand">
                CashierGO
            </div>
            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('home') }}" class="sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if(Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('user') }}" class="sidebar-link {{ request()->routeIs('user') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('produk') }}" class="sidebar-link {{ request()->routeIs('produk') ? 'active' : '' }}">
                        <i class="fas fa-box-open"></i>
                        <span>Produk</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('transaksi') }}" class="sidebar-link {{ request()->routeIs('transaksi') ? 'active' : '' }}">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan') }}" class="sidebar-link {{ request()->routeIs('laporan') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
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
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <div class="container">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>

</html>