<!DOCTYPE html>
<html lang="en-us">

<head>
    <title>Glow & Chic</title>
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="GeekBuzz, HTML5 Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- FavIcon Link -->
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.png') }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Aclonica&family=Pacifico&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Font Awesome CSS Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">

    <!-- Slick Slider CSS Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">

    <!-- Wow Animation CSS Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

    <!-- Main Style CSS Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Fancybox CSS Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <style>
                /* Notification Styles */
        .notification {
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            animation: slideIn 0.3s ease-out;
            position: relative;
            overflow: hidden;
        }

        .notification::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 100%;
            background: rgba(255,255,255,0.3);
            animation: progress 5s linear forwards;
        }

        .notification.success {
            background-color: var(--success-bg);
            color: var(--success-text);
            border-left: 4px solid var(--success);
        }

        .notification.error {
            background-color: var(--error-bg);
            color: var(--error-text);
            border-left: 4px solid var(--error);
        }

        .notification-close {
            background: transparent;
            border: none;
            color: inherit;
            cursor: pointer;
            margin-left: 1rem;
            opacity: 0.7;
        }

        .notification-close:hover {
            opacity: 1;
        }

        /* Add these to your CSS variables */
        :root {
            --success: #28a745;
            --success-bg: rgba(40, 167, 69, 0.15);
            --success-text: #e8f5e9;
            --error: #dc3545;
            --error-bg: rgba(220, 53, 69, 0.15);
            --error-text: #ffebee;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes progress {
            from { width: 100%; }
            to { width: 0%; }
        }
    </style>
</head>

<body onLoad="initClock();">
    <!-- header -->
    <header class="site-header" id="masthead">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="site-branding">
                        <a href="{{url("/")}}">
                            <img class="desktop-logo" src="{{ asset('assets/images/icons/logo.png') }}" alt="logo">
                            <img class="mobile-logo" src="{{ asset('assets/images/icons/mobile-logo.png') }}"
                                alt="mobile logo">

                        </a>
                    </div>
                </div>
                <div class="col-lg-8 pr-0">
                    <nav id="site-navigation" class="main-navigation">
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <div class="menu-menu-1-container">
                            <ul class="menu nav-menu" id="primary-menu">
                                <li class="menu-item {{ request()->is('/') ? 'active' : '' }}"><a
                                        href="/">Accueil</a></li>
                                <li class="menu-item {{ request()->is('prestations*') ? 'active' : '' }}"><a
                                        href="{{route("prestations")}}">Services</a></li>
                                @if (request()->is('/'))
                                    <li class="menu-item {{ request()->is('#contact*') ? 'active' : '' }}"><a
                                            href="#contact">contact</a></li>
                                @endif
                                @if(Auth::check())
                                    <li class="menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                                        <a href="{{ Auth::user()->role == 'admin' ? route('dashboard') : route('userDashboard') }}">Tableau de board</a>
                                    </li>
                                @else
                                    <li class="menu-item {{ request()->is('login*') ? 'active' : '' }}">
                                        <a href="{{ route('login') }}">Connexion</a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </nav>

                    <div class="mobile-call-icon">
                        <a href="tel:1234567890" title="CALL (123) 456-7890">
                            <img src="{{ asset('assets/images/icons/mobile-call.png') }}" alt="mobile call">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @if(session('success'))
            <div class="notification success mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button class="notification-close"><i class="fas fa-times"></i></button>
            </div>
            @endif

            @if($errors->any())
            <div class="notification error mb-4">
                <i class="fas fa-exclamation-circle me-2"></i> une erreur c'est produit essayer encore... entrez un numero valide
                <button class="notification-close"><i class="fas fa-times"></i></button>
            </div>
        @endif
    </header>
    <!-- End header -->
    <!-- Main Banner -->
    @yield('content')

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-top">

            @if (request()->is('/'))
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="map wow fadeInLeftBig" style="background-image: url(./assets/images/map.png);">

                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="contact-form wow fadeInRightBig" id="contact">
                                <div class="title">
                                    <h2 class="h2-title">Contact</h2>
                                    <h3 class="h3-title">Un Mot...</h3>
                                </div>
                                <form method="post" action={{route("messages.store")}} dir="ltr">
                                    @csrf
                                    <div class="screen-reader-response"></div>
                                    <form method="post" class="wpcf7-form" novalidate="novalidate">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="wpcf7-form-control-wrap full-name">
                                                    <input type="text" name="name" value="" size="40"
                                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-input"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Your Name*">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="wpcf7-form-control-wrap your-email">
                                                    <input type="text" name="phone" value=""
                                                        size="40"
                                                        class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-input"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Votre Numero*">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><span class="wpcf7-form-control-wrap your-message">
                                                    <textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea form-input"
                                                        aria-invalid="false" placeholder="Your Message"></textarea>
                                                </span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="submit-btn">
                                                    <button type="submit" class="sec-btn sm-btn">Send Message</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wpcf7-response-output wpcf7-display-none"></div>
                                    </form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p class="copyright">Copyright © 2020 Salon & Beauty. Tout Droit Reserve.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
    {{-- alert display script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide notifications after 5 seconds
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 300);
                }, 5000);
            });

            // Close button functionality
            document.querySelectorAll('.notification-close').forEach(button => {
                button.addEventListener('click', function() {
                    const notification = this.closest('.notification');
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 300);
                });
            });
        });
    </script>
    <!-- Scroll To Top Start -->
    <a id="scrollToTop" class="scrolltop" title="Back To Top" style="display: block;"><i class="fa fa-angle-up"
            aria-hidden="true"></i></a>
    <!-- Scroll To Top eND -->
    <!-- Jquery JS Link -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>

    <!-- Fancybox JS Link -->
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>

    <!-- Custom JS Link -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Bootstrap JS Link -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Slick Slider JS Link -->
    <script src="{{ asset('assets/js/slick.js') }}"></script>

    <!-- Wow Animation JS Link -->
    <script src="{{ asset('assets/js/wow.js') }}"></script>

    <!-- CDN Anime JS Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

    <!-- Anime JS Link -->
    <script src="{{ asset('assets/js/anime.js') }}"></script>
</body>

</html>
