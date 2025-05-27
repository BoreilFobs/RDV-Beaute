@extends('layouts.navigation')

@section('content')
    <style>
        :root {
            --primary: #e1bb87;
            /* Warm Gold/Bronze */
            --dark: #1c1c1c;
            /* Deep Charcoal */
            --gray: #212529;
            /* Darker Gray */
            --light: #f8f9fa;
            /* Off-white/Light Gray */
            --text-muted: #adb5bd;
            /* Bootstrap's text-muted */
        }

        body {
            background-color: var(--dark);
            color: white;
            font-family: 'Roboto', sans-serif;
        }

        /* --- NAVIGATION STYLES (Example - adjust based on your actual navbar) --- */
        .navbar {
            background-color: var(--gray);
            border-bottom: 2px solid var(--primary);
            position: sticky;
            /* Or fixed-top if you want it always visible */
            top: 0;
            z-index: 1020;
            /* Ensure it's above other content */
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: var(--primary) !important;
        }

        .nav-link.active {
            color: var(--primary) !important;
            border-bottom: 2px solid var(--primary);
        }

        /* --- END NAVIGATION STYLES --- */

        /* --- Layout Adjustments for Content Below Navbar --- */
        /* Add padding to body or main content area if navbar is fixed */
        body {
            padding-top: 0;
            /* Adjust if your navbar is fixed-top to avoid overlap */
        }

        @media (min-width: 768px) {

            /* Adjust based on your navbar breakpoint */
            body {
                /* If your navbar is fixed-top and has a height, add padding-top to body */
                /* padding-top: 70px; */
                /* Example height, measure your actual navbar height */
            }
        }


        /* General Dashboard/Content styles */
        .dashboard-header {
            /* Adjust or remove if not needed for this page */
            background: var(--gray);
            padding: 1.5rem;
            border-bottom: 3px solid var(--primary);
            position: relative;
        }

        .service-title {
            font-family: 'Aclonica', sans-serif;
            color: var(--primary);
        }

        /* --- Card Specific Styles --- */
        .services-box {
            height: 100%;
            /* Ensures cards in a row have equal height */
            background: var(--gray);
            /* Darker gray for cards */
            border-radius: 15px 0 15px 0;
            /* Modern, asymmetric border radius */
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            /* Smooth transitions */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            /* Subtle shadow for depth */
            display: flex;
            /* Flexbox for internal content layout */
            flex-direction: column;
            /* Stack image and content vertically */
        }

        .services-box:hover {
            transform: translateY(-8px);
            /* More pronounced lift on hover */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            /* Enhanced shadow on hover */
        }

        .service-image {
            height: 180px;
            /* Consistent image height */
            background-size: cover;
            background-position: center;
            position: relative;
            border-bottom: 3px solid var(--primary);
            /* Separator for image */
        }

        .service-image .number {
            position: absolute;
            bottom: 15px;
            left: 15px;
            font-size: 2.8rem;
            /* Slightly larger number */
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            /* Stronger shadow for readability */
            font-family: 'Aclonica', sans-serif;
            /* Apply special font */
        }

        .service-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            /* Allows content to expand and take available space */
        }

        .service-btn-area {
            /* Renamed from .service-btn to be more descriptive */
            padding: 1rem;
            /* Padding for the entire content area below the image */
            flex-grow: 1;
            /* Allows this section to grow */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* Pushes buttons to bottom */
        }

        .service-tag {
            color: var(--primary);
            font-family: 'Aclonica', sans-serif;
            font-size: 1.25rem;
            /* Larger and more prominent service title */
            margin-bottom: 0.5rem;
            /* Reduce margin to make space */
        }

        .service-price-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            /* More space before description */
        }

        .service-price-info .text-light {
            color: var(--light) !important;
            /* Ensure light color for duration */
            font-weight: 500;
        }

        .service-price-info .h6 {
            color: var(--primary);
            font-size: 1.2rem;
            /* Larger price font */
            font-weight: bold;
        }

        .service-description {
            color: var(--text-muted);
            /* Softer color for description */
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            /* More space before buttons */
            flex-grow: 1;
            /* Allows description to take available height */
        }

        .btn-booking {
            background: var(--primary);
            color: var(--dark) !important;
            border-radius: 8px 0 8px 0;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            /* Larger tap target */
            transition: background-color 0.2s ease-in-out;
        }

        .btn-booking:hover {
            background: #cc9955;
            /* Darker primary on hover */
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
            border-radius: 8px 0 8px 0;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            /* Larger tap target */
            transition: all 0.2s ease-in-out;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: var(--dark);
        }

        /* Dropdown styles */
        .dropdown-menu {
            background-color: var(--gray);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dropdown-item {
            color: white;
        }

        .dropdown-item:hover {
            background-color: var(--dark);
            color: var(--primary);
        }


        /* --- Responsive Adjustments --- */
        @media (max-width: 991.98px) {

            /* Medium devices (tablet landscape) */
            .col-lg-3 {
                /* Change from 4 columns to 2 on tablets */
                width: 50%;
                /* Make them take half width */
            }
        }

        @media (max-width: 767.98px) {

            /* Small devices (mobile) */
            .col-md-6 {
                /* Change from 2 columns to 1 on mobile */
                width: 100%;
            }

            .service-image {
                height: 250px;
                /* Taller images on mobile for impact */
            }

            .services-box {
                margin-left: auto;
                margin-right: auto;
                max-width: 350px;
                /* Constrain width on very small screens for better appearance */
            }
        }
    </style>
    <div style="padding-top: 130px;" class="d-flex justify-content-between align-items-center mb-4">
        {{-- <h2 class="service-title mb-0">
            <i class="fas fa-cut me-2"></i>Hair Services
        </h2>
        <div class="dropdown">
            <button class="btn btn-booking dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-sort me-1"></i> Sort
            </button> --}}
        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
            <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
            <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
            <li><a class="dropdown-item" href="#">Duration</a></li>
        </ul>
    </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="services-box wow fadeInRightBig">
                <div class="service-image"
                    style="background-image: url('https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=80');">
                    <h3 class="number">01</h3>
                </div>
                <div class="service-btn-area"> {{-- Updated class name here --}}
                    <h5 class="service-tag">Premium Haircut</h5>
                    <div class="service-price-info">
                        <span class="text-light small"><i class="fas fa-clock me-1"></i> 45 min</span>
                        <span class="h6 mb-0 text-primary">$45</span>
                    </div>
                    <p class="service-description mb-3">Precision haircut with styling and finishing for a fresh look.</p>
                    <div class="d-grid gap-2 mt-auto"> {{-- mt-auto pushes buttons to bottom --}}
                        <button class="btn btn-booking">
                            <i class="fas fa-calendar-plus me-1"></i> Book Now
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="far fa-heart me-1"></i> Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="services-box wow fadeInRightBig">
                <div class="service-image"
                    style="background-image: url('https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?auto=format&fit=crop&w=800&q=80');">
                    <h3 class="number">02</h3>
                </div>
                <div class="service-btn-area">
                    <h5 class="service-tag">Hair Coloring</h5>
                    <div class="service-price-info">
                        <span class="text-light small"><i class="fas fa-clock me-1"></i> 2 hrs</span>
                        <span class="h6 mb-0 text-primary">$85</span>
                    </div>
                    <p class="service-description mb-3">Professional hair coloring using high-quality, long-lasting dyes.
                    </p>
                    <div class="d-grid gap-2 mt-auto">
                        <button class="btn btn-booking">
                            <i class="fas fa-calendar-plus me-1"></i> Book Now
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="far fa-heart me-1"></i> Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="services-box wow fadeInRightBig">
                <div class="service-image"
                    style="background-image: url('https://images.unsplash.com/photo-1549465220-1a92b217e716?auto=format&fit=crop&w=800&q=80');">
                    <h3 class="number">03</h3>
                </div>
                <div class="service-btn-area">
                    <h5 class="service-tag">Keratin Treatment</h5>
                    <div class="service-price-info">
                        <span class="text-light small"><i class="fas fa-clock me-1"></i> 3 hrs</span>
                        <span class="h6 mb-0 text-primary">$120</span>
                    </div>
                    <p class="service-description mb-3">Transform frizzy hair into smooth, shiny locks with our keratin.</p>
                    <div class="d-grid gap-2 mt-auto">
                        <button class="btn btn-booking">
                            <i class="fas fa-calendar-plus me-1"></i> Book Now
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="far fa-heart me-1"></i> Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="services-box wow fadeInRightBig">
                <div class="service-image"
                    style="background-image: url('https://images.unsplash.com/photo-1546743126-78b17849e4fe?auto=format&fit=crop&w=800&q=80');">
                    <h3 class="number">04</h3>
                </div>
                <div class="service-btn-area">
                    <h5 class="service-tag">Braids & Extensions</h5>
                    <div class="service-price-info">
                        <span class="text-light small"><i class="fas fa-clock me-1"></i> 4 hrs</span>
                        <span class="h6 mb-0 text-primary">$150+</span>
                    </div>
                    <p class="service-description mb-3">Custom braiding and high-quality extensions for versatile styles.
                    </p>
                    <div class="d-grid gap-2 mt-auto">
                        <button class="btn btn-booking">
                            <i class="fas fa-calendar-plus me-1"></i> Book Now
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="far fa-heart me-1"></i> Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
