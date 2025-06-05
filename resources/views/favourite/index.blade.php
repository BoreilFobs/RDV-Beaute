@extends('layouts.app')
@section('content')
    <style>
        /* Add these styles to your existing base layout or custom.css */

        /* Variables (ensure these are consistent across your app) */
        :root {
            --primary: #E1BB87;
            /* A warm, inviting gold/bronze */
            --accent: #6BD1E3;
            /* A cool, vibrant blue/cyan */
            --dark: #1A1A1A;
            /* Dark background */
            --gray: #252525;
            /* Slightly lighter dark for cards/elements */
            --text-muted: #A0A0A0;
            /* Muted text for secondary info */
            --text-light: #E0E0E0;
            /* Light text for main content */
        }


        /* Reusing existing card-service or creating a new one if needed for distinct styling */
        .favorite-product-card {
            background-color: var(--gray);
            /* Use the --gray variable */
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            height: 100%;
            /* Ensures all cards in a row have equal height */
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(255, 255, 255, 0.08);
            /* Subtle border */
        }

        .favorite-product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6), 0 0 10px rgba(225, 187, 135, 0.3);
            /* Primary accent glow on hover */
            border-color: var(--primary);
            /* Highlight border on hover */
        }

        .favorite-product-img {
            height: 200px;
            /* Standard height for product images */
            width: 100%;
            object-fit: cover;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .favorite-product-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            /* Allows content to push actions to bottom */
        }

        .favorite-product-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
            /* Match service-title styling */
            margin-bottom: 0.5rem;
        }

        .favorite-product-text {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 1rem;
            flex-grow: 1;
            /* Allows text to take available space */
        }

        .favorite-product-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--accent);
            /* Consistent with accent color for prices */
            margin-bottom: 1rem;
            /* Space before buttons */
            display: block;
            /* Ensure it takes its own line */
        }

        /* Action button for removing from favorites */
        .btn-remove-favorite {
            background-color: transparent;
            border: 1px solid #dc3545;
            /* Red border */
            color: #dc3545;
            /* Red text */
            padding: 0.6rem 1rem;
            border-radius: 50px;
            /* More rounded like btn-booking */
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .btn-remove-favorite:hover {
            background-color: #dc3545;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        /* Empty state styling */
        .empty-state-card {
            background-color: var(--gray);
            border-radius: 1rem;
            padding: 3rem 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: var(--text-light);
        }

        .empty-state-card i {
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-size: 4rem;
            /* Larger icon for empty state */
        }

        .empty-state-card .service-title {
            color: var(--primary);
            font-size: 1.8rem;
            margin-bottom: 0.75rem;
        }

        .empty-state-card p {
            color: var(--text-muted);
            font-size: 1rem;
            margin-bottom: 2rem;
        }


        /* --- Mobile Responsiveness for Favorites Page --- */
        @media (max-width: 767.98px) {
            .container-fluid {
                padding: 0;
                margin: 0;
            }

            .favorite-product-card {
                margin-bottom: 1.5rem;
                /* Space between stacked cards */
            }

            .favorite-product-img {
                height: 160px;
                /* Slightly smaller images on mobile */
            }

            .favorite-product-body {
                padding: 1rem;
            }

            .favorite-product-title {
                font-size: 1.3rem;
            }

            .favorite-product-text {
                font-size: 0.85rem;
            }

            .favorite-product-price {
                font-size: 1.2rem;
                margin-bottom: 0.8rem;
            }

            .btn-booking,
            .btn-remove-favorite {
                padding: 0.6rem 1.2rem;
                /* Adjusted button padding */
                font-size: 0.85rem;
                width: 100%;
                /* Make buttons full width on mobile */
                margin-top: 0.5rem;
                /* Space between stacked buttons */
            }

            /* If you have two buttons side-by-side on mobile, ensure they stack or split well */
            .favorite-actions-row {
                flex-direction: column;
                /* Stack buttons vertically */
                align-items: stretch;
                /* Stretch buttons to full width */
            }

            .favorite-actions-row .btn {
                margin-bottom: 0.5rem;
                /* Space between stacked buttons */
            }

            .favorite-actions-row .btn:last-child {
                margin-bottom: 0;
            }

            .empty-state-card {
                padding: 2rem 1rem;
            }

            .empty-state-card i {
                font-size: 3rem;
            }

            .empty-state-card .service-title {
                font-size: 1.5rem;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {

            /* Tablet specific adjustments for cards */
            .favorite-product-card {
                /* Already handled by row-cols-md-2, but adjust padding if needed */
                padding: 1.2rem;
            }

            .favorite-product-img {
                height: 180px;
            }

            .favorite-product-title {
                font-size: 1.4rem;
            }

            .favorite-product-text {
                font-size: 0.9rem;
            }

            .favorite-product-price {
                font-size: 1.3rem;
            }

            .btn-booking,
            .btn-remove-favorite {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }
    </style>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="dashboard-section-title mb-0"
                style="font-size: 1.6rem; font-weight: 600; color: var(--primary); letter-spacing: 0.5px; text-shadow: 0 0 12px rgba(225, 187, 135, 0.3); text-transform: uppercase;">
                <i class="fas fa-heart me-2"></i> My Favorites
            </h2>
            {{-- Optional: Button to browse all services to add more favorites --}}
            {{-- <a href="{{ url('/prestations') }}" class="btn btn-booking"
                style="background: var(--primary); color: var(--dark) !important; border: none; border-radius: 50px; padding: 0.6rem 1.8rem; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease; text-transform: uppercase;">
                <i class="fas fa-plus me-1"></i> Add More
            </a> --}}
        </div>

        {{-- Check if there are favorite products --}}
        @php
            $hasFavorites = true; // Set to false to test empty state
        @endphp

        @if ($hasFavorites)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
                {{-- Example Favorite Product Card 1 --}}
                <div class="col">
                    <div class="favorite-product-card">
                        <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=80"
                            class="favorite-product-img" alt="Hair Service">
                        <div class="favorite-product-body">
                            <div>
                                <h5 class="favorite-product-title">Premium Haircut</h5>
                                <p class="favorite-product-text">Our signature haircut with expert styling and a refreshing
                                    finish.</p>
                            </div>
                            <span class="favorite-product-price">$45</span>
                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 favorite-actions-row">
                                <button class="btn btn-booking flex-fill"
                                    style="background: var(--primary); color: var(--dark) !important;">Book Now</button>
                                <button class="btn btn-remove-favorite flex-fill">
                                    <i class="fas fa-trash-can me-1"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Example Favorite Product Card 2 --}}
                <div class="col">
                    <div class="favorite-product-card">
                        <img src="https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?auto=format&fit=crop&w=800&q=80"
                            class="favorite-product-img" alt="Facial Service">
                        <div class="favorite-product-body">
                            <div>
                                <h5 class="favorite-product-title">Luxury Facial</h5>
                                <p class="favorite-product-text">A revitalizing facial using organic products tailored for
                                    your skin.</p>
                            </div>
                            <span class="favorite-product-price">$75</span>
                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 favorite-actions-row">
                                <button class="btn btn-booking flex-fill"
                                    style="background: var(--primary); color: var(--dark) !important;">Book Now</button>
                                <button class="btn btn-remove-favorite flex-fill">
                                    <i class="fas fa-trash-can me-1"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Example Favorite Product Card 3 --}}
                <div class="col">
                    <div class="favorite-product-card">
                        <img src="https://images.unsplash.com/photo-1519409540099-ea542456070a?auto=format&fit=crop&w=800&q=80"
                            class="favorite-product-img" alt="Nail Service">
                        <div class="favorite-product-body">
                            <div>
                                <h5 class="favorite-product-title">Deluxe Manicure</h5>
                                <p class="favorite-product-text">Pamper your hands with our deluxe manicure, including
                                    exfoliation and massage.</p>
                            </div>
                            <span class="favorite-product-price">$30</span>
                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 favorite-actions-row">
                                <button class="btn btn-booking flex-fill"
                                    style="background: var(--primary); color: var(--dark) !important;">Book Now</button>
                                <button class="btn btn-remove-favorite flex-fill">
                                    <i class="fas fa-trash-can me-1"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5 empty-state-card">
                <i class="far fa-heart fa-3x mb-3"></i>
                <h4 class="service-title">No Favorites Yet</h4>
                <p class="mb-4">It looks like you haven't added any services to your favorites. Start exploring our
                    offerings!</p>
                <a href="{{ url('/prestations') }}" class="btn btn-booking">
                    <i class="fas fa-spa me-1"></i> Browse Services
                </a>
            </div>
        @endif
    </div>
@endsection
