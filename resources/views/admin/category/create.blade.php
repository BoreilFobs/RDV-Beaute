@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/category/form.css') }}">

    <div class="container-fluid">
        <div class="categories-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-plus-circle me-3"></i> Créer une nouvelle Category
                </h2>
                <a href="{{ route('categories.index') }}" class="btn btn-booking">
                    <i class="fas fa-arrow-left me-2"></i> Retour au Categories
                </a>
            </div>

            <div class="form-card-wrapper p-4 p-md-5">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <!-- Category Name -->
                        <div class="col-12 col-md-6">
                            <label for="name" class="form-label-custom mb-2">Nom de la Category <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-custom @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload with Preview -->
                        <div class="col-12 col-md-6">
                            <label for="image" class="form-label-custom mb-2">Image de la Category</label>
                            <div class="image-upload-wrapper">
                                <input type="file" class="form-control-file-custom @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*" onchange="previewImage(this)">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                <div class="image-preview mt-3" id="imagePreview">
                                    {{-- <img src="https://via.placeholder.com/800x600?text=Upload+Image" 
                                         alt="Image Preview" class="img-thumbnail" id="previewImage">
                                    <div class="image-preview-text">No image selected</div>
                                </div> --}}
                            </div>
                        </div>

                        {{-- <!-- Description -->
                        <div class="col-12">
                            <label for="description" class="form-label-custom mb-2">Description</label>
                            <textarea class="form-control-custom @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <!-- Submit Button -->
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-booking btn-lg">
                                <i class="fas fa-save me-2"></i> Créer la Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('previewImage');
            const previewText = document.querySelector('.image-preview-text');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    previewText.style.display = 'none';
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "https://via.placeholder.com/800x600?text=Upload+Image";
                previewText.style.display = 'block';
            }
        }
    </script>
@endsection