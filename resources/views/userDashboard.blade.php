@extends('layouts.app') {{-- Make sure this extends your base layout file --}}

@section('content')
<style>
    
    @media (max-width: 767.98px) {
            .action-btn {
                flex: 0 0 auto;
                max-width: none;
                min-width: 70px;
                padding: 0.7rem 0.5rem !important;
                font-size: 0.95rem !important;
                justify-content: center;
                width: auto;
            }

            .action-btn .action-text {
                display: none !important;
            }

            .d-flex.flex-wrap.justify-content-start.justify-content-md-end.gap-2 {
                gap: 0.5rem !important;
            }
            .dashboard-cta-title {
                font-size: 1.1rem !important;
            }
            .dashboard-cta-btn {
                font-size: 0.95rem !important;
                padding: 0.7rem 1.2rem !important;
            }
            .card-service .service-title {
                    font-size: 1.3rem !important;
                }
                .card-service .rounded-circle {
                    width: 36px !important;
                    height: 36px !important;
                }
                .card-service .small {
                    font-size: 0.85rem !important;
                }
                .card-service.p-3.py-4 {
                    padding: 1rem !important;
                    padding-top: 1.2rem !important;
                    padding-bottom: 1.2rem !important;
                }
        }
</style>
    <div class="container-fluid" style="padding:0 ;margin: 0;">
        <h2 class="dashboard-section-title mb-5"
            style="font-size: 2rem; font-weight: 700; color: var(--primary); letter-spacing: 1px; text-shadow: 0 0 8px rgba(225, 187, 135, 0.5);">
            <i class="fas fa-grip-horizontal me-3"></i> Your Dashboard
        </h2>

        <div class="row row-cols-2 row-cols-md-4 g-3 mb-0">
            <div class="col">
                <div class="card-service text-center p-3 py-4"
                    style="border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.18); border: none; background: linear-gradient(135deg, var(--primary) 60%, #fffbe6 100%); transition: transform 0.2s;">
                    <div class="d-flex flex-column align-items-center">
                        <span class="rounded-circle mb-2 d-flex align-items-center justify-content-center"
                            style="background: rgba(255,255,255,0.7); width: 48px; height: 48px;">
                            <i class="fas fa-calendar-alt" style="color: var(--primary); font-size: 1.5rem;"></i>
                        </span>
                        <h5 class="service-title mb-1"
                            style="font-size: 2.1rem; font-weight: 700; color: var(--primary); text-shadow: 0 0 6px #e1bb87a0;">
                            3
                        </h5>
                        <span class="small text-uppercase fw-semibold" style="color: #6c757d; letter-spacing: 0.5px;">
                            Upcoming
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-service text-center p-3 py-4"
                    style="border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.18); border: none; background: linear-gradient(135deg, #e1bb87 60%, #fffbe6 100%); transition: transform 0.2s;">
                    <div class="d-flex flex-column align-items-center">
                        <span class="rounded-circle mb-2 d-flex align-items-center justify-content-center"
                            style="background: rgba(255,255,255,0.7); width: 48px; height: 48px;">
                            <i class="fas fa-check-circle" style="color: #e1bb87; font-size: 1.5rem;"></i>
                        </span>
                        <h5 class="service-title mb-1"
                            style="font-size: 2.1rem; font-weight: 700; color: #e1bb87; text-shadow: 0 0 6px #e1bb87a0;">
                            12
                        </h5>
                        <span class="small text-uppercase fw-semibold" style="color: #6c757d; letter-spacing: 0.5px;">
                            Completed
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-service text-center p-3 py-4"
                    style="border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.18); border: none; background: linear-gradient(135deg, #f7c8e0 60%, #fffbe6 100%); transition: transform 0.2s;">
                    <div class="d-flex flex-column align-items-center">
                        <span class="rounded-circle mb-2 d-flex align-items-center justify-content-center"
                            style="background: rgba(255,255,255,0.7); width: 48px; height: 48px;">
                            <i class="fas fa-heart" style="color: #f06292; font-size: 1.5rem;"></i>
                        </span>
                        <h5 class="service-title mb-1"
                            style="font-size: 2.1rem; font-weight: 700; color: #f06292; text-shadow: 0 0 6px #e1bb87a0;">
                            2
                        </h5>
                        <span class="small text-uppercase fw-semibold" style="color: #6c757d; letter-spacing: 0.5px;">
                            Favorites
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-service text-center p-3 py-4"
                    style="border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.18); border: none; background: linear-gradient(135deg, #f8d7da 60%, #fffbe6 100%); transition: transform 0.2s;">
                    <div class="d-flex flex-column align-items-center">
                        <span class="rounded-circle mb-2 d-flex align-items-center justify-content-center"
                            style="background: rgba(255,255,255,0.7); width: 48px; height: 48px;">
                            <i class="fas fa-times-circle" style="color: #dc3545; font-size: 1.5rem;"></i>
                        </span>
                        <h5 class="service-title mb-1"
                            style="font-size: 2.1rem; font-weight: 700; color: #dc3545; text-shadow: 0 0 6px #e1bb87a0;">
                            1
                        </h5>
                        <span class="small text-uppercase fw-semibold" style="color: #6c757d; letter-spacing: 0.5px;">
                            Cancelled
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-2 mb-5 pt-4">
            <h3 class="text-light mb-4 dashboard-cta-title">Ready for your next pampering session?</h3>
            <a href="{{ url('/prestations') }}" class="btn btn-booking btn-lg dashboard-cta-btn"
            style="background: var(--primary); color: var(--dark) !important; border: none; border-radius: 50px; padding: 0.8rem 2.5rem; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease;">
            <i class="fas fa-scissors me-2"></i> Explore All Services
            </a>
        </div>

        {{-- <h4 class="service-title mb-4" style="color: var(--primary); font-size: 1.75rem;">
            <i class="fas fa-clock-rotate-left me-2"></i> Recent Appointments
        </h4> --}}

        <!-- Recent Appointments Cards (copied from appointments/index.blade.php) -->
        {{-- <div class="order-card mb-4"
            style="background-color: var(--gray); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <h5 class="service-title" style="color: var(--primary); font-size: 1.35rem;">Luxury Facial</h5>
                    <p class="mb-1 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;">
                        <i class="far fa-calendar me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                        June 15, 2025 at 11:00 AM
                    </p>
                    <p class="mb-0 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;">
                        <i class="fas fa-user me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                        Therapist: Maria Garcia
                    </p>
                </div>
                <div class="text-start text-md-end">
                    <span class="order-status mb-3 d-inline-block"
                        style="padding: 0.4rem 1rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; background-color: rgba(255, 187, 0, 0.15); color: #ffbb00;">
                        Pending
                    </span>
                    <div class="d-flex flex-wrap justify-content-between justify-content-md-end gap-2">
                        <button class="action-btn" title="Cancel">
                            <i class="fas fa-times"></i>
                            <span class="action-text d-none d-md-inline">Cancel</span>
                        </button>
                        <button class="action-btn" title="Reschedule">
                            <i class="fas fa-calendar-days"></i>
                            <span class="action-text d-none d-md-inline">Reschedule</span>
                        </button>
                        <button class="action-btn" title="View Details">
                            <i class="fas fa-eye"></i>
                            <span class="action-text d-none d-md-inline">View</span>
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="order-card mb-4"
            style="background-color: var(--gray); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <h5 class="service-title" style="color: var(--primary); font-size: 1.35rem;">Premium Haircut</h5>
                    <p class="mb-1 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;">
                        <i class="far fa-calendar me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                        May 28, 2025 at 03:00 PM
                    </p>
                    <p class="mb-0 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;">
                        <i class="fas fa-user me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                        Stylist: John Doe
                    </p>
                </div>
                <div class="text-start text-md-end">
                    <span class="order-status mb-3 d-inline-block"
                        style="padding: 0.4rem 1rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; background-color: rgba(0, 255, 0, 0.15); color: #00ff00;">
                        Completed
                    </span>
                    <div class="d-flex flex-wrap justify-content-start justify-content-md-end gap-2">
                        <button class="action-btn" title="Rate Service">
                            <i class="fas fa-star-half-stroke"></i>
                            <span class="action-text d-none d-md-inline">Rate</span>
                        </button>
                        <button class="action-btn" title="Book Again">
                            <i class="fas fa-repeat"></i>
                            <span class="action-text d-none d-md-inline">Rebook</span>
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="order-card mb-4"
            style="background-color: var(--gray); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <h5 class="service-title" style="color: var(--primary); font-size: 1.35rem;">Deep Tissue Massage</h5>
                    <p class="mb-1 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;">
                        <i class="far fa-calendar me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                        May 20, 2025 at 10:00 AM
                    </p>
                    <p class="mb-0 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;">
                        <i class="fas fa-user me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                        Therapist: Emily White
                    </p>
                </div>
                <div class="text-start text-md-end">
                    <span class="order-status mb-3 d-inline-block"
                        style="padding: 0.4rem 1rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; background-color: rgba(255, 0, 0, 0.15); color: #ff0000;">
                        Cancelled
                    </span>
                    <div class="d-flex flex-wrap justify-content-start justify-content-md-end gap-2">
                        <button class="action-btn" title="View Details">
                            <i class="fas fa-eye"></i>
                            <span class="action-text d-none d-md-inline">View</span>
                        </button>
                        <button class="action-btn" title="Contact Support">
                            <i class="fas fa-headset"></i>
                            <span class="action-text d-none d-md-inline">Support</span>
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}

        
    </div>
@endsection
