@extends('layouts.app')
@section('content')
    <div class="col-md-9">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="service-title mb-0">
                <i class="fas fa-calendar-alt me-2"></i>My Appointments
            </h2>
            {{-- <a href="{{ route('appointments.create') }}" class="btn btn-booking">
                <i class="fas fa-plus me-1"></i> New Booking
            </a> --}}
        </div>

        <!-- Filter Controls -->
        <div class="dashboard-nav p-3 mb-4">
            <div class="d-flex flex-wrap align-items-center">
                <span class="me-3">Filter:</span>
                <div class="btn-group btn-group-sm" role="group">
                    <input type="radio" class="btn-check" name="filter" id="filter-all" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="filter-all">All</label>
                    <input type="radio" class="btn-check" name="filter" id="filter-upcoming" autocomplete="off">
                    <label class="btn btn-outline-primary" for="filter-upcoming">Upcoming</label>
                    <input type="radio" class="btn-check" name="filter" id="filter-completed" autocomplete="off">
                    <label class="btn btn-outline-primary" for="filter-completed">Completed</label>
                    <input type="radio" class="btn-check" name="filter" id="filter-cancelled" autocomplete="off">
                    <label class="btn btn-outline-primary" for="filter-cancelled">Cancelled</label>
                </div>
            </div>
        </div>

        <!-- Appointments List -->
        <div class="appointments-list">
            <!-- Upcoming Appointment -->
            <div class="order-card mb-3">
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="mb-3 mb-md-0">
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="service-title mb-0">Premium Haircut & Styling</h5>
                            <span class="order-status status-confirmed ms-3">Confirmed</span>
                        </div>
                        <p class="mb-1"><i class="far fa-calendar me-2"></i>Today, June 25, 2023 at 2:00 PM</p>
                        <p class="mb-1"><i class="fas fa-user me-2"></i>Stylist: Sarah Johnson</p>
                        <p class="mb-1"><i class="fas fa-dollar-sign me-2"></i>$65.00</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="action-btn me-2" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Appointment -->
        <div class="order-card mb-3">
            <div class="d-flex flex-column flex-md-row justify-content-between">
                <div class="mb-3 mb-md-0">
                    <div class="d-flex align-items-center mb-2">
                        <h5 class="service-title mb-0">Luxury Facial Treatment</h5>
                        <span class="order-status status-completed ms-3">Completed</span>
                    </div>
                    <p class="mb-1"><i class="far fa-calendar me-2"></i>June 15, 2023 at 11:00 AM</p>
                    <p class="mb-1"><i class="fas fa-user me-2"></i>Therapist: Maria Garcia</p>
                    <p class="mb-1"><i class="fas fa-dollar-sign me-2"></i>$85.00</p>
                </div>
                <div class="d-flex align-items-center">
                    <button class="action-btn me-2" title="View">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="action-btn" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Empty State (commented out) -->
        <!-- <div class="text-center py-5">
                                            <i class="far fa-calendar-check fa-3x mb-3 text-primary"></i>
                                            <h4 class="service-title">No Appointments Yet</h4>
                                            <p class="mb-4">You haven't booked any services yet.</p>
                                            <a href="#" class="btn btn-booking">
                                                <i class="fas fa-spa me-1"></i> Browse Services
                                            </a>
                                        </div> -->
    </div>

    <style>
        .order-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-confirmed {
            background: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }

        .status-completed {
            background: rgba(13, 110, 253, 0.2);
            color: #0d6efd;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }

        .status-cancelled {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover,
        .btn-check:checked+.btn-outline-primary {
            background-color: var(--primary);
            color: var(--dark);
        }
    </style>
@endsection
