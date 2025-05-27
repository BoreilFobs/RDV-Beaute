<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | Beauty & Salon</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    <!-- Dashboard Header -->
    <!-- Dashboard Content -->
    <div class="container py-4 pb-4">
        <div class="row mb-5 pb-5">
            <!-- Navigation Sidebar (Hidden on mobile) -->
            <div class="col-md-3 d-none d-md-block">
                <div class="dashboard-nav">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('userDashboard') ? 'active' : '' }}"
                                href="{{ route('userDashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}"
                                href="{{ route('appointments.index') }}">
                                <i class="fas fa-calendar-alt"></i> My Appointments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                                href="{{ route('favourite.index') }}">
                                <i class="fas fa-heart"></i> Favorites
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link" href="#"
                                    onclick="return confirm('Are you sure you want to logout?') && this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @yield('content')
        </div>
        <!-- Mobile Bottom Navigation (Visible only on mobile) -->
        <div class="fixed-bottom d-md-none">
            <div class="dashboard-nav">
                <ul class="nav justify-content-around">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('userDashboard') ? 'active' : '' }}"
                            href="{{ route('userDashboard') }}">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}"
                            href="{{ route('appointments.index') }}">
                            <i class="fas fa-calendar-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                            href="{{ route('favourite.index') }}">
                            <i class="fas fa-heart"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="nav-link" href="#"
                                onclick="return confirm('Are you sure you want to logout?') && this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
