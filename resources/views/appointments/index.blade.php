@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/appointments/index.css') }}">

    <style>
        
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
            <button class="filter-btn active" data-status="all">Tout</button>
            <button class="filter-btn" data-status="completed">Terminé</button>
            <button class="filter-btn" data-status="pending">En attente</button>
            <button class="filter-btn" data-status="cancelled">annulé</button>
            <button class="filter-btn" data-status="confirmed">Confirmé</button>
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
                                        'confirmed' => ['bg' => 'rgba(40, 167, 69, 0.2)', 'color' => '#28a745', 'label' => 'Confirmé'],
                                        'completed' => ['bg' => 'rgba(13, 110, 253, 0.2)', 'color' => '#0d6efd', 'label' => 'Terminé'],
                                        'cancelled' => ['bg' => 'rgba(220, 53, 69, 0.2)', 'color' => '#dc3545', 'label' => 'annulé'],
                                        'rejected' => ['bg' => 'rgba(220, 53, 69, 0.2)', 'color' => '#dc3545', 'label' => 'rejeté'],
                                        'pending' => ['bg' => 'rgba(255, 193, 7, 0.2)', 'color' => '#ffc107', 'label' => 'En attente'],
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
                                if (!$appointmentDateTime->isFuture() && $appointmentDateTime->diffInMinutes($now) >= 60) {
                                    $diffForHumans = 'finished';
                                } else {
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
                                }
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
                                    <span class="action-text d-none d-md-inline">Reprogremmer</span>
                                </button>
                                <form method="POST" action="{{ route('appointments.cancel', $appointment->id) }}" onsubmit="return confirm('Are you sure you want to cancel this appointment?');" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="action-btn" title="Cancel">
                                        <i class="fas fa-times"></i>
                                        <span class="action-text d-none d-md-inline">Annuler</span>
                                    </button>
                                </form>
                            @elseif($status === 'cancelled')
                                <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" onsubmit="return confirm('Are you sure you want to delete this appointment?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                        <span class="action-text d-none d-md-inline">Suprimer</span>
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
                    <h4 class="service-title" style="color: var(--primary);">Aucun rendez-vous trouvé</h4>
                    <p class="mb-4 text-light">Aucun rendez-vous ne correspond a votre filtre. créer en un!</p>
                    <a href="{{ route('prestations') }}" class="btn btn-booking" style="background: var(--primary); color: var(--dark) !important; border: none; border-radius: 50px; padding: 0.8rem 2.5rem; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease;">
                        <i class="fas fa-spa me-1"></i> Voir les Prestation
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Reschedule Modal -->
    <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <form id="rescheduleForm" method="POST" action="{{ route('appointments.reschedule', ['appointment' => 'APPOINTMENT_ID']) }}">
          @csrf
          <input type="hidden" name="appointment_id" id="reschedule_appointment_id">
          <div class="modal-content custom-modal-content">
            <div class="modal-header custom-modal-header">
              <h5 class="modal-title" id="rescheduleModalLabel">
                <i class="fas fa-calendar-days me-2"></i>Reprogrammer le rendez-vous
              </h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body custom-modal-body">
              <p class="mb-3 text-muted-custom">
                S'il vous plait selectioner une nouvelle date et heur pour votre rendez vous. Les donnée seront mise a jours
              </p>
              <div class="mb-3">
            <label for="new_date" class="form-label">Nouveau jours</label>
            <input type="date" class="form-control custom-input" name="new_date" id="new_date" required placeholder="Select new date">
              </div>
              <div class="mb-3">
            <label for="new_time" class="form-label">Nouvelle heur</label>
            <input type="time" class="form-control custom-input" name="new_time" id="new_time" required placeholder="Select new time">
              </div>
            </div>
            <div class="modal-footer custom-modal-footer">
              <button type="button" class="btn btn-secondary custom-btn" data-bs-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary custom-btn">Reprogrammer</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <style>
    /* Modal Styling (shared with stock modal) */
    .custom-modal-content {
        background: #181818;
        color: #fff;
        border-radius: 1rem;
        border: 1px solid var(--primary);
        box-shadow: 0 8px 32px rgba(0,0,0,0.45);
    }
    .custom-modal-header {
        background: var(--primary);
        color: #fff;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        border-bottom: none;
    }
    .custom-modal-header .modal-title {
        color: #fff;
        font-weight: 600;
    }
    .custom-modal-body {
        background: #181818;
        color: #fff;
    }
    .custom-modal-footer {
        background: #181818;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
        border-top: none;
    }
    .btn-close-white {
        filter: invert(1);
    }
    .text-muted-custom {
        color: #bbb !important;
    }
    .custom-input {
        background: #232323;
        color: #fff;
        border: 1px solid var(--primary);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        transition: border-color 0.2s;
    }
    .custom-input:focus {
        border-color: var(--primary);
        background: #222;
        color: #fff;
        box-shadow: 0 0 0 0.1rem var(--primary);
    }
    .custom-btn {
        border-radius: 0.5rem;
        font-weight: 600;
        padding: 0.6rem 1.5rem;
        border: none;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .btn-primary.custom-btn {
        background: var(--primary);
        color: #fff;
    }
    .btn-primary.custom-btn:hover {
        background: #0a58ca;
        color: #fff;
    }
    .btn-secondary.custom-btn {
        background: #232323;
        color: var(--primary);
        border: 1px solid var(--primary);
    }
    .btn-secondary.custom-btn:hover {
        background: var(--primary);
        color: #fff;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reschedule modal logic
        document.querySelectorAll('.action-btn[title="Reschedule"]').forEach(function(btn) {
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

        // Fix for stuck modal-backdrop
        document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Remove any lingering modal-backdrop
                document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
                    backdrop.parentNode.removeChild(backdrop);
                });
                document.body.classList.remove('modal-open');
                document.body.style = '';
            });
        });
    });
    </script>
@endsection
