@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="gallery-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-images me-3"></i> Media Gallery
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

    <style>
        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(550px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            position: relative;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            /* Remove aspect-ratio to allow natural image size */
            /* aspect-ratio: 1/1; */
            background: #181818;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            object-fit: contain; /* Show the whole image, not cropped */
            display: block;
            border-radius: 0.5rem;
            background: #222;
            max-height: 400px; /* Optional: limit max height for very tall images */
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* Video Thumbnail */
        .video-thumbnail {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .video-thumbnail i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            color: rgba(255, 255, 255, 0.8);
            z-index: 1;
        }

        /* Overlay */
        .gallery-item-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-item-overlay {
            opacity: 1;
        }

        .gallery-item-info {
            color: white;
        }

        .media-name {
            display: block;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .media-type {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--primary);
        }

        /* Delete Button */
        .delete-form {
            position: relative;
            z-index: 2;
        }

        .btn-action.btn-delete {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            transition: all 0.2s ease;
            opacity: 0;
        }

        .gallery-item:hover .btn-delete {
            opacity: 1;
        }

        .btn-action.btn-delete:hover {
            transform: scale(1.1);
            background-color: rgba(220, 53, 69, 1);
        }

        /* Empty State */
        .empty-state {
            background-color: var(--gray);
            border-radius: 1rem;
            padding: 2rem;
            border: 1px dashed rgba(255, 255, 255, 0.1);
        }

        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 1rem;
            }
            
            .gallery-item-overlay {
                opacity: 1; /* Always show on mobile */
                padding: 0.75rem;
            }
            
            .btn-action.btn-delete {
                opacity: 1; /* Always show on mobile */
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }
        }
    </style>
@endsection