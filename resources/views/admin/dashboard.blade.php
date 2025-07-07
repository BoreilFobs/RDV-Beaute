@extends('layouts.admin')

@section('content')
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
                        <p>Registered Users</p>
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
                        <p>Stock On Sale Value</p>
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
                        <h3>{{ $productsCount }}</h3>
                        <p>prestations</p>
                        <div class="stats-change {{ $productsChange >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-arrow-{{ $productsChange >= 0 ? 'up' : 'down' }} me-1"></i>
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
                            <i class="fas fa-clock me-2"></i> Rendez-voi\us recent
                        </h3>
                        <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-booking">Tout voir</a>
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

<style>
    /* Dashboard Specific Styles */
    .dashboard-container {
        padding: 1rem;
    }

    /* Stats Cards */
    .stats-card {
        background-color: var(--gray);
        border-radius: 0.75rem;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 1.5rem;
        flex-shrink: 0;
    }

    .stats-primary .stats-icon {
        background-color: rgba(13, 110, 253, 0.2);
        color: #0d6efd;
    }

    .stats-secondary .stats-icon {
        background-color: rgba(111, 66, 193, 0.2);
        color: #6f42c1;
    }

    .stats-success .stats-icon {
        background-color: rgba(25, 135, 84, 0.2);
        color: #198754;
    }

    .stats-warning .stats-icon {
        background-color: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }

    .stats-info h3 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: var(--text-light);
    }

    .stats-info p {
        margin-bottom: 0.5rem;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .stats-change {
        font-size: 0.75rem;
        font-weight: 500;
    }

    .stats-change.positive {
        color: #198754;
    }

    .stats-change.negative {
        color: #dc3545;
    }

    /* Dashboard Tables */
    .table-dashboard {
        width: 100%;
        color: var(--text-light);
    }

    .table-dashboard thead th {
        background-color: var(--dark);
        color: var(--primary);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 0.75rem 1rem;
        border: none;
    }

    .table-dashboard tbody td {
        padding: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        vertical-align: middle;
    }

    .table-dashboard tbody tr:last-child td {
        border-bottom: none;
    }

    /* Modern Table Styling */
    .modern-table {
        background: #181818;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.18);
    }
    .modern-table thead th {
        background: #111;
        color: var(--primary);
        border: none;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        padding: 1rem 1.25rem;
    }
    .modern-table tbody tr {
        background: #181818;
        color: #fff;
        transition: background 0.2s;
    }
    .modern-table tbody tr:hover {
        background: #232323;
    }
    .modern-table tbody td {
        color: #fff;
        background: #181818;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        padding: 1rem 1.25rem;
        vertical-align: middle;
    }
    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }
    .status-badge {
        display: inline-block;
        padding: 0.35em 1em;
        border-radius: 1rem;
        font-size: 0.85em;
        font-weight: 600;
        letter-spacing: 0.03em;
        background: #232323;
        color: #fff;
        border: 1px solid var(--primary);
    }
    .btn-action.btn-edit {
        background: var(--primary);
        color: #181818;
        border-radius: 50%;
        width: 2.2rem;
        height: 2.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s, color 0.2s;
        border: none;
        font-size: 1.1rem;
        margin: 0 auto;
    }
    .btn-action.btn-edit:hover {
        background: #fff;
        color: var(--primary);
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    }
    /* Quick Stats */
    .quick-stat {
        margin-bottom: 1.5rem;
    }

    .quick-stat h4 {
        font-size: 1rem;
        color: var(--text-light);
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .progress-item {
        margin-bottom: 0.75rem;
    }

    .progress-label {
        display: flex;
        align-items: center;
        margin-bottom: 0.25rem;
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .status-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 0.5rem;
    }

    .status-pending {
        background-color: #ffc107;
    }

    .status-confirmed {
        background-color: #28a745;
    }

    .status-cancelled {
        background-color: #dc3545;
    }

    .status-completed {
        background-color: #17a2b8;
    }

    .progress-value {
        text-align: right;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 0.25rem;
    }

    .progress {
        height: 6px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-bar {
        border-radius: 3px;
    }

    .bg-pending {
        background-color: #ffc107;
    }

    .bg-confirmed {
        background-color: #28a745;
    }

    .bg-cancelled {
        background-color: #dc3545;
    }

    .bg-completed {
        background-color: #17a2b8;
    }

    /* Service Stats */
    .service-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.1);
    }

    .service-item:last-child {
        border-bottom: none;
    }

    .service-name {
        font-size: 0.85rem;
        color: var(--text-light);
    }

    .service-count {
        font-size: 0.8rem;
        color: var(--primary);
        font-weight: 500;
    }

    /* Gallery Preview */
    .gallery-preview {
        padding: 0.5rem;
    }

    .gallery-thumbnail {
        position: relative;
        border-radius: 0.5rem;
        overflow: hidden;
        aspect-ratio: 1/1;
    }

    .gallery-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-thumbnail-actions {
        position: absolute;
        top: 0;
        right: 0;
        padding: 0.25rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-thumbnail:hover .gallery-thumbnail-actions {
        opacity: 1;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .stats-card {
            padding: 1rem;
        }
        
        .stats-icon {
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
            margin-right: 1rem;
        }
        
        .stats-info h3 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 767.98px) {
        .stats-card {
            flex-direction: column;
            text-align: center;
        }
        
        .stats-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }
        
        .table-dashboard thead {
            display: none;
        }
        
        .table-dashboard tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
        }
        
        .table-dashboard tbody td:before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--primary);
            margin-right: 1rem;
            flex: 0 0 100px;
            font-size: 0.75rem;
        }

        .modern-table thead {
            display: none;
        }
        .modern-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            font-size: 0.95em;
        }
        .modern-table tbody td:before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--primary);
            margin-right: 1rem;
            flex: 0 0 110px;
            font-size: 0.8rem;
        }
    }
</style>
@endsection