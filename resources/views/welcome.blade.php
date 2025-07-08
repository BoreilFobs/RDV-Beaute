@extends('layouts.navigation')
@section('content')
    <section class="main-banner" id="main-banner" style="background-image: url(./assets/images/banner.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-content text-center">
                        <h1 class="h1-title wow zoomIn" data-wow-duration="800ms ">
                            <span class="text-wrapper">
                                <span class="letters">Glow & Chic</span>
                            </span>
                        </h1>
                        <div class="action-btn d-flex  align-items-center justify-content-center flex-wrap"
                            style="gap: 15px;">
                            <div class="d-flex align-items-center justify-content-center flex-wrap" style="gap: 15px;">
                                <a href={{route("prestations")}} class="sec-btn wow slideInRight" data-wow-duration="800ms">Réserver un
                                    Rendez-vous</a>
                                @guest
                                    <a href="{{ route('login') }}" class="sec-btn wow slideInRight"
                                        data-wow-duration="800ms">Connexion</a>
                                @endguest
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
        <article class="container">
            <div class="row">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="about-content wow fadeInLeftBig">
                        <h2 class="h2-title" data-wow-duration="1000ms">À propos</h2>
                        <h3 class="h3-title">notre histoire</h3>
                        <div class="overflow-text">
                            <p>Glow & Chic Eden Garden est bien plus qu'un simple institut de beauté. Installé au cœur de Douala, notre centre allie expertise, luxe et bien-être pour vous offrir une expérience unique. Depuis notre création, nous nous engageons à sublimer votre beauté naturelle grâce à des soins personnalisés et des produits haut de gamme. Notre équipe de professionnels passionnés met tout son savoir-faire à votre service dans un cadre élégant et apaisant.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1">
                    <div class="about-frame wow fadeInRightBig">
                        <div class="about-image" style="background-image: url(./assets/images/about.jpg);">
                        </div>
                    </div>
                </div>
            </div>
        </article>
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
                        <h2 class="ml4">
                            <span class="letters letters-1">Soins Visage</span>
                            <span class="letters letters-2">50%</span>
                            <span class="letters letters-3">Réduction!</span>
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
                        <h3 class="h3-title">Découvrez nos prestations</h3>
                    </div>
                </div>
            </div>
            <div class="for-desk">
                <div class="row d-flex flex-wrap" style="gap: 24px;">
                    @if($categories->isEmpty())
                        <div class="col-12 text-center">
                            <div class="alert alert-warning" role="alert">
                                Aucune catégorie enregistrée pour le moment.
                            </div>
                        </div>
                    @endif
                    @foreach($categories as $category)
                        <div class="col-lg-6" style="flex: 1 1 45%; min-width: 320px; max-width: 48%;">
                            <div class="services-box wow fadeInLeftBig">
                                <div class="service-content">
                                    <div class="service-image"
                                         style="background-image: url({{ asset($category->image_url ?? 'assets/images/default.jpg') }});">
                                        <h3 class="number">{{ $loop->iteration < 10 ? '0'.$loop->iteration : $loop->iteration }}</h3>
                                    </div>
                                    <div class="service-btn">
                                        <a href="{{ url('/prestations?category=' . $category->id) }}" class="service-tag">{{ $category->name }}</a>
                                        <a href="{{ url('/prestations?category=' . $category->id) }}" class="explore">découvrir
                                            <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="for-mobile">
                <div class="row">
                    <div class="mobile-services-scroll"
                        style="display: flex; overflow-x: auto; -webkit-overflow-scrolling: touch; scroll-snap-type: x mandatory; gap: 15px; padding: 10px 0;">
                        @if($categories->isEmpty())
                        <div class="col-12 text-center">
                            <div class="alert alert-warning" role="alert">
                                Aucune catégorie enregistrée pour le moment.
                            </div>
                        </div>
                    @endif
                        @foreach($categories as $category)
                        <div class="col-auto" style="flex: 0 0 auto; width: auto; scroll-snap-align: start;">
                            <div class="services-box wow fadeInLeftBig">
                                <div class="service-content">
                                    <div class="service-image"
                                        style="background-image: url({{ asset($category->image_url ?? 'assets/images/default.jpg') }});">
                                        <h3 class="number">{{ $loop->iteration < 10 ? '0'.$loop->iteration : $loop->iteration }}</h3>
                                    </div>
                                    <div class="service-btn">
                                        <a href="{{ url('/prestations?category=' . $category->id) }}" class="service-tag">{{ $category->name }}</a>
                                        <a href="{{ url('/prestations?category=' . $category->id) }}" class="explore">découvrir
                                            <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
                        <h3>Mèches & Colorations</h3>
                        <div class="overflow-text">
                            <p>Transformez votre look avec nos services de mèches et colorations professionnelles, réalisés avec des produits de qualité.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-provide-box wow zoomIn">
                        <div class="service-img" style="background-image: url(./assets/images/icons/hair-care.png);">
                        </div>
                        <h3>Soins Capillaires</h3>
                        <div class="overflow-text">
                            <p>Redonnez vie à vos cheveux avec nos soins nutritifs et traitements revitalisants adaptés à chaque type de cheveu.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-provide-box wow fadeInRightBig">
                        <div class="service-img" style="background-image: url(./assets/images/icons/haircute.png);">
                        </div>
                        <h3>Coupes Stylées</h3>
                        <div class="overflow-text">
                            <p>Des coupes modernes et personnalisées réalisées par nos coiffeurs experts pour sublimer votre style.</p>
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
                        <h2 class="h2-title wow fadeInRightBig" data-wow-duration="800ms">Tarifs</h2>
                        <h3 class="h3-title">Nos prix coiffure</h3>
                    </div>
                    <div class="for-desk">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="price-box wow zoomIn" data-wow-duration="500ms">
                                    <img src="./assets/images/icons/hair-cut&blow-dry.png" alt="Coupe de cheveux">
                                    <h3>Coupe avec brushing</h3>
                                    <div class="hover">
                                        <a href="#" class="price-tag">25 000 FCFA</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="price-box wow zoomIn" data-wow-duration="800ms">
                                    <img src="./assets/images/icons/blow-dry.png" alt="Brushing">
                                    <h3>Brushing & Mise en plis</h3>
                                    <div class="hover">
                                        <a href="#" class="price-tag">18 000 FCFA</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="price-box wow zoomIn" data-wow-duration="1100ms">
                                    <img src="./assets/images/icons/color-highlights.png" alt="Couleur">
                                    <h3>Couleur & Mèches</h3>
                                    <div class="hover">
                                        <a href="#" class="price-tag">45 000 FCFA</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="price-box wow zoomIn" data-wow-duration="1400ms">
                                    <img src="./assets/images/icons/shampoo.png" alt="Shampooing">
                                    <h3>Shampooing & Soin</h3>
                                    <div class="hover">
                                        <a href="#" class="price-tag">15 000 FCFA</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="for-mobile">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="price-box wow fadeInLeftBig">
                                    <img src="./assets/images/icons/hair-cut&blow-dry.png" alt="Coupe de cheveux">
                                    <h3>Coupe avec brushing</h3>
                                    <div class="hover">
                                        <a href="#" class="price-tag">25 000 FCFA</a>
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
                        <h2 class="h2-title wow zoomIn" data-wow-duration="800ms">Témoignages</h2>
                        <h3 class="h3-title">nos clients parlent de nous</h3>
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
                                <p>Je suis fidèle à Glow & Chic depuis 2 ans et je ne pourrais plus m'en passer ! Leur expertise en coloration est tout simplement incroyable. J'ai enfin trouvé des professionnels qui comprennent parfaitement mes cheveux crépus.</p>
                            </div>
                            <h3>- Aïssatou Diallo</h3>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="testimonials-box">

                            <div class="testimonials-before"></div>
                            <div class="overflow-text">
                                <p>Une véritable oasis de bien-être au cœur de Douala. Le massage visage que j'ai reçu était divin, et l'accueil chaleureux. Je recommande vivement ce centre à toutes les femmes soucieuses de leur beauté et de leur bien-être.</p>
                            </div>
                            <h3>- Stéphanie Mbarga</h3>

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
                        <h2 class="h2-title wow fadeInLeftBig" data-wow-duration="800ms">Horaires</h2>
                        <h3 class="h3-title">d'ouverture</h3>
                    </div>
                </div>
            </div>
            <div class="working-schedule ">
                <div class="row">
                    <div class="col-lg-6 order-lg-1 order-2 wow fadeInLeftBig">
                        <div class="time-schedule">
                            <span class="day">Lundi - Vendredi</span>
                            <span class="line"></span>
                            <span class="time">8h - 18h</span>
                        </div>
                        <div class="time-schedule">
                            <span class="day">Samedi</span>
                            <span class="line"></span>
                            <span class="time">8hh - 18h</span>
                        </div>
                        <div class="time-schedule">
                            <span class="day">Dimanche</span>
                            <span class="line"></span>
                            <span class="time">Fermé</span>
                        </div>
                        <div class="small-text">
                            <span>*</span>
                            <p>Pour des rendez-vous en dehors des horaires d'ouverture, veuillez nous contacter directement.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-2 order-1 wow fadeInRightBig">
                        <div id="timedate">
                            <a id="mon">Janvier</a>
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
                        <h2 class="h2-title wow zoomIn" data-wow-duration="800ms">Galerie</h2>
                        <h3 class="h3-title ">Beauté</h3>
                    </div>
                </div>
            </div>
            <a href="{{ asset("assets/images/flier.jpg") }}" data-fancybox="gallery">
                <img src="{{asset("assets/images/flier.jpg")}}" alt="Gallery Icon" />
            </a>

            @if($images->isEmpty())
                {{-- <div class="col-12 text-center">
                    <div class="alert alert-warning" role="alert">
                        Aucune image disponible dans la galerie.
                    </div>
                </div> --}}
            @else
            <div class="gallery-slider for-desk wow zoomIn">
                    <div class="row">
                        @foreach($images as $image)
                            <div class="col-lg-4">
                                <div class="gallery-img">
                                    <a href="{{ asset($image->img_url) }}" data-fancybox="gallery">
                                        <div class="img" style="background-image: url({{ asset($image->img_url) }});"></div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="for-mobile">
                    <div class="row">
                        @foreach($images as $image)
                            <div class="col-lg-4">
                                <div class="gallery-img wow zoomIn">
                                    <a href="{{ asset($image->img_url) }}" data-fancybox="gallery">
                                        <div class="img" style="background-image: url({{ asset($image->img_url) }});"></div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- End Gallery -->
    <!-- Brands -->
    <div class="brands wow fadeInRightBig" id="brands">
        <div class="container">
            <div class="for-desk">
                <div class="row">
                    <div class="col-lg-3">
                        <a href="#">
                            <div class="brand-img brand-hover"
                                style="background-image: url(./assets/images/brands/brand-4.png);">
                            </div>
                            <div class="brand-img" style="background-image: url(./assets/images/brands/brand-4.png);">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="#">
                            <div class="brand-img brand-hover"
                                style="background-image: url(./assets/images/brands/brand-3.png);">
                            </div>
                            <div class="brand-img" style="background-image: url(./assets/images/brands/brand-3.png);">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="#">
                            <div class="brand-img brand-hover"
                                style="background-image: url(./assets/images/brands/brand-2.png);">
                            </div>
                            <div class="brand-img" style="background-image: url(./assets/images/brands/brand-2.png);">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="#">
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
                        <a href="#">
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