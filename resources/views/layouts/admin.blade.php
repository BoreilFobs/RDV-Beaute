<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beauty & Salon')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <style>
        :root {
            --primary: #e1bb87;
            --dark: #121212;
            --gray: #1e1e1e;
            --light: #f8f9fa;
            --accent: #6bd1e3;
            --text-muted: #a0a0a0;
        }

        body {
            background-color: var(--dark);
            color: white;
            font-family: 'Poppins', sans-serif;
            padding-bottom: 80px;
            width: 100%;
        }

        /* Modern Sidebar */
        .dashboard-nav {
            background: linear-gradient(145deg, #252525, #1a1a1a);
            border-radius: 0 20px 20px 0;
            height: 100%;
            padding: 2rem 1rem;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
            border-right: 3px solid var(--primary);
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            color: var(--text-muted);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .nav-link i {
            width: 24px;
            margin-right: 12px;
            text-align: center;
            font-size: 1.1rem;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(225, 187, 135, 0.15);
            color: var(--primary);
            transform: translateX(5px);
        }

        .nav-link.active {
            border-left: 3px solid var(--primary);
        }

        /* Mobile Bottom Nav */
        .mobile-nav {
            background: linear-gradient(145deg, #252525, #1a1a1a);
            border-top: 3px solid var(--primary);
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.2);
            padding: 0.5rem 0;
        }

        .mobile-nav .nav-link {
            flex-direction: column;
            font-size: 0.7rem;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .mobile-nav .nav-link i {
            margin-right: 0;
            margin-bottom: 0.25rem;
            font-size: 1.2rem;
        }

        .mobile-nav .nav-link.active {
            background: rgba(225, 187, 135, 0.15);
            color: var(--primary);
            transform: translateY(-5px);
            border-left: none;
            border-top: 2px solid var(--primary);
        }

        /* Main Content Area */
        .main-content {
            padding: 0 !important;
            width: 100% !important;
            background-color: var(--dark);
            min-height: calc(100vh - 80px);
        }

        /* Logout Button */
        .logout-btn {
            color: #ff6b6b;
        }

        .logout-btn:hover {
            color: #ff5252;
            background: rgba(255, 107, 107, 0.1);
        }

        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .dashboard-nav {
                border-radius: 0;
                border-right: none;
                padding: 1rem;
            }

            .main-content {
                padding: 1.5rem;
            }
        }

        @media (min-width: 768px) {
            body {
                padding-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Desktop Sidebar -->
            <div class="col-md-2 d-none d-md-block p-0">
                <div class="dashboard-nav sticky-top" style="top: 0; height: 100vh;">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="Logo" style="height: 40px;">
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('userDashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                                href="{{ route('categories.index') }}">
                                <i class="fas fa-th-large"></i>
                                <span>Categories
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                                href="{{ route('users.index') }}">
                                <i class="fas fa-users"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('DashAppointment.*') ? 'active' : '' }}"
                                href="{{ route('DashAppointment.index') }}">
                                <i class="fas fa-calendar-check"></i>
                                <span>Appointments</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('offers.*') ? 'active' : '' }}"
                                href="{{ route('offers.index') }}">
                                <i class="fas fa-spa"></i>
                                <span>Prestations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                                href="{{ route('favourite.index') }}">
                                <i class="fas fa-boxes"></i>
                                <span>Stock</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                                href="{{ route('favourite.index') }}">
                                <i class="fas fa-comments"></i>
                                <span>Message</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                                href="{{ route('favourite.index') }}">
                                <i class="fas fa-photo-video"></i>
                                <span>Gallery</span>
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link logout-btn" href="#"
                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to logout?')) this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto p-0">
                <div class="main-content">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <nav class="mobile-nav fixed-bottom d-md-none">
        <ul class="nav justify-content-around">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('userDashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                    href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('DashAppointment.*') ? 'active' : '' }}"
                    href="{{ route('DashAppointment.index') }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('offers.*') ? 'active' : '' }}"
                    href="{{ route('offers.index') }}">
                    <i class="fas fa-spa"></i>
                    <span>Pretations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                    href="{{ route('favourite.index') }}">
                    <i class="fas fa-boxes"></i>
                    <span>Stock</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                    href="{{ route('favourite.index') }}">
                    <i class="fas fa-comments"></i>
                    <span>Message</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                    href="{{ route('favourite.index') }}">
                    <i class="fas fa-photo-video"></i>
                    <span>Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link logout-btn" href="#"
                        onclick="event.preventDefault(); if(confirm('Are you sure you want to logout?')) this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
