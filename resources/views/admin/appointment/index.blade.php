@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="offers-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-calendar-check me-3"></i> Rendez-Vous
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
    <style>
        /* --- Variables (Ensure these are consistent across your app) --- */
        :root {
            --primary: #E1BB87;
            /* A warm, inviting gold/bronze */
            --accent: #6BD1E3;
            /* A cool, vibrant blue/cyan */
            --dark: #1A1A1A;
            /* Dark background */
            --gray: #252525;
            /* Slightly lighter dark for cards/elements */
            --text-muted: #A0A0A0;
            /* Muted text for secondary info */
            --text-light: #E0E0E0;
            /* Light text for main content */
        }

        /* --- General Dashboard/Admin Header Styles (reused for consistency) --- */
        .dashboard-section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 1px;
            text-shadow: 0 0 8px rgba(225, 187, 135, 0.5);
            display: flex;
            align-items: center;
        }

        .dashboard-section-title i {
            font-size: 1.2em;
            /* Slightly larger icon for title */
        }

        .btn-booking {
            background: var(--primary);
            color: var(--dark) !important;
            border: none;
            border-radius: 50px;
            padding: 0.6rem 1.8rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-booking:hover {
            background: var(--accent);
            /* Subtle hover effect */
            box-shadow: 0 0 15px rgba(107, 209, 227, 0.4);
        }

        /* --- Offers Table Styling --- */
        .offers-table-wrapper {
            background: var(--gray);
            border-radius: 12px;
            overflow-x: auto;
            /* For horizontal scrolling on small screens if needed */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            /* Deeper shadow */
            border: 1px solid rgba(255, 255, 255, 0.08);
            /* Subtle border */
        }

        .table-offers {
            width: 100%;
            margin-bottom: 0;
            /* Remove default table margin */
            color: var(--text-light);
            /* Default text color for table content */
        }

        .table-offers thead th {
            background: rgba(225, 187, 135, 0.2);
            color: var(--primary);
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            padding: 15px 20px;
            border-bottom: 2px solid var(--primary);
            white-space: nowrap;
            /* Prevent headers from wrapping */
        }

        .table-offers tbody tr {
            background: #18171c !important; /* deep black */
            color: #fff !important;
            transition: all 0.2s ease;
        }

        .table-offers tbody td {
            color: #fff !important;
            background: transparent !important;
        }

        .table-offers tbody td strong {
            color: #fff !important;
        }

        .table-offers tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .table-offers tbody td {
            padding: 15px 20px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--text-muted);
            /* Default text for table cells */
            font-size: 0.95rem;
        }

        .table-offers tbody td strong {
            color: var(--text-light);
            /* Make service name stand out */
        }

        .offer-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            background-size: cover;
            background-position: center;
            margin: 0 auto;
            border: 2px solid rgba(225, 187, 135, 0.3);
            flex-shrink: 0;
            /* Prevent shrinking on mobile */
        }

        .badge.bg-category {
            background-color: rgba(225, 187, 135, 0.2) !important;
            color: var(--primary);
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
            text-transform: capitalize;
            font-size: 0.85em;
            /* Slightly smaller badge text */
        }

        /* Action Buttons (General Styles) */
        .btn-view,
        .btn-edit,
        .btn-delete {
            width: 38px;
            /* Slightly larger buttons for easier tap */
            height: 38px;
            /* Maintain aspect ratio */
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            /* Slightly more rounded */
            margin-left: 8px;
            /* Increased margin for spacing */
            font-size: 0.95rem;
            /* Larger icon/text */
            transition: all 0.2s ease;
            flex-shrink: 0;
            /* Prevent buttons from shrinking on wrap */
        }

        .btn-view i,
        .btn-edit i,
        .btn-delete i {
            pointer-events: none;
            /* Prevents icon from blocking button click */
        }

        .btn-view span,
        .btn-edit span,
        .btn-delete span {
            margin-left: 5px;
            /* Space between icon and text on mobile */
        }

        .btn-view {
            background: rgba(107, 209, 227, 0.2);
            color: var(--accent);
            border: none;
        }

        .btn-view:hover {
            background: rgba(107, 209, 227, 0.3);
            box-shadow: 0 0 10px rgba(107, 209, 227, 0.3);
        }

        .btn-edit {
            background: rgba(225, 187, 135, 0.2);
            color: var(--primary);
            border: none;
        }

        .btn-edit:hover {
            background: rgba(225, 187, 135, 0.3);
            box-shadow: 0 0 10px rgba(225, 187, 135, 0.3);
        }

        .btn-delete {
            background: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            border: none;
        }

        .btn-delete:hover {
            background: rgba(255, 107, 107, 0.3);
            box-shadow: 0 0 10px rgba(255, 107, 107, 0.3);
        }

        /* Pagination Styling (Enhance visibility) */
        .pagination .page-item .page-link {
            background: var(--gray);
            color: var(--primary);
            border: 1px solid rgba(225, 187, 135, 0.3);
            border-radius: 8px;
            /* Match table rounded corners */
            margin: 0 3px;
            /* Small gap between buttons */
            transition: all 0.2s ease;
        }

        .pagination .page-item .page-link:hover {
            background: var(--primary);
            color: var(--dark);
            border-color: var(--primary);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary);
            color: var(--dark);
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(225, 187, 135, 0.5);
            /* Highlight active page */
        }

        /* Empty State Styling */
        .empty-state-content {
            padding: 2rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.03);
            /* Lighter background for empty state */
        }

        /* --- Mobile Responsiveness (Media Queries) --- */
        @media (max-width: 767.98px) {

            /* Small devices (phones, 768px and below) */
            .dashboard-header {
                flex-direction: column;
                /* Stack header and button */
                align-items: center;
                text-align: center;
                margin-bottom: 2rem !important;
            }

            .dashboard-section-title {
                font-size: 1.5rem !important;
                /* Smaller title */
                margin-bottom: 1rem;
                /* Space between title and button */
            }

            .btn-booking {
                width: 100%;
                /* Make new offer button full width */
                padding: 0.8rem 1.5rem;
                font-size: 0.9rem;
            }

            .table-offers {
                border-collapse: collapse;
                /* Ensure borders are collapsed */
                border-spacing: 0;
                box-shadow: none;
                /* Remove table shadow on mobile as cards will have them */
                background: transparent;
                /* Make table background transparent */
            }

            .table-offers thead {
                display: none;
                /* Hide table headers on small screens */
            }

            .table-offers tbody tr {
                display: block;
                /* Make table rows behave like blocks (cards) */
                margin-bottom: 1.5rem;
                /* Space between "cards" */
                border-radius: 12px;
                /* Rounded corners for each card */
                background: var(--gray);
                /* Background for each "card" */
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                /* Shadow for each "card" */
                padding: 0;
                /* Remove padding from row */
                border: 1px solid rgba(255, 255, 255, 0.08);
                /* Card border */
            }

            .table-offers tbody td {
                display: flex;
                /* Flexbox for label and value */
                justify-content: space-between;
                align-items: center;
                padding: 12px 18px;
                /* Padding inside each cell */
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                /* Separator between fields */
                font-size: 0.9rem;
            }

            .table-offers tbody tr:last-child td:last-child {
                border-bottom: none;
                /* No border for the last cell of the last row */
            }

            .table-offers tbody td::before {
                content: attr(data-label);
                /* Show the label from data-label attribute */
                font-weight: 600;
                color: var(--primary);
                /* Label color */
                margin-right: 15px;
                /* Space between label and value */
                flex-shrink: 0;
                /* Prevent label from shrinking */
                min-width: 90px;
                /* Give labels a minimum width */
            }

            .table-offers tbody td:first-child {
                flex-direction: column;
                /* Stack image and label */
                align-items: center;
                padding-top: 18px;
                padding-bottom: 18px;
            }

            .table-offers tbody td:first-child::before {
                content: none;
                /* Hide label for image field */
            }

            .offer-image {
                width: 90px;
                /* Larger image on mobile cards */
                height: 90px;
                margin-bottom: 10px;
                /* Space below image */
            }

            .table-offers tbody td:nth-child(2) {
                /* Service Name field */
                flex-direction: column;
                align-items: flex-start;
            }

            .table-offers tbody td:nth-child(2)::before {
                margin-bottom: 5px;
            }

            .badge.bg-category {
                font-size: 0.8em;
                /* Adjusted badge size */
                padding: 4px 8px;
            }

            .table-offers tbody td:last-child {
                /* Actions column */
                border-bottom: none;
                /* No bottom border for last row */
                justify-content: center;
                /* Center actions */
                padding-top: 15px;
                padding-bottom: 15px;
            }

            .table-offers tbody td:last-child::before {
                content: none;
                /* Hide label for actions */
            }

            .action-buttons-group {
                flex-wrap: wrap;
                /* Allow buttons to wrap */
                justify-content: center !important;
                gap: 10px;
                /* Space between buttons */
            }

            .btn-view,
            .btn-edit,
            .btn-delete {
                width: 120px;
                /* Make buttons wider to accommodate text */
                height: auto;
                /* Adjust height based on padding */
                padding: 10px 15px;
                font-size: 0.9rem;
                margin-left: 0;
                /* Remove left margin when stacked */
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {

            /* Tablet specific adjustments */
            .table-offers thead th,
            .table-offers tbody td {
                padding: 12px 15px;
                /* Slightly less padding on tablets */
                font-size: 0.9rem;
            }

            .offer-image {
                width: 50px;
                height: 50px;
            }

            .btn-view,
            .btn-edit,
            .btn-delete {
                width: 35px;
                height: 35px;
                font-size: 0.9em;
            }
        }
    </style>
@endsection
