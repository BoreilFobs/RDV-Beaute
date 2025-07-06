@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="products-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-plus-circle me-3"></i> {{ isset($product) ? 'Mise a jours' : 'crée' }} produit
                </h2>
                <a href="{{ route('stock.index') }}" class="btn btn-booking">
                    <i class="fas fa-arrow-left me-2"></i> Retours a produit
                </a>
            </div>

            <div class="form-card-wrapper p-4 p-md-5">
                <form action="{{ isset($product) ? route('stock.update', $product->id) : route('stock.store') }}" method="POST">
                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif

                    <div class="row g-4">
                        <!-- Product Name -->
                        <div class="col-12">
                            <label for="name" class="form-label-custom mb-2">Nom du Produit <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-custom @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="col-12 col-md-6">
                            <label for="quantity" class="form-label-custom mb-2">Quantité <span class="text-danger">*</span></label>
                            <input type="number" class="form-control-custom @error('quantity') is-invalid @enderror" 
                                   id="quantity" name="quantity" value="{{ old('quantity', $product->quantity ?? '') }}" min="0" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Usage Type -->
                        <div class="col-12 col-md-6">
                            <label for="usage_type" class="form-label-custom mb-2">Type d'usage <span class="text-danger">*</span></label>
                            <select class="form-select-custom @error('usage_type') is-invalid @enderror" 
                                    id="usage_type" name="usage_type" required>
                                <option value="">Selectioner un Type d'usage</option>
                                <option value="sale" {{ old('usage_type', $product->usage_type ?? '') == 'sale' ? 'selected' : '' }}>A vendre</option>
                                <option value="processing" {{ old('usage_type', $product->usage_type ?? '') == 'processing' ? 'selected' : '' }}>Pour prestation</option>
                            </select>
                            @error('usage_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Unit Price (Conditional) -->
                        <div class="col-12 col-md-6" id="unit_price_container">
                            <label for="unit_price" class="form-label-custom mb-2">Prix unitaire (FCFA) <span class="text-danger" id="price_required">*</span></label>
                            <input type="number" 
                                   class="form-control-custom @error('unit_price') is-invalid @enderror" 
                                   id="unit_price" name="unit_price" 
                                   value="{{ old('unit_price', isset($product->unit_price) ? $product->unit_price / 100 : '') }}"
                                   min="0">
                            @error('unit_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted-custom mt-2">Requis pour Produit a vendre</small>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-booking btn-lg">
                                <i class="fas fa-save me-2"></i> {{ isset($product) ? 'metre a jours' : 'Créer' }} Le Produit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Conditional Field Styling */
        #unit_price_container.hidden {
            display: none;
        }
        
        #unit_price_container.disabled {
            opacity: 0.6;
            pointer-events: none;
        }
        
        /* Form Specific Styles (consistent with previous forms) */
        .form-card-wrapper {
            background-color: var(--gray);
            border-radius: 1rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        
        .form-label-custom {
            color: var(--text-light);
            font-weight: 500;
            display: block;
        }
        
        .form-control-custom,
        .form-select-custom {
            background-color: var(--dark);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: var(--text-light);
            padding: 0.75rem 1.25rem;
            border-radius: 0.75rem;
            transition: all 0.2s ease-in-out;
            width: 100%;
        }
        
        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .form-card-wrapper {
                padding: 1.5rem !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const usageTypeSelect = document.getElementById('usage_type');
            const unitPriceContainer = document.getElementById('unit_price_container');
            const unitPriceInput = document.getElementById('unit_price');
            const priceRequired = document.getElementById('price_required');
            
            function togglePriceField() {
                if (usageTypeSelect.value === 'sale') {
                    unitPriceContainer.classList.remove('hidden', 'disabled');
                    unitPriceInput.required = true;
                    priceRequired.style.display = 'inline';
                } else {
                    unitPriceContainer.classList.add('disabled');
                    unitPriceInput.required = false;
                    priceRequired.style.display = 'none';
                    unitPriceInput.value = '';
                }
            }
            
            // Initialize on load
            togglePriceField();
            
            // Add event listener for changes
            usageTypeSelect.addEventListener('change', togglePriceField);
        });
    </script>
@endsection