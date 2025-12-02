@extends('admin.index')
@section('content')
<div class="col-md-8 offset-2">
    <h1 class="mt-2">Create Room</h1>
    <form method="POST" action="{{ route('storeRoom') }}" enctype="multipart/form-data"  class="bg-dark p-4">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label text-light">Room Title</label>
            @error('title')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control bg-dark text-light border-secondary" autofill="title" name="title" value="{{ old('title') }}">
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label text-light">Details</label>
            @error('description')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <textarea class="form-control bg-dark text-light border-secondary" name="description" rows="3" 
            autofill="description">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="rent" class="form-label text-light">Room rent</label>
            @error('rent')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control bg-dark text-light border-secondary" autofill="rent" 
                name="rent" placeholder="Price">
        </div>

        <div class="row">
        <div class="col-md-4">        
        <div class="mb-3">
            <label for="select" class="form-label text-light">Select Type</label>
            @error('type')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <select class="form-select bg-dark text-light border-secondary" name="type">
            <option value="suite" selected>Suite</option>
            <option value="single">Single</option>
            <option value="double">Double</option>
            </select>
        </div>
        
        <div class="mb-3 form-check">
            <input type="hidden" name="facility" value="no">
            <input type="checkbox" class="form-check-input bg-dark border-secondary" value="yes" id="facility" name="facility"
                {{ old('facility') == 'yes' ? 'checked' : '' }} >
            <label class="form-check-label text-light" for="facility">
            Wifi availability
            </label>
            @error('facility')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        </div>

        <div class="mb-3 col-md-8">
            <label for="image" class="form-label text-light">Upload Image</label>
            <input type="file" class="form-control bg-dark text-light border-0"  style="color: transparent;" 
                name="image" accept="image/*" />
            <div class="form-text text-muted">Upload a JPG, PNG, or GIF image.</div>
            @error('image')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
</style>
@endpush