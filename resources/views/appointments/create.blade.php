@extends('layouts.navigation')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/appointments/create.css') }}">
    <!-- Add Poppins font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="booking-container">
        <div class="booking-header">
            <h1 class="booking-title">Prendre Rendez-vous</h1>
            <p class="text-muted">Prenez votre rendez-vous en quelques étapes seulement</p>
        </div>

        <div class="booking-card">
            <!-- Service Summary -->
            <div class="service-summary">
                <img src="{{ $offer->img_path ? asset('storage/' . $offer->img_path) : 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9' }}" class="service-image"
                    alt="{{ $offer->name ?? 'Service Image' }}">
                <div class="service-details">
                    <h2 class="service-name">{{ $offer->name }}</h2>
                    <div class="service-meta">
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ $offer->duration ?? 'N/A' }} minutes</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-dollar-sign"></i>
                            <span>{{ $offer->cost ?? 'N/A' }} FCFA</span>
                        </div>
                    </div>
                    <div class="service-price">{{ $offer->cost ?? 'N/A' }} FCFA</div>
                    <p class="service-description">
                        {{ $offer->description ?? '' }}
                    </p>
                </div>
            </div>

            <!-- Booking Form -->
            <form action="{{ route('appointments.store', ['offer' => $offer->id]) }}" method="POST" class="booking-form-section">
                @csrf
                <h3 class="section-title">Votre jours, Votre Heur</h3>

                <div class="calendar-container">
                    <!-- Date Picker -->
                    <div class="mb-4">
                        <label for="appointmentDate" class="form-label">Votre jour</label>
                        <input type="date" class="form-control" id="appointmentDate" name="date" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Time Slots -->
                    <div>
                        <label class="form-label">Votre heur</label>
                        <input type="time" class="form-control" id="time" name="time" step="900" required>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="mt-5">
                   
                        <div class="col-12">
                            <label for="special_requests" class="form-label">Demande Special </label>
                            <textarea class="form-control" id="special_requests" name="special_requests" rows="3"></textarea>
                        </div>
                </div>

                <!-- Hidden field for offer/service id -->
                <input type="hidden" name="offer_id" value="{{ $offer->id }}">

                <!-- Confirmation Button -->
                <button type="submit" class="btn btn-confirm">
                    <i class="fas fa-calendar-check me-2"></i> Confirmer le Rendez-vous
                </button>
            </form>
        </div>
    </div>

    <script>
        // Time slot selection
        document.querySelectorAll('.time-slot:not(.unavailable)').forEach(slot => {
            slot.addEventListener('click', function() {
                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Stylist selection
        document.querySelectorAll('.stylist-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.stylist-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Initialize date picker with tomorrow as default
        document.getElementById('appointmentDate').valueAsDate = new Date(new Date().getTime() + 86400000);
    </script>
@endsection
