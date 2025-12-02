@extends('admin.index')
@section('content')
    <h1 class="p-4">Gallery</h1>
    <div class="row p-4 mb-4">
        @foreach($images as $image)
            <div class="col-sm-3 col-md-4 image-container cursor-pointer" onclick="selectImage(this, {{ $image->id }})" >
                <img src="{{ asset('storage/'.$image->image) }}" alt="" class="w-100 object-fit-cover" height="300" weidth="300">
                <h6 class="mt-3 text-center">{{ $image->image_title }}</h6>
            </div>
        @endforeach
    </div>
    <div class="text-center">
        <button class="btn btn-danger m-4" style="width:30%;" onclick="deleteImage()">Delete Selected</button>
    </div>
    <form method="POST" action="{{ route('store_gallery') }}" enctype="multipart/form-data"  class="bg-dark p-4">
        @csrf
        <input type="file" class=" bg-dark text-light border-0  mb-2" name="image" accept="image/*"/>
        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-success mb-2 text-uppercase w-100" style="background-color: green; border-color: green;" type="submit">Add Image</button>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control bg-dark text-light border-secondary" name="image_title" placeholder="Add a title">
            </div>
        </div>
    </form>
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
  .image-container.selected {
    opacity: 1;
    border: 3px solid #28a745;
  }
</style>
@endpush
@push('scripts')
<script>
let selectedImageId = null;

// Remove selected class from all
 // Add selected class to clicked
function selectImage(element, id) {
    document.querySelectorAll('.image-container').forEach(img => {
        img.classList.remove('selected');
    });
    
   
    element.classList.add('selected');
    selectedImageId = id;
}

function deleteImage() {
    if (!selectedImageId) {
        alert('Select an image first');
        return;
    }
    
    if (!confirm('Delete this image?')) return;
    
    fetch(`/gallery/${selectedImageId}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(() => location.reload());
}
</script>
@endpush