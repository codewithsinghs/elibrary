@extends('layouts.app')
@section('headerTitle', 'Create Resource')
@section('main-content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Resource</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @include('layouts.sessions')
                                <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name"
                                                class="form-control  @error('name') is-invalid @enderror"
                                                placeholder="Resource Name" value="{{ old('name') }}" >
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Caption</label>
                                            <input type="text" name="caption"
                                                class="form-control @error('caption') is-invalid @enderror"
                                                placeholder="Caption" value="{{ old('caption') }}">
                                            @error('caption')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Category</label>
                                            <input type="text" name="category"
                                                class="form-control @error('category') is-invalid @enderror"
                                                placeholder="Category Name" value="{{ old('category') }}">
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Author</label>
                                            <input type="text" name="author"
                                                class="form-control @error('author') is-invalid @enderror"
                                                placeholder="Author Name" value="{{ old('author') }}">
                                            @error('author')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3 col-md-6 ">
                                            <label class="form-label">URL</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-0">https://example.com</span>
                                                <input type="text" name="url"
                                                    class="form-control @error('url') is-invalid @enderror"
                                                    value="{{ old('url') }}">
                                                @error('url')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="published_at" class="form-label">Published At</label>
                                            <input type="date"
                                                class="form-control @error('published_at') is-invalid @enderror"
                                                id="published_at" name="published_at" value="{{ old('published_at') }}">
                                            @error('published_at')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="description" class="form-label">Description</label>

                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="4">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            {{-- <label class="form-label">Image</label>
                                            <input type="file" class="form-control" name="image">
                                            <img id="imagePreview" src="#" alt="Preview"
                                                style="display: none; max-width: 100%; height: auto;"> --}}
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image"
                                               >

                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>


                                    <button type="submit" class="btn btn-primary">Add Resource</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- @section('script')
    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection --}}
