@extends('layouts.admin')

@section('content')
    <div class="container-fluid mb-5 pb-5">
        <div class="appointments-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-calendar-alt me-3"></i> Appointment Details
                </h2>
                <div>
                    <a href="{{ route('DashAppointment.index') }}" class="btn btn-booking me-2">
                        <i class="fas fa-arrow-left me-2"></i> Back to Appointments
                    </a>
                </div>
            </div>

            <div class="form-card-wrapper p-4 p-md-5">
                <div class="row g-4">
                    <!-- Client Information -->
                    <div class="col-12 col-md-6">
                        <div class="info-card">
                            <h3 class="info-card-title">
                                <i class="fas fa-user-circle me-2"></i> Client Details
                            </h3>
                            <div class="info-card-body">
                                <div class="info-row">
                                    <span class="info-label">Name:</span>
                                    <span class="info-value">{{ App\Models\User::find($appointment->user_id)->name}}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Phone:</span>
                                    <span class="info-value">{{ $appointment->phone }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">User ID:</span>
                                    <span class="info-value">#{{ $appointment->user_id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Information -->
                    <div class="col-12 col-md-6">
                        <div class="info-card">
                            <h3 class="info-card-title">
                                <i class="fas fa-calendar-check me-2"></i> Appointment Details
                            </h3>
                            <div class="info-card-body">
                                <div class="info-row">
                                    <span class="info-label">Date:</span>
                                    <span class="info-value">{{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Time:</span>
                                    <span class="info-value">{{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Service:</span>
                                    <span class="info-value">{{ App\Models\Offers::find($appointment->offer_id)->name ?? 'N/A' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Status:</span>
                                    <span class="info-value">
                                        <span class="status-badge status-{{ $appointment->status }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div class="col-12">
                        <div class="info-card">
                            <h3 class="info-card-title">
                                <i class="fas fa-comment-dots me-2"></i> Special Requests
                            </h3>
                            <div class="info-card-body">
                                @if($appointment->special_requests)
                                    <p class="special-requests">
                                        {{ $appointment->special_requests }}
                                    </p>
                                @else
                                    <p class="text-muted-custom">No special requests provided</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-12 text-center mt-4">
                        @if($appointment->status === 'pending')
                            <form action="{{ route('DashAppointment.accept', $appointment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success me-3">
                                    <i class="fas fa-check me-2"></i> Confirm
                                </button>
                            </form>
                            <form action="{{ route('DashAppointment.reject', $appointment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this appointment?')">
                                    <i class="fas fa-times me-2"></i> Reject
                                </button>
                            </form>
                        @endif
                        @if($appointment->status === 'confirmed')
                            <form action="{{ route('DashAppointment.complete', $appointment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-check-double me-2"></i> Mark as Completed
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Info Card Styling */
        .info-card {
            background-color: var(--gray);
            border-radius: 1rem;
            padding: 1.5rem;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .info-card-title {
            color: var(--primary);
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }

        .info-card-body {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-label {
            color: var(--text-light);
            font-weight: 500;
            flex: 0 0 120px;
        }

        .info-value {
            color: var(--text-light);
            text-align: right;
            flex-grow: 1;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }

        .status-confirmed {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }

        .status-cancelled {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        .status-completed {
            background-color: rgba(23, 162, 184, 0.2);
            color: #17a2b8;
        }

        /* Special Requests */
        .special-requests {
            background-color: var(--dark);
            padding: 1rem;
            border-radius: 0.75rem;
            border-left: 3px solid var(--primary);
            color: var(--text-light);
            line-height: 1.6;
            white-space: pre-wrap;
            word-break: break-word;
            height: auto;
        }

        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }
            
            .info-label, .info-value {
                flex: 1;
                text-align: left;
                width: 100%;
            }
            
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .dashboard-header .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>
@endsection