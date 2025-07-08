@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/category/index.css') }}">

    <div class="container-fluid">
        <div class="categories-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-list-alt me-3"></i>Categories de Service
                </h2>
                <a href="{{ route('categories.create') }}" class="btn btn-booking">
                    <i class="fas fa-plus-circle me-2"></i> Créer une nouvelle Category
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
                                <span class="text-muted-custom">Dernier mise a jours: {{ $category->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($categories->isEmpty())
            <div class="empty-state">
                <i class="fas fa-folder-open fa-4x"></i>
                <h3>Aucune category trouvé</h3>
                <p>Créer une category pour vous lancer</p>
                <a href="{{ route('categories.create') }}" class="btn btn-booking mt-3">
                    <i class="fas fa-plus-circle me-2"></i> Créer une Category
                </a>
            </div>
            @endif
        </div>
    </div>
@endsection