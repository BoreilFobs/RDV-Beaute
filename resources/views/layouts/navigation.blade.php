<!DOCTYPE html>
<html lang="en-us">

<head>
    <title>Glow & Chic</title>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="description" content="Institut beauté expert à Douala. Soins personnalisés, produits luxe et ambiance exclusive. Votre éclat naturel, notre passion." />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Open Graph (Facebook, LinkedIn, WhatsApp) -->
    <meta property="og:image" content="{{ asset('assets/images/icons/preview.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:title" content="Glow & Chic">
    <meta property="og:description" content="Nous sommes un institut de référence dans le bien-être et la beauté naturelle, reconnu pour son expertise, son accueil chaleureux et son engagement envers des soins respectueux de la peau et de l'environnement, où chaque client(e) se sent unique " />
    <meta property="og:url" content="https://glowchicgarden.com">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('assets/images/icons/preview.jpg') }}">
    <meta name="twitter:title" content="Your Website Title">
    <meta name="twitter:description" content="Nous sommes un institut de référence dans le bien-être et la beauté naturelle, reconnu pour son expertise, son accueil chaleureux et son engagement envers des soins respectueux de la peau et de l'environnement, où chaque client(e) se sent unique" />

    <!-- Fallback for SEO -->
    <meta name="image" content="{{ asset('assets/images/icons/preview.jpg') }}">
    <link rel="image_src" href="{{ asset('assets/images/icons/preview.jpg') }}">
    <meta name="keywords" content="institut beauté Douala,glow, chic, glow and chic,glow and chic garden , glow and chic eden garden   garden, eden,  soins visage, coiffure, épilation, massage, rendez-vous beauté">
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "GlowChic",
        "name": "Glow & Chic Eden Garden",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Carrefour Express, Cité des Palmiers",
            "addressLocality": "Douala",
            "addressCountry": "CM"
        },
        "telephone": "+237 679 363 348",
        "openingHours": "Mo-Fr 08:00-18:00, Sa 08:00-18:00",
        "image": "{{ asset('assets/images/icons/preview.jpg') }}",
        "priceRange": "$$"
        }
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'GA_MEASUREMENT_ID');
    </script>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Slick Slider CSS Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">

    <!-- Wow Animation CSS Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

    <!-- Main Style CSS Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Fancybox CSS Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/views/layouts/navigation.css') }}">
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
                            <img class="mobile-logo" src="{{ asset('assets/images/icons/logo.png') }}" alt="logo">
                            {{-- <h2 class="mobile-logo fw-bolder" style="font-size: 27px; align-items:center">Glow & Chic</h2> --}}

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
                        <a href="tel:237679363348" title="CALL 237-679-363-348">
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
                            <div class="footer-social-container wow fadeInLeftBig">
                                <h3 class="social-section-title">Connect With Us</h3>
                                <div class="social-grid">
                                    <a href="https://web.facebook.com/profile.php?id=61577007401567" target="_blank" class="social-card">
                                        <div class="social-icon fb-bg">
                                            <i class="fab fa-facebook-f"></i>
                                        </div>
                                        <div class="social-details">
                                            <span class="social-platform">Facebook</span>
                                            <span class="social-handle">Glow & Chic gerden</span>
                                        </div>
                                    </a>
                                    
                                    <a href="https://tiktok.com/@your-tiktok-username" target="_blank" class="social-card">
                                        <div class="social-icon tiktok-bg">
                                            <i class="fab fa-tiktok"></i>
                                        </div>
                                        <div class="social-details">
                                            <span class="social-platform">TikTok</span>
                                            <span class="social-handle">@glowandchic</span>
                                        </div>
                                    </a>
                                    
                                    <a href="https://www.instagram.com/glow.chic237/?igsh=MXgyeWhrN3dyaHIyNA%3D%3D#" target="_blank" class="social-card">
                                        <div class="social-icon ig-bg">
                                            <i class="fab fa-instagram"></i>
                                        </div>
                                        <div class="social-details">
                                            <span class="social-platform">Instagram</span>
                                            <span class="social-handle">@glow.chic237</span>
                                        </div>
                                    </a>
                                    
                                    <a href="mailto:glowchic237@gmail.com" class="social-card">
                                        <div class="social-icon email-bg">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                        <div class="social-details">
                                            <span class="social-platform">Email</span>
                                            <span class="social-handle">glowchic237@gmail.com</span>
                                        </div>
                                    </a>
                                    
                                    <a href="https://wa.me/237679363348" target="_blank" class="social-card">
                                        <div class="social-icon wa-bg">
                                            <i class="fab fa-whatsapp"></i>
                                        </div>
                                        <div class="social-details">
                                            <span class="social-platform">WhatsApp</span>
                                            <span class="social-handle">+237-679-363-348</span>
                                        </div>
                                    </a>
                                    
                                    <a href="tel:+237679363348" class="social-card">
                                        <div class="social-icon phone-bg">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="social-details">
                                            <span class="social-platform">Phone</span>
                                            <span class="social-handle">+237-679-363-348</span>
                                        </div>
                                    </a>
                                     <a href="https://maps.google.com" class="social-card location-card">
                                        <div class="social-icon-wrapper social-icon location">
                                            <i class="fas fa-map-marker-alt social-details"></i>
                                        </div>
                                        <div class="social-info">
                                            <span class="social-label social-platform">Situe</span>
                                            <span class="social-username social-handle">Carrefour Express, Cité des Palmiers, Douala</span>
                                        </div>
                                    </a>
                                </div>
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
                                                    <button type="submit" class="sec-btn sm-btn">Envoyer</button>
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
            </div>
        @endif

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
