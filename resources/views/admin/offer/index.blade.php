@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/offer/index.css') }}">

    <div class="container-fluid"> {{-- Use container-fluid for full width --}}
        <div class="offers-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-tags me-3"></i> Prestation offert ({{ $offers->count() }})
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
@endsection
