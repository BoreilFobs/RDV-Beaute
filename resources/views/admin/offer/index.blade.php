@extends('layouts.admin')

@section('content')
    <div class="container-fluid"> {{-- Use container-fluid for full width --}}
        <div class="offers-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-tags me-3"></i> Prestation offert
                </h2>
                <a href="{{ route('offers.create') }}" class="btn btn-booking">
                    <i class="fas fa-plus me-1"></i> Nouvelle Prestation
                </a>
            </div>

            <div class="table-responsive offers-table-wrapper"> {{-- Add a wrapper class for specific styling --}}
                <table class="table table-offers">
                    <thead>
                        <tr>
                            <th class="text-center">Image</th>
                            <th>Nom du Service</th>
                            <th>Category</th>
                            <th>Durée</th>
                            <th>Prix</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($offers as $offer)
                            <tr>
                                <td class="text-center" data-label="Image">
                                    <div class="offer-image"
                                        style="background-image: url('{{ asset('storage/' . $offer->img_path) }}');"></div>
                                </td>
                                <td data-label="Service Name">
                                    <strong>{{ $offer->name }}</strong>
                                </td>
                                <td data-label="Category">
                                    <span class="badge bg-category">{{ App\Models\Category::findOrFail($offer->category_id)->name }}</span>
                                </td>
                                <td data-label="Duration">{{ $offer->duration }} min</td>
                                <td data-label="Price">${{ number_format($offer->cost, 2) }}</td>
                                <td class="text-end" data-label="Actions">
                                    <div class="d-flex flex-wrap justify-content-end action-buttons-group">
                                        <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-sm btn-view"
                                            title="View Details">
                                            <i class="fas fa-eye"></i> <span class="d-md-none">Voir</span>
                                        </a>
                                        <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-sm btn-edit"
                                            title="Edit">
                                            <i class="fas fa-edit"></i> <span class="d-md-none">Metre a jours</span>
                                        </a>
                                        <form action="{{ route('offers.destroy', $offer->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-delete" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this offer?')">
                                                <i class="fas fa-trash-alt"></i> <span class="d-md-none">Supprimer</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <style>
                                .table-offers tbody tr.offer-row {
                                    background: rgba(26, 26, 26, 0.6);
                                    border-left: 3px solid var(--primary);
                                }

                                .table-offers tbody tr.offer-row:hover {
                                    background: rgba(225, 187, 135, 0.1);
                                    transform: translateX(2px);
                                }

                                .table-offers tbody tr.offer-row td {
                                    color: var(--text-light);
                                    background: #000;
                                }

                                /* Make table row and cell content white on black for visibility */
                                .table-offers tbody tr,
                                .table-offers tbody td {
                                    background: #18171c !important;
                                    /* deep black */
                                    color: #fff !important;
                                    /* white text */
                                }

                                .table-offers tbody td strong {
                                    color: #fff !important;
                                }

                                /* Optional: Make header even more distinct */
                                .table-offers thead th {
                                    background: linear-gradient(90deg, #e75480 0%, #e1bb87 60%, #6be39a 100%);
                                    color: #fff !important;
                                    border-bottom: 2px solid #e1bb87;
                                }

                                /* Optional: Add a subtle border to rows for separation */
                                .table-offers tbody tr {
                                    border-bottom: 1px solid rgba(225, 187, 135, 0.15);
                                }

                                /* Adjust badge for better contrast */
                                .badge.bg-category {
                                    background-color: #e75480 !important;
                                    /* pink */
                                    color: #fff !important;
                                }

                                /* Action buttons: keep them vibrant */
                                .btn-view {
                                    background: rgba(107, 209, 227, 0.2);
                                    color: #6be39a !important;
                                }

                                .btn-edit {
                                    background: rgba(225, 187, 135, 0.2);
                                    color: #e1bb87 !important;
                                }

                                .btn-delete {
                                    background: rgba(255, 107, 107, 0.2);
                                    color: #e75480 !important;
                                }
                            </style>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="empty-state-content">
                                        <i class="fas fa-tags fa-3x mb-3" style="color: var(--primary);"></i>
                                        <h4 class="service-title" style="color: var(--primary);">No Service Offers Found
                                        </h4>
                                        <p class="text-dark">Ils semble que vous n'avez pas encore créer de prestation. Cliquer sur le bouton ci-dessus pour en créer un </P>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($offers instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="d-flex justify-content-center mt-4">
                    {{ $offers->links() }}
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
            transition: all 0.2s ease;
            background: var(--dark) !important;
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
