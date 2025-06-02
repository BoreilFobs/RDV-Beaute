@extends('layouts.navigation')
@section('content')
    <section class="main-banner" id="main-banner" style="background-image: url(./assets/images/banner.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="banner-content text-center">
                        <h1 class="h1-title wow zoomIn" data-wow-duration="800ms ">
                            <span class="text-wrapper">
                                <span class="letters">Boreil Fobs</span>
                            </span>
                        </h1>
                        <div class="action-btn d-flex  align-items-center justify-content-center flex-wrap"
                            style="gap: 15px;">
                            <div class="d-flex align-items-center justify-content-center flex-wrap" style="gap: 15px;">
                                <a href="#" class="sec-btn wow slideInRight" data-wow-duration="800ms">Book an
                                    Appointment</a>
                                <a href="{{ route('login') }}" class="sec-btn wow slideInRight"
                                    data-wow-duration="800ms">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Main Banner -->
    <!-- About Us -->
    <section class="about-us" id="about-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="about-content wow fadeInLeftBig">
                        <h2 class="h2-title" data-wow-duration="1000ms">about us</h2>
                        <h3 class="h3-title">our history</h3>
                        <div class="overflow-text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut rutrum quis sem sed pharetra.
                                Morbi tempus lobortis nunc non commodo. Pellentesque habitant morbi tristique senectus
                                et netus et malesuada fames ac turpis egestas.
                                Morbi enim orci, commodo quis lacinia ac, scelerisque at dui. Aliquam at augue et nulla
                                euismod aliquet ut a nisi. Phasellus a neque eleifend, lacinia felis ut, vestibulum mi.
                                Aliquam interdum, velit non elementum pulvinar,
                                metus neque lobortis eros, sed sodales magna justo quis lectus. Sed consequat leo.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1">
                    <div class="about-frame wow fadeInRightBig">
                        {{-- dint forget to add back an image link --}}
                        <div class="about-image" style="background-image: url(./ssets/images/about.jpg);">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us -->
    <!-- Discount -->
    <section class="discount" id="discount" style="background-image: url(./assets/images/image.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">

                </div>
                <div class="col-lg-6 text-center">
                    <div class="discount-text">
                        <!-- <h2></h2> -->
                        <h2 class="ml4">
                            <span class="letters letters-1">Skin Care</span>
                            <span class="letters letters-2">50%</span>
                            <span class="letters letters-3">Off!</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Discount -->
    <!-- Services -->
    <section class="services" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title">
                        <h2 class="h2-title wow fadeInLeftBig" data-wow-duration="800ms">Services</h2>
                        <h3 class="h3-title">Explore Our Services</h3>
                    </div>
                </div>

            </div>
            <div class="for-desk">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="services-box wow fadeInLeftBig">
                            <div class="service-content">
                                <div class="service-image" style="background-image: url(./assets/images/banner.jpg);">
                                    <h3 class="number">02</h3>
                                </div>
                                <div class="service-btn">
                                    <a href="javascript:void(0)" class="service-tag">Manicure & Pedicure</a>
                                    <a href="javascript:void(0)" class="explore">explore
                                        <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="services-box box-1 wow fadeInRightBig">
                            <div class="service-content">
                                <div class="service-image" style="background-image: url(./assets/images/services-3.jpg);">
                                    <h3 class="number">01</h3>
                                </div>
                                <div class="service-btn">
                                    <a href={{ url('/prestations') }} class="service-tag">Professional Makeup</a>
                                    <a href={{ url('/prestations') }} class="explore">explore
                                        <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="for-desk">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="services-box wow fadeInLeftBig">
                            <div class="service-content">
                                <div class="service-image" style="background-image: url(./assets/images/gallery-img.jpg);">
                                    <h3 class="number">03</h3>
                                </div>
                                <div class="service-btn">
                                    <a href={{ url('/prestations') }}" class="service-tag">Body Spa</a>
                                    <a href={{ url('/prestations') }}" class="explore">explore
                                        <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="services-box box-4 wow fadeInRightBig">
                            <div class="service-content">
                                <div class="service-image" style="background-image: url(./assets/images/about.jpg);">
                                    <h3 class="number">04</h3>
                                </div>
                                <div class="service-btn">
                                    <a href={{ url('/prestations') }}" class="service-tag">Haircut & Coloring</a>
                                    <a href={{ url('/prestations') }}" class="explore">explore
                                        <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="for-mobile">
                <div class="row">
                    <div class="mobile-services-scroll"
                        style="display: flex; overflow-x: auto; -webkit-overflow-scrolling: touch; scroll-snap-type: x mandatory; gap: 15px; padding: 10px 0;">
                        <div class="col-auto" style="flex: 0 0 auto; width: auto; scroll-snap-align: start;">
                            <div class="services-box box-1 wow fadeInRightBig">
                                <div class="service-content">
                                    <div class="service-image"
                                        style="background-image: url(./assets/images/services-3.jpg);">
                                        <h3 class="number">01</h3>
                                    </div>
                                    <div class="service-btn">
                                        <a href={{ url('/prestations') }}" class="service-tag">Professional Makeup</a>
                                        <a href={{ url('/prestations') }}" class="explore">explore
                                            <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto" style="flex: 0 0 auto; width: auto; scroll-snap-align: start;">
                            <div class="services-box wow fadeInLeftBig">
                                <div class="service-content">
                                    <div class="service-image"
                                        style="background-image: url(./assets/images/gallery-img.jpg);">
                                        <h3 class="number">03</h3>
                                    </div>
                                    <div class="service-btn">
                                        <a href={{ url('/prestations') }}" class="service-tag">Body Spa</a>
                                        <a href={{ url('/prestations') }}" class="explore">explore
                                            <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto" style="flex: 0 0 auto; width: auto; scroll-snap-align: start;">
                            <div class="services-box box-4 wow fadeInRightBig">
                                <div class="service-content">
                                    <div class="service-image" style="background-image: url(./assets/images/about.jpg);">
                                        <h3 class="number">04</h3>
                                    </div>
                                    <div class="service-btn">
                                        <a href="javascript:void(0)" class="service-tag">Haircut & Coloring</a>
                                        <a href="javascript:void(0)" class="explore">explore
                                            <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Services -->
    <!-- service provide -->
    <section class="service-provide" id="service-provide"
        style="background-image: url(./assets/images/service-provide.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="service-provide-box wow fadeInLeftBig">
                        <div class="service-img" style="background-image: url(./assets/images/icons/highlights.png);">

                        </div>
                        <h3>Highlights</h3>
                        <div class="overflow-text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididunt
                                labore</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-provide-box wow zoomIn">
                        <div class="service-img" style="background-image: url(./assets/images/icons/hair-care.png);">

                        </div>
                        <h3>Hair Care</h3>
                        <div class="overflow-text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididunt
                                labore</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-provide-box wow fadeInRightBig">
                        <div class="service-img" style="background-image: url(./assets/images/icons/haircute.png);">

                        </div>
                        <h3>Haircut</h3>
                        <div class="overflow-text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididunt
                                labore</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End service provide -->
    <!-- Price  -->
    <section class="price" id="price">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="price-frame wow fadeInLeftBig">
                        <div class="price-img"
                            style="background-image: url(./assets/images/element5-digital-ooPx1bxmTc4-unsplash.jpg);">

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1">
                    <div class="title">
                        <h2 class="h2-title wow fadeInRightBig" data-wow-duration="800ms">Prices</h2>
                        <h3 class="h3-title">Haircut Prices</h3>
                    </div>
                    <div class="for-desk">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="price-box wow zoomIn" data-wow-duration="500ms">
                                    <img src="./assets/images/icons/hair-cut&blow-dry.png" alt="Hair Cut">
                                    <h3>Hair Cut With Blow Dry</h3>
                                    <div class="hover">
                                        <a href="javascript:void(0)" class="price-tag">$18.9</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="price-box wow zoomIn" data-wow-duration="800ms">
                                    <img src="./assets/images/icons/blow-dry.png" alt="Blow Dry">
                                    <h3>Blow Dry & Curl</h3>
                                    <div class="hover">
                                        <a href="javascript:void(0)" class="price-tag">$18.9</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="price-box wow zoomIn" data-wow-duration="1100ms">
                                    <img src="./assets/images/icons/color-highlights.png" alt="Color Highlights">
                                    <h3>Color & Highlights</h3>
                                    <div class="hover">
                                        <a href="javascript:void(0)" class="price-tag">$18.9</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="price-box wow zoomIn" data-wow-duration="1400ms">
                                    <img src="./assets/images/icons/shampoo.png" alt="Shampoo">
                                    <h3>Shampoo & Set</h3>
                                    <div class="hover">
                                        <a href="javascript:void(0)" class="price-tag">$18.9</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="for-mobile">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="price-box wow fadeInLeftBig">
                                    <img src="./assets/images/icons/hair-cut&blow-dry.png" alt="Hair Cut">
                                    <h3>Hair Cut With Blow Dry</h3>
                                    <div class="hover">
                                        <a href="javascript:void(0)" class="price-tag">$18.9</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Price -->
    <!-- Testimonials -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="title">
                        <h2 class="h2-title wow zoomIn" data-wow-duration="800ms">They said</h2>
                        <h3 class="h3-title">testimonials</h3>
                    </div>
                </div>
            </div>
            <div class="testimonial-section wow slideInRight" data-wow-duration="800ms"
                style="visibility: visible; animation-duration: 800ms; animation-name: slideInRight;">

                <div class="row">

                    <div class="col-lg-6">

                        <div class="testimonials-box">

                            <div class="testimonials-before"></div>


                            <div class="overflow-text">

                                <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat
                                    massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                                    In enim justo, rhoncus ut, imperdiet a, venenatis
                                    vitae, justo. Curabitur ullamcorper ultricies nisi eget dui. </p>

                            </div>
                            <h3>- Kevin Weaver</h3>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="testimonials-box">

                            <div class="testimonials-before"></div>
                            <div class="overflow-text">

                                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris aliquip. Commodo
                                    consequat. Duis aute irure dolor in reprehenderit. In voluptate velit esse cillum
                                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                    cupidatat. Aenean commodo ligula eget dolor. </p>

                            </div>
                            <h3>- Michelle Ortiz</h3>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End Testimonials -->
    <!-- Start Working Hours -->
    <section class="working-hours" id="working-hours">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title">
                        <h2 class="h2-title wow fadeInLeftBig" data-wow-duration="800ms">Working</h2>
                        <h3 class="h3-title">Working Hours</h3>
                    </div>
                </div>
            </div>
            <div class="working-schedule ">
                <div class="row">
                    <div class="col-lg-6 order-lg-1 order-2 wow fadeInLeftBig">
                        <div class="time-schedule">
                            <span class="day">Working Days</span>
                            <span class="line"></span>
                            <span class="time">9am-9pm</span>
                        </div>
                        <div class="time-schedule">
                            <span class="day">saturday</span>
                            <span class="line"></span>
                            <span class="time">10am-8pm</span>
                        </div>
                        <div class="time-schedule">
                            <span class="day">Sunday</span>
                            <span class="line"></span>
                            <span class="time">Closed</span>
                        </div>
                        <div class="small-text">
                            <span>*</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-2 order-1 wow fadeInRightBig">
                        <div id="timedate">
                            <a id="mon">January</a>
                            <a id="d">1</a>,
                            <a id="y">0</a><br />
                            <a id="h">12</a> :
                            <a id="m">00</a>:
                            <a id="s">00</a>:
                            <a id="mi">000</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Working Hours -->
    <!-- Gallery -->
    <section class="gallery" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="title">
                        <h2 class="h2-title wow zoomIn" data-wow-duration="800ms">Beauty</h2>
                        <h3 class="h3-title ">gallery</h3>
                    </div>
                </div>
            </div>
            <div class="gallery-slider for-desk wow zoomIn">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="gallery-img">
                            <a href="{{ asset('assets/images/gallery-img3.jpg') }}" data-fancybox="gallery">

                                <div class="img" style="background-image: url(./assets/images/gallery-img3.jpg);">

                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="gallery-img sec-img" style="position: absolute; top: 0;left: 0;z-index: 2;">
                            <a href="{{ asset('assets/images/gallery-img2.jpg') }}" data-fancybox="gallery">
                                <div class="img" style="background-image: url(./assets/images/gallery-img2.jpg);">

                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="gallery-img">
                            <a href="assets/images/gallery-img4.jpg" data-fancybox="gallery">
                                <div class="img" style="background-image: url(./assets/images/gallery-img4.jpg);">

                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="gallery-img">
                            <a href="{{ asset('assets/images/gallery-img5.jpg') }}" data-fancybox="gallery">
                                <div class="img" style="background-image: url(./assets/images/gallery-img5.jpg);">

                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="gallery-img">
                            <a href="assets/images/gallery-img.jpg" data-fancybox="gallery">
                                <div class="img" style="background-image: url(./assets/images/gallery-img.jpg);">

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="for-mobile">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="gallery-img wow zoomIn">
                            <a href="assets/images/gallery-img3.jpg" data-fancybox="gallery">
                                <div class="img" style="background-image: url(./assets/images/gallery-img5.jpg);">

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Gallery -->
    <!-- Brands -->
    <div class="brands wow fadeInRightBig" id="brands">
        <div class="container">
            <div class="for-desk">

                <div class="row">
                    <div class="col-lg-3">
                        <a href="javascript:void(0)">
                            <div class="brand-img brand-hover"
                                style="background-image: url(./assets/images/brands/brand-4.png);">

                            </div>
                            <div class="brand-img" style="background-image: url(./assets/images/brands/brand-4.png);">

                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="javascript:void(0)">
                            <div class="brand-img brand-hover"
                                style="background-image: url(./assets/images/brands/brand-3.png);">

                            </div>
                            <div class="brand-img" style="background-image: url(./assets/images/brands/brand-3.png);">

                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="javascript:void(0)">
                            <div class="brand-img brand-hover"
                                style="background-image: url(./assets/images/brands/brand-2.png);">

                            </div>
                            <div class="brand-img" style="background-image: url(./assets/images/brands/brand-2.png);">

                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="javascript:void(0)">
                            <div class="brand-img brand-hover"
                                style="background-image: url(./assets/images/brands/brand-1.png);">

                            </div>
                            <div class="brand-img" style="background-image: url(./assets/images/brands/brand-1.png);">

                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="for-mobile">
                <div class="row">
                    <div class="col-lg-3">
                        <a href="javascript:void(0)">
                            <div class="brand-img" style="background-image: url(./assets/images/brands/brand-4.png);">

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Brands -->
@endsection
