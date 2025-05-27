@extends('layouts.app')
@section('content')
    <!-- Main Content Area -->
    <div class="col-md-9">
        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-6 col-md-3 mb-3">
                <div class="card-service text-center p-3">
                    <h5 class="service-title">3</h5>
                    <p class="mb-0">Upcoming</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div class="card-service text-center p-3">
                    <h5 class="service-title">12</h5>
                    <p class="mb-0">Completed</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div class="card-service text-center p-3">
                    <h5 class="service-title">2</h5>
                    <p class="mb-0">Favorites</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div class="card-service text-center p-3">
                    <h5 class="service-title">1</h5>
                    <p class="mb-0">Cancelled</p>
                </div>
            </div>
        </div>

        <!-- Recommended Services -->
        <h4 class="service-title mb-3"><i class="fas fa-spa me-2"></i> Recommended For You</h4>
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card card-service">
                    <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9" class="card-img-top service-img"
                        alt="Hair Service">
                    <div class="card-body">
                        <h5 class="service-title">Premium Haircut</h5>
                        <p class="card-text">Our signature haircut with styling and finishing</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">$45</span>
                            <button class="btn btn-booking">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card card-service">
                    <img src="https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1" class="card-img-top service-img"
                        alt="Facial Service">
                    <div class="card-body">
                        <h5 class="service-title">Luxury Facial</h5>
                        <p class="card-text">Deep cleansing facial with organic products</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">$75</span>
                            <button class="btn btn-booking">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Appointments -->
        <h4 class="service-title mb-3"><i class="fas fa-history me-2"></i> Recent Appointments</h4>


        {{-- Appointment Card 2 --}}
        <div class="order-card">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                {{-- Appointment Details --}}
                <div class="mb-3 mb-md-0">
                    <h5 class="service-title">Luxury Facial</h5>
                    <p class="mb-1 text-light-emphasis small"><i class="far fa-calendar me-2"></i>June 15, 2023 at
                        11:00 AM</p>
                    <p class="mb-0 text-light-emphasis small"><i class="fas fa-user me-2"></i>Therapist: Maria
                        Garcia</p>
                </div>

                {{-- Status and Actions --}}
                <div class="text-start text-md-end">
                    <span class="order-status status-pending mb-2 d-inline-block">Pending</span>
                    <div class="d-flex justify-content-start justify-content-md-end gap-2">
                        <button class="action-btn" title="Cancel"><i class="fas fa-times"></i> Cancel</button>
                        <button class="action-btn" title="Reschedule"><i class="fas fs-3 fa-calendar-alt"></i>
                            Reschedule</button>
                        <button class="action-btn" title="View"><i class="fas fa-eye"></i> View</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
