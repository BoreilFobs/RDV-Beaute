@extends('layouts.app')

@section('content')
    <style>
        /* filtre control */
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

        /* Add these styles to your existing base layout or custom.css */

        /* --- General Responsiveness for Dashboard/Appointments Pages --- */
        @media (max-width: 767.98px) {
            .dashboard-section-title {
                font-size: 1.75rem !important;
                /* Smaller title on mobile */
                text-align: center;
                /* Center align header on mobile */
                margin-bottom: 2rem !important;
            }

            /* Filter Controls on Mobile */
            .dashboard-nav>.d-flex {
                flex-direction: column;
                /* Stack filter label and buttons */
                align-items: center !important;
            }

            .dashboard-nav span.me-3.text-white-50 {
                display: none !important;
                /* Hide "Filter Appointments:" text on mobile */
            }

            .dashboard-nav .btn-group {
                width: 100%;
                /* Make button group full width */
                margin-top: 1rem;
            }

            .dashboard-nav .btn-group .btn {
                flex: 1 0 auto;
                /* Allow buttons to grow and take space */
                font-size: 0.85rem;
                /* Smaller font for filters */
                padding: 0.5rem 0.5rem;
            }

            /* Appointment Cards - Mobile Adjustments */
            .order-card {
                padding: 1rem !important;
                min-width: 85vw !important;

                /* Slightly less padding on mobile */
            }

            .container-fluid {
                margin: 0;
                padding: 0;
            }

            .order-card .d-flex.flex-column.flex-md-row {
                flex-direction: column !important;
                /* Always stack content on mobile */
                align-items: flex-start !important;
                /* Align details to start */
            }

            .order-card .service-title {
                font-size: 1.2rem !important;
                /* Adjust service title size */
                margin-bottom: 0.5rem !important;
            }

            .order-card p.mb-1,
            .order-card p.mb-0 {
                font-size: 0.85rem !important;
                /* Smaller text for details */
            }

            .order-card i {
                font-size: 1em !important;
                /* Ensure icons are proportionate */
            }

            /* Status Badge on Mobile */
            .order-card .order-status {
                font-size: 0.75rem !important;
                /* Smaller badge text */
                padding: 0.2rem 0.6rem !important;
                margin-top: 0.5rem;
                /* Add some space above badge */
                width: fit-content;
                /* Prevent badge from stretching too wide if it's the only element */
                flex-shrink: 0;
                /* Prevent badge from shrinking */
            }

            .order-card .d-flex.align-items-center.mb-2.flex-wrap {
                flex-direction: column;
                /* Stack title and badge if space is tight */
                align-items: flex-start !important;
                /* Align stacked items to start */
            }

            .order-card .service-title.mb-0.me-3 {
                margin-right: 0 !important;
                /* Remove right margin on title */
                margin-bottom: 0.5rem !important;
                /* Add bottom margin if stacked */
            }


            /* Action Buttons on Mobile */
            .order-card .d-flex.flex-wrap.justify-content-start.justify-content-md-end.gap-2 {
                width: 100%;
                /* Action buttons take full width */
                justify-content: center !important;
                /* Center align buttons */
                margin-top: 1rem;
                /* Space between details and buttons */
            }

            .action-btn {
                flex: 1 1 calc(50% - 0.5rem);
                /* Two buttons per row, with gap */
                max-width: calc(50% - 0.5rem);
                /* Ensure two buttons per row */
                padding: 0.7rem 0.5rem !important;
                /* More padding for easier tapping */
                font-size: 0.9rem !important;
                /* Slightly larger font */
                text-align: center;
                flex-direction: row;
                /* Keep icon and text inline */
                gap: 5px;
                /* Maintain small gap */
            }

            .action-btn i {
                margin-right: 5px;
                /* Small margin for icon */
            }
        }


        @media (min-width: 768px) and (max-width: 991.98px) {

            /* Tablet specific adjustments */
            .dashboard-section-title {
                font-size: 1.8rem !important;
            }

            .order-card .d-flex.flex-column.flex-md-row {
                flex-direction: row !important;
                /* Keep horizontal on tablet */
                align-items: center !important;
                /* Center align details */
            }

            .order-card .action-btn {
                padding: 0.6rem 0.8rem !important;
                /* Adjust padding for tablet */
                font-size: 0.85rem !important;
            }

            .order-card .order-status {
                font-size: 0.8rem !important;
                padding: 0.3rem 0.8rem !important;
            }

            .order-card .service-title {
                font-size: 1.25rem !important;
            }
        }

        /* Base styles for order-status and action-btn (ensure these are present and consistent) */
        .order-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .action-btn {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: var(--text-muted);
            /* Using a general text-muted for default */
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .action-btn:hover {
            border-color: var(--primary);
            /* Adjust hover effect to primary accent */
            color: var(--primary);
            background-color: rgba(225, 187, 135, 0.1);
        }

        /* Specific colors for action buttons (re-applying based on your example) */
        .action-btn[title="Cancel"],
        .action-btn[title="Delete"] {
            color: #ff6b6b;
            /* Red for destructive actions */
        }

        .action-btn[title="Cancel"]:hover,
        .action-btn[title="Delete"]:hover {
            color: #ff5252;
            background: rgba(255, 107, 107, 0.1);
            border-color: #ff5252;
        }

        .action-btn[title="Reschedule"] {
            color: var(--accent);
            /* Blue for rescheduling */
        }

        .action-btn[title="Reschedule"]:hover {
            color: #4ed1e3;
            background: rgba(107, 209, 227, 0.1);
            border-color: #4ed1e3;
        }

        .action-btn[title="Rate Service"],
        .action-btn[title="Rebook Service"] {
            color: var(--primary);
            /* Primary color for positive actions */
        }

        .action-btn[title="Rate Service"]:hover,
        .action-btn[title="Rebook Service"]:hover {
            color: var(--primary);
            background: rgba(225, 187, 135, 0.1);
            border-color: var(--primary);
        }
    </style>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="dashboard-section-title mb-0"
                style="font-size: 2rem; font-weight: 700; color: var(--primary); letter-spacing: 1px; text-shadow: 0 0 8px rgba(225, 187, 135, 0.5);">
                <i class="fas fa-calendar-alt me-3"></i> My Appointments
            </h2>
            {{-- Uncomment if you want the "New Booking" button --}}
            {{-- <a href="{{ route('appointments.create') }}" class="btn btn-booking" style="background: var(--primary); color: var(--dark) !important; border: none; border-radius: 50px; padding: 0.6rem 1.8rem; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease; text-transform: uppercase;">
                <i class="fas fa-plus me-1"></i> New Booking
            </a> --}}
        </div>

        <div class="filter-controls">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Comppleted</button>
            <button class="filter-btn">Pending</button>
            <button class="filter-btn">Canceled</button>
            {{-- <button class="filter-btn">Styling</button> --}}
        </div>

        <div class="appointments-list">
            <div class="order-card mb-3"
                style="background-color: var(--gray); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08); transition: all 0.3s ease;">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                    <div class="mb-3 mb-md-0">
                        <div class="d-flex align-items-center mb-2 flex-wrap">
                            <h5 class="service-title mb-0 me-3" style="color: var(--primary); font-size: 1.35rem;">Premium
                                Haircut & Styling</h5>
                            <span class="order-status"
                                style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 500; background: rgba(40, 167, 69, 0.2); color: #28a745;">Confirmed</span>
                        </div>
                        <p class="mb-1 text-light-emphasis small"
                            style="font-size: 0.95rem; color: var(--text-muted) !important;"><i class="far fa-calendar me-2"
                                style="color: var(--primary); font-size: 1.1em;"></i> Today, {{ date('F d, Y') }} at 2:00 PM
                        </p>
                        <p class="mb-1 text-light-emphasis small"
                            style="font-size: 0.95rem; color: var(--text-muted) !important;"><i class="fas fa-user me-2"
                                style="color: var(--primary); font-size: 1.1em;"></i> Stylist: Sarah Johnson</p>
                        <p class="mb-0 text-light-emphasis small"
                            style="font-size: 0.95rem; color: var(--text-muted) !important;"><i
                                class="fas fa-dollar-sign me-2" style="color: var(--primary); font-size: 1.1em;"></i> $65.00
                        </p>
                    </div>
                    <div class="d-flex flex-wrap justify-content-start justify-content-md-end gap-2">
                        <button class="action-btn" title="View Details"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-eye"></i> View</button>
                        <button class="action-btn" title="Reschedule Appointment"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-calendar-days"></i> Reschedule</button>
                        <button class="action-btn" title="Cancel Appointment"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: #ff6b6b; padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-times"></i> Cancel</button>
                    </div>
                </div>
            </div>

            <div class="order-card mb-3"
                style="background-color: var(--gray); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08); transition: all 0.3s ease;">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                    <div class="mb-3 mb-md-0">
                        <div class="d-flex align-items-center mb-2 flex-wrap">
                            <h5 class="service-title mb-0 me-3" style="color: var(--primary); font-size: 1.35rem;">Luxury
                                Facial Treatment</h5>
                            <span class="order-status"
                                style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 500; background: rgba(13, 110, 253, 0.2); color: #0d6efd;">Completed</span>
                        </div>
                        <p class="mb-1 text-light-emphasis small" styeclass="far=fa-calendar"me-2" font-size: 0.95rem;
                            color: vaut><i class="far fa-calendar me-2"
                                style="color: var(--primary); font-size: 1.1em;"></i> June
                            15, 2023 at 11:00 AM</p>
                        <p class="mb-1 text-light-emphasis small"
                            style="font-size: 0.95rem; color: var(--text-muted) !important;"><i class="fas fa-user me-2"
                                style="color: var(--primary); font-size: 1.1em;"></i> Therapist: Maria Garcia</p>
                        <p class="mb-0 text-light-emphasis small"
                            style="font-size: 0.95rem; color: var(--text-muted) !important;"><i
                                class="fas fa-dollar-sign me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                            $85.00
                        </p>
                    </div>
                    <div class="d-flex flex-wrap justify-content-start justify-content-md-end gap-2">
                        <button class="action-btn" title="View Details"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--text-muted); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-eye"></i> View</button>
                        <button class="action-btn" title="Rate Service"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--primary); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-star-half-stroke"></i> Rate</button>
                        <button class="action-btn" title="Rebook Service"
                            style="background-color: transparent; border: 1px solid rgba(255, 255, 255, 0.08); color: var(--accent); padding: 0.6rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 5px;"><i
                                class="fas fa-repeat"></i> Rebook</button>
                    </div>
                </div>
            </div>

            <div class="order-card mb-3"
                style="background-color: var(--gray); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08); transition: all 0.3s ease;">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                    <div class="mb-3 mb-md-0">
                        <div class="d-flex align-items-center mb-2 flex-wrap">
                            <h5 class="service-title mb-0 me-3" style="color: var(--primary); font-size: 1.35rem;">Deep
                                Tissue Massage</h5>
                            <span class="order-status"
                                style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 500; background: rgba(220, 53, 69, 0.2); color: #dc3545;">Cancelled</span>
                        </div>
                        <p class="mb-1 text-light-emphasis small"
                            style="font-size: 0.95rem; color: var(--text-muted) !important;"><i
                                class="far fa-calendar me-2" style="color: var(--primary); font-size: 1.1em;"></i> May 20,
                            2023 at 10:00 AM</p>
                        <p class="mb-1 text-light-emphasis small"
                            style="font-size: 0.95rem; color: var(--text-muted) !important;"><i class="fas fa-user me-2"
                                style="color: var(--primary); font-size: 1.1em;"></i> Therapist: Emily White</p>
                        <p class="mb-0 text-light-emphasis small"
                            style="font-size: 0.95rem; color: var(--text-muted) !important;"><i
                                class="fas fa-dollar-sign me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                            $100.00</p>
                    </div>
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

            {{--
            <div class="text-center py-5" style="background-color: var(--gray); border-radius: 1rem; padding: 2rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08);">
                <i class="far fa-calendar-check fa-3x mb-3" style="color: var(--primary);"></i>
                <h4 class="service-title" style="color: var(--primary);">No Appointments Yet</h4>
                <p class="mb-4 text-light">You haven't booked any services yet. Start your beauty journey now!</p>
                <a href="#" class="btn btn-booking" style="background: var(--primary); color: var(--dark) !important; border: none; border-radius: 50px; padding: 0.8rem 2.5rem; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease;">
                    <i class="fas fa-spa me-1"></i> Browse Services
                </a>
            </div>
            --}}
        </div>
    </div>
@endsection
