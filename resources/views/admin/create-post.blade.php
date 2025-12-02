@extends('admin.index')
@section('content')
<div class="col-md-8 offset-2">
    <div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">x</button>
            </div>
        @endif
      <div class="card bg-dark text-white border-secondary">
        <div class="card-header bg-dark border-secondary">
          <h3 class="mb-0">Write New Post</h3>
        </div>
        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Post Title -->
            <div class="mb-4">
              <label for="title" class="form-label">Post Title</label>
              <input type="text" 
                     class="form-control bg-dark text-white border-secondary" 
                     id="title" 
                     name="title" 
                     placeholder="Enter post title"
                     required>
            </div>
            
            <!-- Post Slug -->
            <div class="mb-4">
              <label for="slug" class="form-label">Slug (URL)</label>
              <input type="text" 
                     class="form-control bg-dark text-white border-secondary" 
                     id="slug" 
                     name="slug" 
                     placeholder="post-url-slug">
              <small class="text-muted">Leave empty to auto-generate from title</small>
            </div>
            
            <!-- Featured Image -->
            <div class="mb-4">
              <label for="image" class="form-label">Featured Image</label>
              <input type="file" 
                     class="form-control bg-dark text-white border-0" 
                     id="image" 
                     name="image" 
                     accept="image/*">
              <small class="text-muted">Recommended size: 1200x630px</small>
            </div>
            
            <!-- Image Preview -->
            <div class="mb-4" id="imagePreview" style="display: none;">
              <img src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
            </div>
            
            <!-- Post Excerpt -->
            <div class="mb-4">
              <label for="excerpt" class="form-label">Excerpt</label>
              <textarea class="form-control bg-dark text-white border-secondary" 
                        id="excerpt" 
                        name="excerpt" 
                        rows="3" 
                        placeholder="Short description for the post preview"></textarea>
            </div>
            
            <!-- Post Content -->
            <div class="mb-4">
              <label for="content" class="form-label">Content</label>
              <textarea class="form-control bg-dark text-white border-secondary" 
                        id="content" 
                        name="content" 
                        rows="12" 
                        placeholder="Write your post content here..."
                        required></textarea>
            </div>
            
            <div class="row">
              <!-- Category -->
              <!-- <div class="col-md-6 mb-4">
                <label for="category" class="form-label">Category</label>
                <select class="form-select bg-dark text-white border-secondary" 
                        id="category" 
                        name="category_id">
                  <option value="">Select Category</option>
                  <option value="1">Hotel News</option>
                  <option value="2">Travel Tips</option>
                  <option value="3">Guest Stories</option>
                  <option value="4">Amenities</option>
                  <option value="5">Local Attractions</option>
                </select>
              </div> -->
              
              <!-- Status -->
              <div class="col-md-6 mb-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select bg-dark text-white border-secondary" 
                        id="status" 
                        name="status">
                  <option value="draft">Draft</option>
                  <option value="published">Published</option>
                  <option value="scheduled">Scheduled</option>
                </select>
              </div>
            </div>
            
            <div class="row">
              <!-- Author -->
              <div class="col-md-6 mb-4">
                <label for="author" class="form-label">Author Name</label>
                <input type="text" 
                       class="form-control bg-dark text-white border-secondary" 
                       id="author" 
                       name="author" 
                       placeholder="Author name"
                       value="{{ auth()->user()->name ?? '' }}">
              </div>
              
              <!-- Publish Date -->
              <!-- <div class="col-md-6 mb-4">
                <label for="publish_date" class="form-label">Publish Date</label>
                <input type="datetime-local" 
                       class="form-control bg-dark text-white border-secondary" 
                       id="publish_date" 
                       name="publish_date">
              </div> -->
            </div>
            
            <!-- Meta Tags -->
            <!-- <div class="mb-4">
              <label for="tags" class="form-label">Tags</label>
              <input type="text" 
                     class="form-control bg-dark text-white border-secondary" 
                     id="tags" 
                     name="tags" 
                     placeholder="luxury, hotel, travel (comma separated)">
            </div> -->
            
            <!-- SEO Section -->
            <!-- <div class="card bg-dark border-secondary mb-4">
              <div class="card-header bg-dark border-secondary">
                <h5 class="mb-0">SEO Settings</h5>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="meta_title" class="form-label">Meta Title</label>
                  <input type="text" 
                         class="form-control bg-dark text-white border-secondary" 
                         id="meta_title" 
                         name="meta_title" 
                         placeholder="SEO title">
                </div>
                <div class="mb-3">
                  <label for="meta_description" class="form-label">Meta Description</label>
                  <textarea class="form-control bg-dark text-white border-secondary" 
                            id="meta_description" 
                            name="meta_description" 
                            rows="2" 
                            placeholder="SEO description"></textarea>
                </div>
              </div>
            </div> -->
            
            <!-- Action Buttons -->
            <div class="d-flex gap-2 justify-content-end">
              <button type="submit" name="action" value="draft" class="btn btn-outline-light">Publish</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection


@push('styles')
<style>
/* Your dark mode file input styles */
input[type="file"]::file-selector-button {
background-color: #6c757d;
color: white;
border: none;
padding: 0.375rem 0.75rem;
border-radius: 0.25rem;
cursor: pointer;
}
/* Dark theme form styling */
.form-control:focus,
.form-select:focus {
  background-color: #212529;
  border-color: #6c757d;
  color: #fff;
  box-shadow: 0 0 0 0.25rem rgba(108, 117, 125, 0.25);
}

.form-control::placeholder {
  color: #6c757d;
}

.form-select option {
  background-color: #212529;
}
</style>
@endpush
@push('scripts')
<script>
// Image Preview
document.getElementById('image').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = document.getElementById('imagePreview');
      preview.querySelector('img').src = e.target.result;
      preview.style.display = 'block';
    }
    reader.readAsDataURL(file);
  }
});

// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function(e) {
  const slug = e.target.value
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/(^-|-$)/g, '');
  document.getElementById('slug').value = slug;
});
</script>
@endpush