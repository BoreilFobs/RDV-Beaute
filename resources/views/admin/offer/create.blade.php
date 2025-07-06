@extends('layouts.admin') {{-- Ensure this extends your admin layout file --}}

@section('content')
    <div class="container-fluid">
        <div class="offers-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-plus-circle me-3"></i> creer une Prestation
                </h2>
                <a href="{{ route('offers.index') }}" class="btn btn-booking">
                    <i class="fas fa-arrow-left me-1"></i> re
                </a>
            </div>

            <div class="form-card-wrapper p-4 p-md-5"> {{-- Added padding for better spacing --}}
                <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4"> {{-- Bootstrap 5 gutter classes for spacing --}}
                        {{-- Offer Name --}}
                        <div class="col-12 col-md-6">
                            <label for="name" class="form-label-custom mb-2">Nom de la prestation<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control-custom @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="col-12 col-md-6">
                            <label for="category" class="form-label-custom mb-2">Category <span
                                    class="text-danger">*</span></label>
                            <select class="form-select-custom @error('category') is-invalid @enderror" id="category"
                                name="category_id" required>
                                <option value="">Choisir la Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category') == $category->name ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Duration --}}
                        <div class="col-12 col-md-6">
                            <label for="duration" class="form-label-custom mb-2">Durée (minutes) <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control-custom @error('duration') is-invalid @enderror"
                                id="duration" name="duration" value="{{ old('duration') }}" min="5" required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="col-12 col-md-6">
                            <label for="cost" class="form-label-custom mb-2">Prix (FCFA) <span
                                    class="text-danger">*</span></label>
                            <input type="number" step="0.01"
                                class="form-control-custom @error('cost') is-invalid @enderror" id="cost"
                                name="cost" value="{{ old('cost') }}" min="0" required>
                            @error('cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label for="description" class="form-label-custom mb-2">Description</label>
                            <textarea class="form-control-custom @error('description') is-invalid @enderror" id="description" name="description"
                                rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Image Upload --}}
                        <div class="col-12">
                            <label for="img_path" class="form-label-custom mb-2">Image de la prestation</label>
                            <input type="file" class="form-control-file-custom @error('img_path') is-invalid @enderror"
                                id="img_path" name="img_path" accept="image/*">
                            <small class="form-text text-muted-custom mt-2">Televérser une image pour cette prestation (e.g., JPG,
                                PNG).</small>
                            @error('img_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-booking btn-lg">
                                <i class="fas fa-save me-2"></i> Enregistrer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        /* --- Form Specific Styles --- */
        .form-card-wrapper {
            background-color: var(--gray);
            /* Background for the form container */
            border-radius: 1rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 2.5rem;
            /* Increased padding for more whitespace */
        }

        .form-label-custom {
            color: var(--text-light);
            /* Light color for labels */
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
            /* Ensure labels take full width */
            font-size: 1rem;
        }

        .form-control-custom,
        .form-select-custom,
        .form-file-custom {
            background-color: var(--dark);
            /* Dark background for inputs */
            border: 1px solid rgba(255, 255, 255, 0.15);
            /* Subtle border */
            color: var(--text-light);
            /* Light text color */
            padding: 0.75rem 1.25rem;
            /* Ample padding */
            border-radius: 0.75rem;
            /* Rounded corners */
            transition: all 0.2s ease-in-out;
            width: 100%;
            /* Ensure full width */
        }

        .form-control-custom:focus,
        .form-select-custom:focus,
        .form-file-custom:focus {
            background-color: var(--dark);
            border-color: var(--primary);
            /* Accent border on focus */
            box-shadow: 0 0 0 0.25rem rgba(225, 187, 135, 0.25);
            /* Glow effect on focus */
            color: var(--text-light);
            outline: 0;
            /* Remove default outline */
        }

        .form-control-custom::placeholder {
            color: var(--text-muted);
            /* Muted placeholder text */
            opacity: 0.7;
        }

        /* Specific styling for select dropdown */
        .form-select-custom {
            appearance: none;
            /* Remove default arrow */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23E1BB87' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            /* Custom arrow */
            background-repeat: no-repeat;
            background-position: right 1.25rem center;
            background-size: 0.65em 0.65em;
        }

        /* Styling for file input (mimics a button/input) */
        .form-control-file-custom {
            display: block;
            width: 100%;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--text-light);
            background-color: var(--dark);
            background-clip: padding-box;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 0.75rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            cursor: pointer;
        }

        .form-control-file-custom::-webkit-file-upload-button {
            background-color: var(--primary);
            color: var(--dark);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            margin-right: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .form-control-file-custom::-webkit-file-upload-button:hover {
            background-color: var(--accent);
        }

        .form-control-file-custom::file-selector-button {
            /* Standard property */
            background-color: var(--primary);
            color: var(--dark);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            margin-right: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .form-control-file-custom::file-selector-button:hover {
            background-color: var(--accent);
        }

        .text-muted-custom {
            color: var(--text-muted) !important;
            font-size: 0.875rem;
        }

        /* Validation Feedback */
        .form-control-custom.is-invalid,
        .form-select-custom.is-invalid,
        .form-file-custom.is-invalid {
            border-color: #dc3545;
            /* Red border for invalid fields */
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .invalid-feedback {
            color: #dc3545;
            /* Red text for error messages */
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        /* --- Responsive Adjustments --- */
        @media (max-width: 767.98px) {

            /* Mobile */
            .form-card-wrapper {
                padding: 1.5rem;
                /* Less padding on small screens */
            }

            .dashboard-section-title {
                font-size: 1.5rem !important;
                text-align: center;
                margin-bottom: 1.5rem;
            }

            .btn-booking {
                width: 100%;
                /* Full width buttons on mobile */
                font-size: 1rem;
                padding: 0.75rem 1.5rem;
            }

            .form-label-custom {
                font-size: 0.9rem;
            }

            .form-control-custom,
            .form-select-custom,
            .form-file-custom {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .form-control-file-custom::-webkit-file-upload-button,
            .form-control-file-custom::file-selector-button {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
                margin-right: 0.8rem;
            }

            .text-muted-custom {
                font-size: 0.8rem;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {

            /* Tablet */
            .form-card-wrapper {
                padding: 2rem;
            }

            .dashboard-section-title {
                font-size: 1.8rem !important;
            }
        }
    </style>
@endsection
