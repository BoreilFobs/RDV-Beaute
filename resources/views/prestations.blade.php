@extends('layouts.navigation')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/prestation.css') }}">

    <!-- Add Poppins font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="service-section">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header">
                <h1 class="section-title">Services Premium</h1>
                <p class="section-subtitle">Experience de qualite dans notre gardin</p>
            </div>

            <!-- Filter Controls -->
            <div class="filter-controls">
                <button class="filter-btn active" data-category="all">Tout les Services</button>
                @foreach($categories as $category)
                    <button class="filter-btn" data-category="{{ $category->id }}">{{ $category->name }}</button>
                @endforeach
            </div>

            <!-- Services Grid -->
            <div class="row  g-4">
                <!-- Service 1 -->
                @if($offers->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert" style="background:rgba(225,187,135,0.1);color:var(--primary);border:none;">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Aucune prestation disponible pour le moment. Revebez plus tard!
                        </div>
                    </div>
                @endif
                @foreach($offers as $offer)
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4 service-item" data-category="{{ $offer->category_id }}">
                        <div class="service-card">
                            <div class="service-image-container">
                                @if(!empty($offer->img_path))
                                    <img src="{{ asset('storage/' . $offer->img_path)}}" class="service-image" alt="{{ $offer->title ?? 'Service Image' }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9" class="service-image" alt="{{ $offer->title ?? 'Service Image' }}">
                                @endif
                                @if(!empty($offer->category_id))
                                    <span class="service-badge">{{ App\Models\Category::findOrFail($offer->category_id)->name }}</span>
                                @endif
                            </div>
                            <div class="service-content">
                                <h3 class="service-title">{{ $offer->name }}</h3>
                                <div class="service-meta">
                                    <span class="service-meta-item"><i class="fas fa-clock"></i> {{ $offer->duration ?? 'N/A' }}min</span>
                                    <span class="service-meta-item"><i class="fas fa-user-tie"></i> </span>
                                </div>
                                <div class="service-price">{{ $offer->cost ?? '0' }} FCFA</div>
                                <p class="service-description">{{ $offer->description }}</p>
                                <div class="action-buttons">
                                    <a href="{{ url('/appointments/create', ['offer' => $offer->id]) }}" class="btn btn-primary-accent">
                                        <i class="fas fa-calendar-plus me-2"></i> Prendre Rendez-vous
                                    </a>
                                    {{-- <button class="btn btn-outline-accent">
                                        <i class="fa-solid fa-heart me-2"></i> Save
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // Helper to get query param
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        // Filter functionality
        function filterByCategory(categoryId) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
                if (
                    (categoryId === 'all' && btn.getAttribute('data-category') === 'all') ||
                    btn.getAttribute('data-category') === categoryId
                ) {
                    btn.classList.add('active');
                }
            });
            document.querySelectorAll('.service-item').forEach(card => {
                if (categoryId === 'all' || card.getAttribute('data-category') === categoryId) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // On page load, check for ?category= in URL
        document.addEventListener('DOMContentLoaded', function() {
            let cat = getQueryParam('category');
            if (cat && cat !== 'all') {
                filterByCategory(cat);
            }

            // Filter button click
            document.querySelectorAll('.filter-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    filterByCategory(category);

                    // Update URL without reloading
                    const url = new URL(window.location);
                    if (category === 'all') {
                        url.searchParams.delete('category');
                    } else {
                        url.searchParams.set('category', category);
                    }
                    window.history.replaceState({}, '', url);
                });
            });
        });
    </script>
@endsection
