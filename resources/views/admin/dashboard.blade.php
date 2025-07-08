@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/dashboard.css') }}">

<div class="container-fluid">
    <div class="dashboard-container">
        <!-- Dashboard Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
            <h2 class="service-title dashboard-section-title">
                <i class="fas fa-tachometer-alt me-3"></i> Tableau de board Administrateur
            </h2>
            <div class="text-muted-custom">
                Last updated: {{ now()->format('F j, Y g:i A') }}
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <!-- Appointments Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stats-card stats-primary">
                    <div class="stats-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stats-info">
                        <h3>{{ $appointmentsCount }}</h3>
                        <p>Rendez-vous Termine
                        </p>
                        <div class="stats-change {{ $appointmentsChange >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-arrow-{{ $appointmentsChange >= 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($appointmentsChange) }}% Au mois passe
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stats-card stats-secondary">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-info">
                        <h3>{{ $usersCount }}</h3>
                        <p>Utilisateur inscrit</p>
                        <div class="stats-change {{ $usersChange >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-arrow-{{ $usersChange >= 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($usersChange) }}% au mois passe
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stats-card stats-success">
                    <div class="stats-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stats-info">
                        <h3>{{ number_format($stockOnSaleValue, 0, '.', ' ') }} FCFA</h3>
                        <p>Valeur du stock</p>
                        <div class="stats-change {{ $stockOnSaleChange >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-arrow-{{ $stockOnSaleChange >= 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($stockOnSaleChange) }}% au mois passe
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stats-card stats-warning">
                    <div class="stats-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="stats-info">
                        <h3>{{ $prestationsCount }}</h3>
                        <p>prestations</p>
                        <div class="stats-change {{ $prestationsChange >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-arrow-{{ $prestationsChange >= 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($productsChange) }}% au mois passe
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Stats -->
        <div class="row g-4 mb-4">
            <!-- Recent Appointments -->
            <div class="col-12 col-lg-8">
                <div class="form-card-wrapper">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="dashboard-section-title">
                            <i class="fas fa-clock me-2"></i> Rendez-vous recent
                        </h3>
                        <a href="{{ route('DashAppointment.index') }}" class="btn btn-sm btn-booking">Tout voir</a>
                    </div>
                    <div class="table-responsive">
                        @if($recentAppointments->isEmpty())
                            <div class="text-center py-5" style="background-color: #181818; border-radius: 1rem; color: #bbb;">
                                <i class="far fa-calendar-check fa-3x mb-3" style="color: var(--primary);"></i>
                                <h4 class="service-title" style="color: var(--primary);">Aucun rendez-vous recent</h4>
                                <p class="mb-0">aucun rendez-vous n'as ete pris recement.</p>
                            </div>
                        @else
                        <table class="table table-dashboard modern-table">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Service</th>
                                    <th>jours/heur</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->name }}</td>
                                    <td>{{ $appointment->offer->name ?? 'N/A' }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($appointment->date)->format('M j') }} 
                                        at {{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ $appointment->status }}">
                                         {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="col-12 col-lg-4">
                <div class="form-card-wrapper">
                    <h3 class="dashboard-section-title mb-3">
                        <i class="fas fa-chart-pie me-2"></i> Stats Rapid
                    </h3>
                    
                    <!-- Status Distribution -->
                    <div class="quick-stat mb-4">
                        <h4>Status des Rendez-vous</h4>
                        <div class="progress-stats">
                            @foreach($appointmentStatuses as $status)
                            <div class="progress-item">
                                <div class="progress-label">
                                    <span class="status-indicator status-{{ $status->status }}"></span>
                                    {{ ucfirst($status->status) }}
                                </div>
                                <div class="progress-value">{{ $status->count }} ({{ $status->percentage }}%)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-{{ $status->status }}" 
                                         role="progressbar" 
                                         style="width: {{ $status->percentage }}%">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Popular Services -->
                    <div class="quick-stat">
                        <h4>Services Populaire</h4>
                        <div class="service-stats">
                            @foreach($popularServices as $service)
                            <div class="service-item">
                                <div class="service-name">{{ $service->name }}</div>
                                <div class="service-count">{{ $service->appointments_count }} bookings</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Users & Gallery Preview -->
        <div class="row g-4">
            <!-- Recent Users -->
            <div class="col-12 col-lg-6">
                <div class="form-card-wrapper">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="dashboard-section-title">
                            <i class="fas fa-user-plus me-2"></i> Utilisateur recent
                        </h3>
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-booking">Tout voir</a>
                    </div>
                    <div class="table-responsive">
                        @if($recentUsers->isEmpty())
                            <div class="text-center py-5" style="background-color: #181818; border-radius: 1rem; color: #bbb;">
                                <i class="fas fa-user-friends fa-3x mb-3" style="color: var(--primary);"></i>
                                <h4 class="service-title" style="color: var(--primary);">Aucun utilisateur recent</h4>
                                <p class="mb-0">Aucun utilisateur ne c'est enregistrer recement.</p>
                            </div>
                        @else
                        <table class="table table-dashboard modern-table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>A rejoin</th>
                                    <th>Terminee</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>{{ $user->appointments_count }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Gallery Preview -->
            <div class="col-12 col-lg-6">
                <div class="form-card-wrapper">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="dashboard-section-title">
                            <i class="fas fa-images me-2"></i> Media Gallery recent
                        </h3>
                        <a href="{{ route('gallery.index') }}" class="btn btn-sm btn-booking">Tout voir</a>
                    </div>
                    <div class="gallery-preview">
                        @if($recentGalleryItems->isEmpty())
                            <div class="text-center py-5" style="background-color: #181818; border-radius: 1rem; color: #bbb;">
                                <i class="fas fa-image fa-3x mb-3" style="color: var(--primary);"></i>
                                <h4 class="service-title" style="color: var(--primary);">Aucun televersement</h4>
                                <p class="mb-0">Aucune image n'as ete televersee recement .</p>
                            </div>
                        @else
                        <div class="row g-2">
                            @foreach($recentGalleryItems as $item)
                            <div class="col-4 col-md-3">
                                <div class="gallery-thumbnail">
                                    <img src="{{ $item->img_url }}" alt="gallery image" class="img-fluid">
                                    <div class="gallery-thumbnail-actions">
                                        <form action="{{ route('gallery.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection