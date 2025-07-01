@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="gallery-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-plus-circle me-3"></i> Upload Image
                </h2>
                <a href="{{ route('gallery.index') }}" class="btn btn-booking">
                    <i class="fas fa-arrow-left me-2"></i> Back to Gallery
                </a>
            </div>

            <div class="form-card-wrapper p-4 p-md-5">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <!-- Dropzone Area -->
                            <div class="dropzone" id="imageDropzone">
                                <div class="dropzone-content">
                                    <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                                    <h4>Drag & Drop your image here</h4>
                                    <p class="text-muted-custom">or click to browse files</p>
                                    <input type="file" name="image" id="imageInput" accept="image/*" class="d-none">
                                    <button type="button" class="btn btn-booking mt-3" id="browseBtn">
                                        <i class="fas fa-folder-open me-2"></i> Select Image
                                    </button>
                                </div>
                                <div class="preview-container mt-4" id="previewContainer" style="display: none;">
                                    <div class="image-preview-wrapper">
                                        <img id="imagePreview" class="img-thumbnail" src="#" alt="Preview">
                                        <button type="button" class="btn-action btn-delete" id="removeImage">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="file-info mt-2">
                                        <span id="fileName"></span>
                                        <span id="fileSize" class="text-muted-custom"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-booking btn-lg" id="submitBtn" disabled>
                                <i class="fas fa-upload me-2"></i> Upload Image
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Dropzone Styling */
        .dropzone {
            border: 2px dashed rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            background-color: var(--dark);
            cursor: pointer;
        }

        .dropzone:hover {
            border-color: var(--primary);
            background-color: rgba(225, 187, 135, 0.05);
        }

        .dropzone-content {
            color: var(--text-light);
        }

        .dropzone-content i {
            color: var(--primary);
        }

        /* Preview Styling */
        .preview-container {
            text-align: center;
        }

        .image-preview-wrapper {
            position: relative;
            display: inline-block;
            max-width: 100%;
        }

        #imagePreview {
            max-height: 300px;
            max-width: 100%;
            border-radius: 0.75rem;
            display: block;
            margin: 0 auto;
        }

        #removeImage {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        #removeImage:hover {
            background-color: rgba(220, 53, 69, 1);
        }

        .file-info {
            font-size: 0.9rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .dropzone {
                padding: 2rem 1rem;
            }
            
            .dropzone-content h4 {
                font-size: 1.1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropzone = document.getElementById('imageDropzone');
            const imageInput = document.getElementById('imageInput');
            const previewContainer = document.getElementById('previewContainer');
            const imagePreview = document.getElementById('imagePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const removeImage = document.getElementById('removeImage');
            const browseBtn = document.getElementById('browseBtn');
            const submitBtn = document.getElementById('submitBtn');
            const uploadForm = document.getElementById('uploadForm');

            // Handle file selection via button
            browseBtn.addEventListener('click', () => imageInput.click());

            // Handle file selection via dropzone click
            dropzone.addEventListener('click', (e) => {
                if (e.target === dropzone || e.target === dropzone.querySelector('h4') || 
                    e.target === dropzone.querySelector('p')) {
                    imageInput.click();
                }
            });

            // Handle drag and drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropzone.classList.add('highlight');
            }

            function unhighlight() {
                dropzone.classList.remove('highlight');
            }

            // Handle file drop
            dropzone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length) {
                    handleFiles(files);
                }
            }

            // Handle file input change
            imageInput.addEventListener('change', function() {
                if (this.files.length) {
                    handleFiles(this.files);
                }
            });

            // Process selected files
            function handleFiles(files) {
                const file = files[0];
                if (!file.type.match('image.*')) {
                    alert('Please select an image file (JPEG, PNG, etc.)');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);
                    previewContainer.style.display = 'block';
                    submitBtn.disabled = false;
                }
                reader.readAsDataURL(file);
            }

            // Remove image
            removeImage.addEventListener('click', function() {
                imageInput.value = '';
                previewContainer.style.display = 'none';
                submitBtn.disabled = true;
            });

            // Format file size
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return ' (' + parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i] + ')';
            }
        });
    </script>
@endsection