@extends('layouts.navigation')

@section('content')
    <style>
        :root {
            --primary: #e1bb87;
            --dark: #121212;
            --gray: #1e1e1e;
            --light: #f8f9fa;
            --accent: #6bd1e3;
            --text-muted: #a0a0a0;
        }

        * {
            color: white
        }

        .booking-container {
            max-width: 1200px;
            margin-top: 100px;
            margin: 140px auto;
            padding: 0 20px;
            position: relative;
            top: 30px;
        }

        .booking-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .booking-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2.2rem;
            color: white;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .booking-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--primary);
        }

        .booking-card {
            background: linear-gradient(145deg, #252525, #1a1a1a);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.36);
            padding: 30px;
            margin-bottom: 30px;
        }

        .service-summary {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        @media (min-width: 992px) {
            .service-summary {
                flex-direction: row;
            }
        }

        .service-image {
            width: 100%;
            max-width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
        }

        .service-details {
            flex: 1;
        }

        .service-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
            margin-bottom: 10px;
        }

        .service-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            color: var(--text-muted);
        }

        .meta-item i {
            margin-right: 8px;
            color: var(--accent);
        }

        .service-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .service-description {
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .booking-form-section {
            margin-top: 40px;
        }

        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: white;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(225, 187, 135, 0.3);
        }

        .calendar-container {
            background: rgba(30, 30, 30, 0.7);
            border-radius: 12px;
            padding: 20px;

            margin-bottom: 30px;
        }

        .time-slots {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
            margin-top: 20px;
        }

        .time-slot {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .time-slot:hover {
            background: rgba(225, 187, 135, 0.1);
            border-color: var(--primary);
        }

        .time-slot.selected {
            background: var(--primary);
            color: var(--dark);
            font-weight: 600;
            border-color: var(--primary);
        }

        .time-slot.unavailable {
            opacity: 0.5;
            cursor: not-allowed;
            text-decoration: line-through;
        }

        .form-control {
            background: rgba(30, 30, 30, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 8px;
            padding: 12px 15px;
        }

        .form-control:focus {
            background: rgba(30, 30, 30, 0.9);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(225, 187, 135, 0.25);
        }

        .btn-confirm {
            background: var(--primary);
            color: var(--dark);
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
            width: 100%;
            margin-top: 20px;
        }

        .btn-confirm:hover {
            background: #d4a76a;
            transform: translateY(-2px);
        }

        .stylist-selection {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
        }

        .stylist-card {
            background: rgba(30, 30, 30, 0.7);
            border-radius: 8px;
            padding: 15px;
            width: 100%;
            max-width: 200px;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stylist-card:hover {
            background: rgba(225, 187, 135, 0.1);
            border-color: var(--primary);
        }

        .stylist-card.selected {
            background: rgba(225, 187, 135, 0.2);
            border-color: var(--primary);
        }

        .stylist-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 2px solid var(--primary);
        }

        .stylist-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stylist-specialty {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        @media (max-width: 768px) {
            .booking-title {
                font-size: 1.8rem;
            }

            .time-slots {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }

            .stylist-selection {
                justify-content: center;
            }
        }
    </style>

    <!-- Add Poppins font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="booking-container">
        <div class="booking-header">
            <h1 class="booking-title">Book Your Appointment</h1>
            <p class="text-muted">Complete your reservation in just a few steps</p>
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
                            <span>${{ $offer->cost ?? 'N/A' }} FCFA</span>
                        </div>
                    </div>
                    <div class="service-price">${{ $offer->cost ?? 'N/A' }}</div>
                    <p class="service-description">
                        {{ $offer->description ?? '' }}
                    </p>
                </div>
            </div>

            <!-- Booking Form -->
            <form action="{{ route('appointments.store', ['offer' => $offer->id]) }}" method="POST" class="booking-form-section">
                @csrf
                <h3 class="section-title">Select Date & Time</h3>

                <div class="calendar-container">
                    <!-- Date Picker -->
                    <div class="mb-4">
                        <label for="appointmentDate" class="form-label">Choose a date</label>
                        <input type="date" class="form-control" id="appointmentDate" name="date" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Time Slots -->
                    <div>
                        <label class="form-label">Choose Start Time</label>
                        <input type="time" class="form-control" id="time" name="time" step="900" required>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="mt-5">
                    <h3 class="section-title">Your Information</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="Alex" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="" required>
                        </div>
                        <div class="col-12">
                            <label for="special_requests" class="form-label">Special Requests (Optional)</label>
                            <textarea class="form-control" id="special_requests" name="special_requests" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Hidden field for offer/service id -->
                <input type="hidden" name="offer_id" value="{{ $offer->id }}">

                <!-- Confirmation Button -->
                <button type="submit" class="btn btn-confirm">
                    <i class="fas fa-calendar-check me-2"></i> Confirm Appointment
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
