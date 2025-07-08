@extends('layouts.admin') {{-- Ensure this extends your admin layout file --}}

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/offer/form.css') }}">

    <div class="container-fluid">
        <div class="offers-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-plus-circle me-3"></i> creer une Prestation
                </h2>
                <a href="{{ route('offers.index') }}" class="btn btn-booking">
                    <i class="fas fa-arrow-left me-1"></i> retour au prestation
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
@endsection
