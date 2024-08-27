@extends('layouts.app')
@section('headerTitle', 'Edit Resource')
@section('main-content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Content</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @include('layouts.sessions')
                                <form action="{{ route('resources.update', $resource->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name"
                                                class="form-control  @error('name') is-invalid @enderror"
                                                placeholder="Resource Name" value="{{ old('name', $resource->name) }}"
                                                autocomplete="name" autofocus>
                                            @error('name')
                                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Caption</label>
                                            <input type="text" name="caption"
                                                class="form-control @error('caption') is-invalid @enderror"
                                                placeholder="Caption" value="{{ old('caption', $resource->caption) }}">
                                            @error('caption')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Category</label>
                                            <input type="text" name="category"
                                                class="form-control @error('category') is-invalid @enderror"
                                                placeholder="Category Name"
                                                value="{{ old('category', $resource->category) }}">
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Author</label>
                                            <input type="text" name="author"
                                                class="form-control @error('author') is-invalid @enderror"
                                                placeholder="Author Name" value="{{ old('author', $resource->author) }}">
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
                                                    value="{{ old('url', $resource->url) }}">
                                                @error('url')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="published_at" class="form-label">Published At</label>
                                            <input type="date"
                                                class="form-control @error('published_at') is-invalid @enderror"
                                                id="published_at" name="published_at"
                                                value="{{ old('published_at', $resource->published_at) }}">
                                            @error('published_at')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="description" class="form-label">Description</label>

                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="4">{{ old('description', $resource->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">

                                            <label for="image" class="form-label">image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            @if ($resource->image)
                                                <img src="{{ asset('storage/resources/' . (Storage::disk('public')->exists('resources/thumbnails/' . $resource->image) ? 'thumbnails/' . $resource->image : $resource->image)) }}"
                                                    alt="Thumbnail">
                                                <input type="checkbox" name="remove_image" id="remove_image">
                                                <label for="remove_image">Remove image</label>
                                            @endif

                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary">Update Resource</button>
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
