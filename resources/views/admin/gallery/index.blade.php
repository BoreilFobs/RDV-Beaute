@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/gallery/index.css') }}">

    <div class="container-fluid">
        <div class="gallery-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-images me-3"></i> Media Gallery ({{ $images->count() }})
                </h2>
                <a href="{{ route('gallery.create') }}" class="btn btn-booking">
                    <i class="fas fa-plus-circle me-2"></i> Upload New
                </a>
            </div>

            <div class="form-card-wrapper p-4">
                @if($images->isEmpty())
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-images fa-4x mb-4" style="color: var(--primary);"></i>
                        <h3>No Media Items Found</h3>
                        <p class="text-muted-custom">Upload your first image or video to get started</p>
                        <a href="{{ route('gallery.create') }}" class="btn btn-booking mt-3">
                            <i class="fas fa-plus-circle me-2"></i> Upload Media
                        </a>
                    </div>
                @else
                    <div class="gallery-grid">
                        @foreach($images as $image)
                        <div class="gallery-item">
                            <img src="{{ $image->img_url }}" alt="gallery image" class="img-fluid">
                            <form action="{{ route('gallery.destroy', $image->id) }}" method="POST" class="delete-form" style="position:absolute;top:10px;right:10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this item?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $images instanceof \Illuminate\Pagination\LengthAwarePaginator ? $images->links() : '' }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection