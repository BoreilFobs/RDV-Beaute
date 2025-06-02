@extends('layouts.navigation')

@section('content')
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
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
        }

        /* Modern Card Styles */
        .service-card {
            background: linear-gradient(145deg, #252525, #1a1a1a);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.36);
            height: 100%;
            display: flex;
            flex-direction: column;
            margin-bottom: 30px;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
            border-color: rgba(225, 187, 135, 0.2);
        }

        .service-image-container {
            height: 220px;
            position: relative;
            overflow: hidden;
        }

        .service-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .service-card:hover .service-image {
            transform: scale(1.05);
        }

        .service-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0, 0, 0, 0.7);
            color: var(--primary);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .service-content {
            padding: 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .service-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: white;
            margin-bottom: 12px;
            font-size: 1.25rem;
        }

        .service-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .service-meta-item {
            display: flex;
            align-items: center;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .service-meta-item i {
            margin-right: 6px;
            color: var(--accent);
        }

        .service-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 16px;
        }

        .service-description {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 24px;
            flex-grow: 1;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-primary-accent {
            background-color: var(--primary);
            color: var(--dark);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px;
            transition: all 0.3s;
        }

        .btn-primary-accent:hover {
            background-color: #d4a76a;
            transform: translateY(-2px);
        }

        .btn-outline-accent {
            background-color: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 8px;
            font-weight: 600;
            padding: 10px;
            transition: all 0.3s;
        }

        .btn-outline-accent:hover {
            background-color: rgba(225, 187, 135, 0.1);
            transform: translateY(-2px);
        }

        /* Section Header */
        .section-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .section-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2.2rem;
            color: white;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--primary);
        }

        .section-subtitle {
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto;
        }

        /* Filter Controls */
        .filter-controls {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-btn {
            background: rgba(255, 255, 255, 0.05);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary);
            color: var(--dark);
        }

        /* Modern Layout Spacing */
        .service-section {
            padding: 80px 0;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.8rem;
            }

            .service-card {
                max-width: 400px;
                margin: 0 auto;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Add Poppins font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="service-section">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header">
                <h1 class="section-title">Premium Hair Services</h1>
                <p class="section-subtitle">Experience luxury hair treatments with our expert stylists using top-quality
                    products</p>
            </div>

            <!-- Filter Controls -->
            <div class="filter-controls">
                <button class="filter-btn active">All Services</button>
                <button class="filter-btn">Cutting</button>
                <button class="filter-btn">Coloring</button>
                <button class="filter-btn">Treatments</button>
                <button class="filter-btn">Styling</button>
            </div>

            <!-- Services Grid -->
            <div class="row g-4">
                <!-- Service 1 -->
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="service-card">
                        <div class="service-image-container">
                            <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9" class="service-image"
                                alt="Premium Haircut">
                            <span class="service-badge">Most Popular</span>
                        </div>
                        <div class="service-content">
                            <h3 class="service-title">Signature Haircut</h3>
                            <div class="service-meta">
                                <span class="service-meta-item"><i class="fas fa-clock"></i> 45 min</span>
                                <span class="service-meta-item"><i class="fas fa-user-tie"></i> Expert</span>
                            </div>
                            <div class="service-price">$45+</div>
                            <p class="service-description">Our master stylists will give you a precision haircut tailored to
                                your face shape and lifestyle.</p>
                            <div class="action-buttons">
                                <a href={{ url('/reservation') }} class="btn btn-primary-accent">
                                    <i class="fas fa-calendar-plus me-2"></i> Book Now
                                </a>
                                <button class="btn btn-outline-accent">
                                    <i class="far fa-heart me-2"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="service-card">
                        <div class="service-image-container">
                            <img src="https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1" class="service-image"
                                alt="Hair Coloring">
                            <span class="service-badge">New</span>
                        </div>
                        <div class="service-content">
                            <h3 class="service-title">Vibrant Color</h3>
                            <div class="service-meta">
                                <span class="service-meta-item"><i class="fas fa-clock"></i> 2 hrs</span>
                                <span class="service-meta-item"><i class="fas fa-user-tie"></i> Senior</span>
                            </div>
                            <div class="service-price">$85+</div>
                            <p class="service-description">Transform your look with our ammonia-free coloring that leaves
                                hair shiny and healthy.</p>
                            <div class="action-buttons">
                                <button class="btn btn-primary-accent">
                                    <i class="fas fa-calendar-plus me-2"></i> Book Now
                                </button>
                                <button class="btn btn-outline-accent">
                                    <i class="far fa-heart me-2"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="service-card">
                        <div class="service-image-container">
                            <img src="https://images.unsplash.com/photo-1549465220-1a92b217e716" class="service-image"
                                alt="Keratin Treatment">
                        </div>
                        <div class="service-content">
                            <h3 class="service-title">Keratin Smoothing</h3>
                            <div class="service-meta">
                                <span class="service-meta-item"><i class="fas fa-clock"></i> 3 hrs</span>
                                <span class="service-meta-item"><i class="fas fa-user-tie"></i> Master</span>
                            </div>
                            <div class="service-price">$120+</div>
                            <p class="service-description">Our advanced keratin treatment eliminates frizz and reduces
                                styling time by up to 70%.</p>
                            <div class="action-buttons">
                                <button class="btn btn-primary-accent">
                                    <i class="fas fa-calendar-plus me-2"></i> Book Now
                                </button>
                                <button class="btn btn-outline-accent">
                                    <i class="far fa-heart me-2"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="service-card">
                        <div class="service-image-container">
                            <img src="https://images.unsplash.com/photo-1546743126-78b17849e4fe" class="service-image"
                                alt="Braids & Extensions">
                            <span class="service-badge">Popular</span>
                        </div>
                        <div class="service-content">
                            <h3 class="service-title">Designer Braids</h3>
                            <div class="service-meta">
                                <span class="service-meta-item"><i class="fas fa-clock"></i> 4 hrs</span>
                                <span class="service-meta-item"><i class="fas fa-user-tie"></i> Expert</span>
                            </div>
                            <div class="service-price">$150+</div>
                            <p class="service-description">Custom braiding with premium extensions that protect your natural
                                hair while making a statement.</p>
                            <div class="action-buttons">
                                <button class="btn btn-primary-accent">
                                    <i class="fas fa-calendar-plus me-2"></i> Book Now
                                </button>
                                <button class="btn btn-outline-accent">
                                    <i class="far fa-heart me-2"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add active class to filter buttons
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
@endsection
