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

        .action-btn .action-text {
            margin-left: 6px;
            white-space: nowrap;
        }

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
            <button class="filter-btn active" data-status="all">All</button>
            <button class="filter-btn" data-status="completed">Completed</button>
            <button class="filter-btn" data-status="pending">Pending</button>
            <button class="filter-btn" data-status="cancelled">Cancelled</button>
            <button class="filter-btn" data-status="confirmed">Confirmed</button>
        </div>

        <div class="appointments-list">
            @forelse($appointments as $appointment)
                <div class="order-card mb-3"
                    data-appointment-id="{{ $appointment->id }}"
                    data-status="{{ strtolower($appointment->status) }}"
                    style="background-color: var(--gray); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08); transition: all 0.3s ease;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="mb-3 mb-md-0">
                            <div class="d-flex align-items-center mb-2 flex-wrap">
                                <h5 class="service-title mb-0 me-3" style="color: var(--primary); font-size: 1.35rem;">
                                    {{ App\Models\Offers::findOrFail($appointment->offer_id)->name ?? 'Service' }}
                                </h5>
                                @php
                                    $status = strtolower($appointment->status ?? 'pending');
                                    $statusColors = [
                                        'confirmed' => ['bg' => 'rgba(40, 167, 69, 0.2)', 'color' => '#28a745', 'label' => 'Confirmed'],
                                        'completed' => ['bg' => 'rgba(13, 110, 253, 0.2)', 'color' => '#0d6efd', 'label' => 'Completed'],
                                        'cancelled' => ['bg' => 'rgba(220, 53, 69, 0.2)', 'color' => '#dc3545', 'label' => 'Cancelled'],
                                        'pending' => ['bg' => 'rgba(255, 193, 7, 0.2)', 'color' => '#ffc107', 'label' => 'Pending'],
                                    ];
                                    $color = $statusColors[$status]['color'] ?? '#ffc107';
                                    $bg = $statusColors[$status]['bg'] ?? 'rgba(255, 193, 7, 0.2)';
                                    $label = $statusColors[$status]['label'] ?? ucfirst($status);
                                @endphp
                                <span class="order-status"
                                    style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 500; background: {{ $bg }}; color: {{ $color }};">
                                    {{ $label }}
                                </span>
                            </div>
                            <p class="mb-1 text-light-emphasis small"
                                style="font-size: 0.95rem; color: var(--text-muted) !important;">
                                <i class="far fa-calendar me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                                {{ \Carbon\Carbon::parse($appointment->date)->format('F d, Y') }}
                                at {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                            </p>
                            <p class="mb-0 text-light-emphasis small"
                                style="font-size: 0.95rem; color: var(--text-muted) !important;">
                                <i class="fas fa-dollar-sign me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                                {{ number_format(App\Models\Offers::findOrFail($appointment->offer_id)->cost) }} FCFA
                            </p>
                            @php
                                $appointmentDateTime = \Carbon\Carbon::parse($appointment->date . ' ' . $appointment->time);
                                $now = \Carbon\Carbon::now();
                                $diffForHumans = $appointmentDateTime->isFuture()
                                    ? $now->diffForHumans($appointmentDateTime, [
                                        'parts' => 3,
                                        'short' => true,
                                        'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                    ]) . ' left'
                                    : 'Started ' . $appointmentDateTime->diffForHumans($now, [
                                        'parts' => 3,
                                        'short' => true,
                                        'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                    ]) . ' ago';
                            @endphp
                            <p class="mb-0 fw-bold text-light-emphasis small"
                                style="font-size: 0.95rem; color: var(--text-muted) !important;">
                                <i class="fas fa-clock me-2" style="color: var(--primary); font-size: 1.1em;"></i>
                                {{ $diffForHumans }}
                            </p>
                        </div>
                        <div class="d-flex flex-wrap justify-content-start justify-content-md-end gap-2">
                            {{-- <button class="action-btn" title="View Details">
                                <i class="fas fa-eye"></i>
                                <span class="action-text d-none d-md-inline">View</span>
                            </button> --}}
                            @if($status === 'pending')
                                <button class="action-btn" title="Reschedule">
                                    <i class="fas fa-calendar-days"></i>
                                    <span class="action-text d-none d-md-inline">Reschedule</span>
                                </button>
                                <form method="POST" action="{{ route('appointments.cancel', $appointment->id) }}" onsubmit="return confirm('Are you sure you want to cancel this appointment?');" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="action-btn" title="Cancel">
                                        <i class="fas fa-times"></i>
                                        <span class="action-text d-none d-md-inline">Cancel</span>
                                    </button>
                                </form>
                            @elseif($status === 'cancelled')
                                <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" onsubmit="return confirm('Are you sure you want to delete this appointment?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                        <span class="action-text d-none d-md-inline">Delete</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Attach click event to all reschedule buttons
                    document.querySelectorAll('.action-btn[title="Reschedule"]').forEach(function(btn, idx) {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            // Find the appointment id (assuming it's available as a data attribute or in the DOM)
                            // You can add data-appointment-id="{{ $appointment->id }}" to the button in your blade
                            let card = btn.closest('.order-card');
                            let appointmentId = card?.getAttribute('data-appointment-id');
                            if (!appointmentId) {
                                // fallback: try to get from a hidden input or similar
                                appointmentId = btn.getAttribute('data-appointment-id');
                            }
                            if (appointmentId) {
                                document.getElementById('reschedule_appointment_id').value = appointmentId;
                                var modal = new bootstrap.Modal(document.getElementById('rescheduleModal'));
                                modal.show();
                            }
                        });
                    });
                });
                </script>
            @empty
                <div class="text-center py-5" style="background-color: var(--gray); border-radius: 1rem; padding: 2rem; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.08);">
                    <i class="far fa-calendar-check fa-3x mb-3" style="color: var(--primary);"></i>
                    <h4 class="service-title" style="color: var(--primary);">No Appointments Found</h4>
                    <p class="mb-4 text-light">There are no appointments matching your filter. Try another status or book a new service!</p>
                    <a href="{{ route('prestations') }}" class="btn btn-booking" style="background: var(--primary); color: var(--dark) !important; border: none; border-radius: 50px; padding: 0.8rem 2.5rem; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease;">
                        <i class="fas fa-spa me-1"></i> Browse Services
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Add this modal at the end of your content section -->
    <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <form id="rescheduleForm" method="POST" action="{{ route('appointments.reschedule', ['appointment' => 'APPOINTMENT_ID']) }}">
          @csrf
          <input type="hidden" name="appointment_id" id="reschedule_appointment_id">
          <div class="modal-content" style="background: var(--gray); color: #fff;">
            <div class="modal-header border-0">
              <h5 class="modal-title" id="rescheduleModalLabel"><i class="fas fa-calendar-days me-2"></i>Reschedule Appointment</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
            <label for="new_date" class="form-label">New Date</label>
            <input type="date" class="form-control" name="new_date" id="new_date" required>
              </div>
              <div class="mb-3">
            <label for="new_time" class="form-label">New Time</label>
            <input type="time" class="form-control" name="new_time" id="new_time" required>
              </div>
            </div>
            <div class="modal-footer border-0">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" style="background: var(--primary); color: var(--dark); border: none;">Reschedule</button>
            </div>
          </div>
        </form>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.action-btn[title="Reschedule"]').forEach(function(btn, idx) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    let card = btn.closest('.order-card');
                    let appointmentId = card?.getAttribute('data-appointment-id');
                    if (!appointmentId) {
                        appointmentId = btn.getAttribute('data-appointment-id');
                    }
                    if (appointmentId) {
                        document.getElementById('reschedule_appointment_id').value = appointmentId;
                        // Update the form action with the appointment id
                        let form = document.getElementById('rescheduleForm');
                        let baseAction = "{{ route('appointments.reschedule', ['appointment' => 'APPOINTMENT_ID']) }}";
                        form.action = baseAction.replace('APPOINTMENT_ID', appointmentId);
                        var modal = new bootstrap.Modal(document.getElementById('rescheduleModal'));
                        modal.show();
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
            document.querySelectorAll('.filter-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Remove active from all
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    const status = btn.getAttribute('data-status');
                    document.querySelectorAll('.order-card').forEach(card => {
                        if (status === 'all' || card.getAttribute('data-status') === status) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
        </script>
      </div>
    </div>

    
@endsection
