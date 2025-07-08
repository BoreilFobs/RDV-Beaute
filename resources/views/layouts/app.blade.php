<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Glow & Chic')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/views/layouts/app.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Desktop Sidebar -->
            <div class="col-md-2 d-none d-md-block p-0">
                <div class="dashboard-nav sticky-top" style="top: 0; height: 100vh;">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/icons/logo.png') }}" alt="Logo" style="height: 40px;">
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('userDashboard') ? 'active' : '' }}"
                                href="{{ route('userDashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Tableau de Board</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}"
                                href="{{ route('appointments.index') }}">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Rendez Vous</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                                href="{{ route('home') }}">
                                <i class="fas fa-globe-americas"></i>
                                <span>aller au site</span>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                                href="{{ route('prestations') }}">
                                <i class="fas fa-list"></i>
                                <span>Voir les prestations</span>
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link logout-btn" href="#"
                                    onclick="event.preventDefault(); if(confirm('etes vous sure de vouloir vous deconnecter?')) this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Deconnexion</span>
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
                    href="{{ route('userDashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Accueil</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}"
                    href="{{ route('appointments.index') }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Rendez vous</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('favourite.*') ? 'active' : '' }}"
                    href="{{ route('favourite.index') }}">
                    <i class="fas fa-heart"></i>
                    <span>Favorites</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('prestations') ? 'active' : '' }}"
                    href="{{ route('prestations') }}">
                    <i class="fas fa-list"></i>
                    <span>Voir les prestations</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('prestations') ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <i class="fas fa-globe-americas"></i>
                    <span>Aller au site</span>
                </a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link logout-btn" href="#"
                        onclick="event.preventDefault(); if(confirm('etes vous sure de vouloir vous deconnecter?')) this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Deconnexion</span>
                    </a>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
