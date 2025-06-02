<!DOCTYPE html>
<html lang="en-us">

<head>
    <title>Beauty & Salon</title>
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
</head>

<body onLoad="initClock();">
    <!-- header -->
    <header class="site-header" id="masthead">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="site-branding">
                        <a href="index.html">
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
                                        href="/">Home</a></li>
                                @if (request()->is('/'))
                                    <li class="menu-item {{ request()->is('#about*') ? 'active' : '' }}"><a
                                            href="#about-us">about</a></li>
                                    <li class="menu-item {{ request()->is('#gallery*') ? 'active' : '' }}"><a
                                            href="#gallery">Gallery</a></li>
                                    <li class="menu-item {{ request()->is('#services*') ? 'active' : '' }}"><a
                                            href="#services">Services</a></li>
                                    <li class="menu-item {{ request()->is('#shop*') ? 'active' : '' }}"><a
                                            href="#price">shop</a></li>
                                    <li class="menu-item {{ request()->is('#contact*') ? 'active' : '' }}"><a
                                            href="#contact">contact</a></li>
                                @endif
                                <li class="menu-item {{ request()->is('login*') ? 'active' : '' }}"><a
                                        href={{ route('login') }}>login</a></li>
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
    </header>
    <!-- End header -->
    <!-- Main Banner -->
    @yield('content')

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-top">

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
                                <h3 class="h3-title">Get in Touch</h3>
                            </div>
                            <div role="form" class="wpcf7" id="wpcf7-f22-o1" lang="en-US" dir="ltr">
                                <div class="screen-reader-response"></div>
                                <form method="post" class="wpcf7-form" novalidate="novalidate">
                                    <div style="display: none;">
                                        <input type="hidden" name="_wpcf7" value="22">
                                        <input type="hidden" name="_wpcf7_version" value="5.1.7">
                                        <input type="hidden" name="_wpcf7_locale" value="en_US">
                                        <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f22-o1">
                                        <input type="hidden" name="_wpcf7_container_post" value="0">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="wpcf7-form-control-wrap full-name">
                                                <input type="text" name="full-name" value="" size="40"
                                                    class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-input"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Your Name*">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="wpcf7-form-control-wrap your-email">
                                                <input type="email" name="your-email" value=""
                                                    size="40"
                                                    class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-input"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Your Email*">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12"><span class="wpcf7-form-control-wrap your-message">
                                                <textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea form-input"
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p class="copyright">Copyright © 2020 Salon & Beauty. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
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
