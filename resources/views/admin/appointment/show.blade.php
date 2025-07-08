@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/dashAppointment/show.css') }}">

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
@endsection