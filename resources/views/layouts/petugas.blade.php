<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Petugas') - Sistem Peminjaman Alat</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        /* SIDEBAR */
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: #1e2a3e;
            color: #fff;
            transition: all 0.3s;
            height: 100vh;
            position: sticky;
            top: 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        #sidebar.active {
            margin-left: -260px;
        }
        #sidebar .sidebar-header {
            padding: 1.5rem 1rem;
            background: #0f1722;
            text-align: center;
            border-bottom: 1px solid #2c3e50;
        }
        #sidebar .sidebar-header h3 {
            font-size: 1.3rem;
            margin-bottom: 0;
            font-weight: 600;
        }
        #sidebar .sidebar-header p {
            font-size: 0.8rem;
            margin-top: 5px;
            color: #adb5bd;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul li {
            padding: 0 15px;
        }
        #sidebar ul li a {
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            color: #cfdde6;
            border-radius: 10px;
            transition: 0.2s;
            text-decoration: none;
        }
        #sidebar ul li a:hover {
            background: #2c3e50;
            color: #fff;
        }
        #sidebar ul li.active a {
            background: #0d6efd;
            color: white;
        }
        #sidebar ul li a i {
            width: 24px;
            text-align: center;
        }
        /* MAIN CONTENT */
        #content {
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s;
        }
        /* NAVBAR */
        .navbar-custom {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 0.8rem 1.5rem;
        }
        .navbar-custom .navbar-brand {
            font-weight: 600;
            color: #1e2a3e;
        }
        .toggle-btn {
            background: #0d6efd;
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-info .avatar {
            width: 40px;
            height: 40px;
            background: #0d6efd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        /* MAIN PANEL */
        .main-panel {
            padding: 20px 30px;
        }
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -260px;
            }
            #sidebar.active {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="wrapper">
    <!-- SIDEBAR -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-tools me-2"></i> FishGearInventaris</h3>
            <p>Petugas Operasional</p>
        </div>
        <ul class="components list-unstyled">
            <li class="{{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                <a href="{{ route('petugas.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="{{ request()->routeIs('petugas.peminjaman.index') ? 'active' : '' }}">
                <a href="{{ route('petugas.peminjaman.index') }}">
                    <i class="fas fa-clock"></i> Peminjaman Menunggu
                </a>
            </li>
            <li class="{{ request()->routeIs('petugas.pengembalian.index') ? 'active' : '' }}">
            <a href="{{ route('petugas.pengembalian.index') }}">
                <i class="fas fa-undo-alt"></i> Pantau Pengembalian
            </a>
            </li>
            <li class="{{ request()->routeIs('petugas.laporan.index') ? 'active' : '' }}">
                <a href="{{ route('petugas.laporan.index') }}">
                    <i class="fas fa-file-alt"></i> Laporan
                </a>
            </li>
            <hr class="mx-3 my-2" style="border-color: #2c3e50;">
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <!-- PAGE CONTENT -->
    <div id="content">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn toggle-btn me-3">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="navbar-brand">Halo, {{ Auth::user()->name ?? 'Petugas' }}!</span>
                <div class="ms-auto">
                    <div class="user-info">
                        <span class="d-none d-md-block">{{ Auth::user()->name ?? 'Petugas' }}</span>
                        <div class="avatar">
                            {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT YIELD -->
        <div class="main-panel">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
@stack('scripts')
</body>
</html>