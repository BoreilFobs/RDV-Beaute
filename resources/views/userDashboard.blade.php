@extends('layouts.app') {{-- Make sure this extends your base layout file --}}

@section('content')
    <div class="container-fluid" style="padding: 0;margin: 0;">
        <h2 class="dashboard-section-title mb-5"
            style="font-size: 2rem; font-weight: 700; color: var(--primary); letter-spacing: 1px; text-shadow: 0 0 8px rgba(225, 187, 135, 0.5);">
            <i class="fas fa-grip-horizontal me-3"></i> Your Dashboard
        </h2>

        <div class="row row-cols-2 row-cols-md-4 g-4 mb-5">
            <div class="col">
                <div class="card-service text-center p-3"
                    style="border-radius: 1rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); transition: all 0.3s ease; border: 1px solid rgba(255, 255, 255, 0.08);">
                    <h5 class="service-title"
                        style="font-size: 2.8rem; font-weight: 700; color: var(--primary); line-height: 1; margin-bottom: 0.5rem; text-shadow: 0 0 8px rgba(225, 187, 135, 0.5);">
                        3</h5>
                    <p class="mb-0"
                        style="font-size: 1rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;">
                        Upcoming</p>
                </div>
            </div>
            <div class="col">
                <div class="card-service text-center p-3"
                    style="border-radius: 1rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); transition: all 0.3s ease; border: 1px solid rgba(255, 255, 255, 0.08);">
                    <h5 class="service-title"
                        style="font-size: 2.8rem; font-weight: 700; color: var(--primary); line-height: 1; margin-bottom: 0.5rem; text-shadow: 0 0 8px rgba(225, 187, 135, 0.5);">
                        12</h5>
                    <p class="mb-0"
                        style="font-size: 1rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;">
                        Completed</p>
                </div>
            </div>
            <div class="col">
                <div class="card-service text-center p-3"
                    style="border-radius: 1rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); transition: all 0.3s ease; border: 1px solid rgba(255, 255, 255, 0.08);">
                    <h5 class="service-title"
                        style="font-size: 2.8rem; font-weight: 700; color: var(--primary); line-height: 1; margin-bottom: 0.5rem; text-shadow: 0 0 8px rgba(225, 187, 135, 0.5);">
                        2</h5>
                    <p class="mb-0"
                        style="font-size: 1rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;">
                        Favorites</p>
                </div>
            </div>
            <div class="col">
                <div class="card-service text-center p-3"
                    style="border-radius: 1rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); transition: all 0.3s ease; border: 1px solid rgba(255, 255, 255, 0.08);">
                    <h5 class="service-title"
                        style="font-size: 2.8rem; font-weight: 700; color: var(--primary); line-height: 1; margin-bottom: 0.5rem; text-shadow: 0 0 8px rgba(225, 187, 135, 0.5);">
                        1</h5>
                    <p class="mb-0"
                        style="font-size: 1rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;">
                        Cancelled</p>
                </div>
            </div>
        </div>

        <h4 class="service-title mb-4" style="color: var(--primary); font-size: 1.75rem;"><i class="fas fa-star me-2"></i>
            Recommended For You</h4>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
            <div class="col">
                <div class="card card-service"
                    style="border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); height: 100%; display: flex; flex-direction: column; border: 1px solid rgba(255, 255, 255, 0.08);">
                    <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=80"
                        class="card-img-top service-img" alt="Hair Service"
                        style="height: 180px; object-fit: cover; width: 100%; border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
                    <div class="card-body"
                        style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                        <div>
                            <h5 class="service-title"
                                style="color: var(--primary); font-size: 1.5rem; margin-bottom: 0.5rem; font-weight: 600;">
                                Precision Haircut</h5>
                            <p class="card-text"
                                style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.5; margin-bottom: 1rem; flex-grow: 1;">
                                Our signature haircut with expert styling and a refreshing finish.</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="h5 mb-0" style="font-size: 1.4rem; font-weight: 700; color: var(--accent);">
                                $45
                            </span>
                            <button class="btn btn-booking"
                                style="background: var(--primary); color: var(--dark) !important; border: none; border-radius: 50px; padding: 0.6rem 1.8rem; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease;">Book
                                Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-service"
                    style="border-radius: 1rem; overflow: hidden; box-shadow: 0 44px 15px rgba(0, 0, 0, 0.4); height: 100%; display: flex; flex-direction: column; border: 1px solid rgba(255, 255, 255, 0.08);">
                    <img src="https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?auto=format&fit=crop&w=800&q=80"
                        class="card-img-top service-img" alt="Facial Service"
                        style="height: 180px; object-fit: cover; width: 100%; border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
                    <div class="card-body"
                        style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                        <div>
                            <h5 class="service-title"
                                style="color: var(--primary); font-size: 1.5rem; margin-bottom: 0.5rem; font-weight: 600;">
                                Luxury Facial</h5>
                            <p class="card-text"
                                style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.5; margin-bottom: 1rem; flex-grow: 1;">
                                A revitalizing facial using organic products tailored for your skin.</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="h5 mb-0" style="font-size: 1.4rem; font-weight: 700; color: var(--accent);">
                                $75
                            </span>
                            <button class="btn btn-booking"
                                style="background: var(--primary); color: var(--dark) !important; border: none; border-radius: 50px; padding: 0.6rem 1.8rem; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease;">Book
                                Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-service"
                    style="border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); height: 100%; display: flex; flex-direction: column; border: 1px solid rgba(255, 255, 255, 0.08);">
                    <img src="https://images.unsplash.com/photo-1519409540099-ea542456070a?auto=format&fit=crop&w=800&q=80"
                        class="card-img-top service-img" alt="Nail Service"
                        style="height: 180px; object-fit: cover; width: 100%; border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
                    <div class="card-body"
                        style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                        <div>
                            <h5 class="service-title"
                                style="color: var(--primary); font-size: 1.5rem; margin-bottom: 0.5rem; font-weight: 600;">
                                Deluxe Manicure</h5>
                            <p class="card-text"
                                style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.5; margin-bottom: 1rem; flex-grow: 1;">
                                Pamper your hands with our deluxe manicure, including exfoliation and massage.</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="h5 mb-0" style="font-size: 1.4rem; font-weight: 700; color: var(--accent);">
                                $30
                            </span>
                            <button class="btn btn-booking"
                                style="background: var(--primary); color: var(--dark) !important; border: none; border-radius: 50px; padding: 0.6rem 1.8rem; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease;">Book
                                Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="service-title mb-4" style="color: var(--primary); font-size: 1.75rem;"><i
                class="fas fa-clock-rotate-left me-2"></i> Recent Appointments</h4>

        <div class="order-card mb-4"
            style="background-color: var(--gray); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <h5 class="service-title" style="color: var(--primary); font-size: 1.35rem;">Luxury Facial</h5>
                    <p class="mb-1 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;"><i class="far fa-calendar me-2"
                            style="color: var(--primary); font-size: 1.1em;"></i> June 15, 2025 at 11:00 AM</p>
                    <p class="mb-0 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;"><i class="fas fa-user me-2"
                            style="color: var(--primary); font-size: 1.1em;"></i> Therapist: Maria Garcia</p>
                </div>
                <div class="text-start text-md-end">
                    <span class="order-status mb-3 d-inline-block"
                        style="padding: 0.4rem 1rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; background-color: rgba(255, 187, 0, 0.15); color: #ffbb00;">Pending</span>
                    <div class="d-flex flex-wrap justify-content-start justify-content-md-end gap-2">
                        <button class="action-btn" title="Cancel"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-times"></i> Cancel</button>
                        <button class="action-btn" title="Reschedule"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-calendar-days"></i> Reschedule</button>
                        <button class="action-btn" title="View Details"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-eye"></i> View</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="order-card mb-4"
            style="background-color: var(--gray); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <h5 class="service-title" style="color: var(--primary); font-size: 1.35rem;">Premium Haircut</h5>
                    <p class="mb-1 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;"><i class="far fa-calendar me-2"
                            style="color: var(--primary); font-size: 1.1em;"></i> May 28, 2025 at 03:00 PM</p>
                    <p class="mb-0 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;"><i class="fas fa-user me-2"
                            style="color: var(--primary); font-size: 1.1em;"></i> Stylist: John Doe</p>
                </div>
                <div class="text-start text-md-end">
                    <span class="order-status mb-3 d-inline-block"
                        style="padding: 0.4rem 1rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; background-color: rgba(0, 255, 0, 0.15); color: #00ff00;">Completed</span>
                    <div class="d-flex flex-wrap justify-content-start justify-content-md-end gap-2">
                        <button class="action-btn" title="Rate Service"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-star-half-stroke"></i> Rate</button>
                        <button class="action-btn" title="Book Again"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-repeat"></i> Rebook</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="order-card mb-4"
            style="background-color: var(--gray); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <h5 class="service-title" style="color: var(--primary); font-size: 1.35rem;">Deep Tissue Massage</h5>
                    <p class="mb-1 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;"><i class="far fa-calendar me-2"
                            style="color: var(--primary); font-size: 1.1em;"></i> May 20, 2025 at 10:00 AM</p>
                    <p class="mb-0 text-light-emphasis small"
                        style="font-size: 0.95rem; color: var(--text-muted) !important;"><i class="fas fa-user me-2"
                            style="color: var(--primary); font-size: 1.1em;"></i> Therapist: Emily White</p>
                </div>
                <div class="text-start text-md-end">
                    <span class="order-status mb-3 d-inline-block"
                        style="padding: 0.4rem 1rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; background-color: rgba(255, 0, 0, 0.15); color: #ff0000;">Cancelled</span>
                    <div class="d-flex flex-wrap justify-content-start justify-content-md-end gap-2">
                        <button class="action-btn" title="View Details"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-eye"></i> View</button>
                        <button class="action-btn" title="Contact Support"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-headset"></i> Support</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5 pt-4">
            <h3 class="text-light mb-4">Ready for your next pampering session?</h3>
            <a href="{{ url('/prestations') }}" class="btn btn-booking btn-lg"
                style="background: var(--primary); color: var(--dark) !important; border: none; border-radius: 50px; padding: 0.8rem 2.5rem; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease;">
                <i class="fas fa-scissors me-2"></i> Explore All Services
            </a>
        </div>
    </div>
@endsection
