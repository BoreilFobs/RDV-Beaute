@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/dashAppointment/index.css') }}">

    <div class="container-fluid">
        <div class="offers-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-calendar-check me-3"></i> Rendez-Vous ({{ $appointments->count() }})
                </h2>
                <div class="mb-4 w-50">
                    <form method="GET" action="{{ route('DashAppointment.index') }}" class="d-flex flex- gap-2 align-items-center">
                        <label class="me-2 fw-bold text-light" for="status_filter">Filtrer par Statut:</label>
                        <select name="status" id="status_filter" class="form-select" style="max-width: 220px; background: #18171c; color: #fff; border: 1.5px solid var(--primary); border-radius: 30px;">
                            <option value="">Tout</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmer</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                        </select>
                        <button type="submit" class="btn btn-primary ms-2" style="border-radius:30px; background:var(--primary); color:var(--dark); border:none;">
                            <i class="fas fa-filter me-1"></i> Filtrer
                        </button>
                    </form>
                </div>
            </div>

            <div class="table-responsive offers-table-wrapper">
                <table class="table table-offers">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Service</th>
                            <th>Jour&Heur</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appointments as $appointment)
                            <tr class="clickable-row" style="cursor:pointer;" onclick="window.location='{{ route('DashAppointment.show', $appointment->id) }}'">
                                <td data-label="User">
                                    {{ optional(App\Models\User::find($appointment->user_id))->name ?? 'N/A' }}
                                </td>
                                <td data-label="Service">
                                    {{ optional(App\Models\Offers::find($appointment->offer_id))->name ?? 'N/A' }}
                                </td>
                                <td data-label="Date & Time">
                                    {{ $appointment->date }}
                                    <span class="t">{{ $appointment->time }}</span>
                                </td>
                                <td data-label="Status">
                                    @php
                                        $statusColors = [
                                            'pending'   => 'bg-warning text-dark',    // yellow
                                            'confirmed' => 'bg-success text-white',   // green
                                            'cancelled' => 'bg-danger text-white',    // red
                                            'rejected'  => 'bg-secondary text-white', // gray
                                            'completed' => 'bg-info text-dark',       // blue
                                        ];
                                    @endphp

                                    <span class="order-status badge {{ $statusColors[$appointment->status] ?? 'bg-light text-dark' }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="text-end" data-label="Actions">
                                    <div class="d-flex flex-wrap justify-content-end action-buttons-group">
                                        @if($appointment->status == 'pending')
                                            <form action="{{ route('DashAppointment.accept', $appointment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-view" title="confirm" onclick="event.stopPropagation();">
                                                    <i class="fas fa-check"></i> <span class="d-md-none">Accepter</span>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('DashAppointment.show', $appointment->id) }}" class="btn btn-sm btn-view" title="View Details" onclick="event.stopPropagation();">
                                            <i class="fas fa-eye"></i> <span class="d-md-none">Voir</span>
                                        </a>
                                        @if($appointment->status === 'canceled')
                                            <form action="{{ route('DashAppointment.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-delete" title="Delete"
                                                    onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this appointment?')">
                                                    <i class="fas fa-trash-alt"></i> <span class="d-md-none">Supprimer</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <div class="empty-state-content">
                                        <i class="fas fa-calendar-check fa-3x mb-3" style="color: var(--primary);"></i>
                                        <h4 class="service-title" style="color: var(--primary);">Aucune Prestation trouvé</h4>
                                        <p class="text-light">Pas de prestation pour le moment</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($appointments instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="d-flex justify-content-center mt-4">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
