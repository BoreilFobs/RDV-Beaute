@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="categories-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-list-alt me-3"></i> Service Categories
                </h2>
                <a href="{{ route('categories.create') }}" class="btn btn-booking">
                    <i class="fas fa-plus-circle me-2"></i> Create New Category
                </a>
            </div>

            <div class="row g-4">
                @foreach($categories as $category)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="category-card">
                        <div class="category-image" style="background-image: url('{{ $category->image_url ?? 'https://via.placeholder.com/800x600' }}');">
                            <div class="category-actions">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-action btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action btn-delete" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="category-body">
                            <h3 class="category-title">{{ $category->name }}</h3>
                            <p class="category-description">{{ Str::limit($category->description, 100) }}</p>
                            <div class="category-meta">
                                <span class="badge bg-primary">{{ $category->services_count }} Services</span>
                                <span class="text-muted-custom">Last updated: {{ $category->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($categories->isEmpty())
            <div class="empty-state">
                <i class="fas fa-folder-open fa-4x"></i>
                <h3>No Categories Found</h3>
                <p>Create your first category to get started</p>
                <a href="{{ route('categories.create') }}" class="btn btn-booking mt-3">
                    <i class="fas fa-plus-circle me-2"></i> Create Category
                </a>
            </div>
            @endif
        </div>
    </div>

    <style>
        /* Category Cards */
        .category-card {
            background-color: var(--gray);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .category-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: flex-end;
        }

        .category-actions {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            gap: 0.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .category-card:hover .category-actions {
            opacity: 1;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-edit {
            background-color: rgba(74, 144, 226, 0.9);
        }

        .btn-delete {
            background-color: rgba(226, 74, 74, 0.9);
        }

        .btn-action:hover {
            transform: scale(1.1);
        }

        .category-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .category-title {
            color: var(--text-light);
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .category-description {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .category-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background-color: var(--gray);
            border-radius: 1rem;
            border: 1px dashed rgba(255, 255, 255, 0.1);
        }

        .empty-state i {
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .category-image {
                height: 160px;
            }
            
            .category-actions {
                opacity: 1; /* Always show on mobile */
            }
            
            .category-body {
                padding: 1rem;
            }
            
            .category-title {
                font-size: 1.1rem;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .category-image {
                height: 180px;
            }
        }
    </style>
@endsection