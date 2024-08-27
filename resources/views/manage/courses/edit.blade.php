@extends('layouts.app')
@section('headerTitle', 'Edit Course')
@section('main-content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Course -> <b>{{ $course->name }} </b></h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @include('layouts.sessions')
                                <form action="{{ route('courses.update', $course->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name"
                                                class="form-control  @error('name') is-invalid @enderror"
                                                placeholder="Resource Name" value="{{ old('name', $course->name) }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Category</label>
                                            <input type="text" name="category"
                                                class="form-control @error('category') is-invalid @enderror"
                                                placeholder="category" value="{{ old('category', $course->category) }}">
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">level</label>
                                            <input type="text" name="level"
                                                class="form-control @error('level') is-invalid @enderror"
                                                placeholder="level Name" value="{{ old('level', $course->level) }}">
                                            @error('level')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Duration (in Months)</label>
                                            <input type="number" name="duration"
                                                class="form-control @error('duration') is-invalid @enderror"
                                                placeholder="duration Name"
                                                value="{{ old('duration', $course->duration) }}">
                                            @error('duration')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">instructor</label>
                                            <input type="text" name="instructor"
                                                class="form-control @error('instructor') is-invalid @enderror"
                                                placeholder="instructor Name"
                                                value="{{ old('instructor', $course->instructor) }}">
                                            @error('instructor')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6 ">
                                            <label class="form-label">Price</label>
                                            <div class="input-group">
                                                {{-- <span class="input-group-text border-0">https://example.com</span> --}}
                                                <input type="number" name="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    placeholder="Price" value="{{ old('price', $course->price) }}">
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                id="start_date" name="start_date"
                                                value="{{ old('start_date', $course->start_date) }}">
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date"
                                                class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                                                name="end_date" value="{{ old('end_date', $course->end_date) }}">
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>



                                        <div class="mb-3 col-md-6">
                                            <label for="description" class="form-label">Description</label>

                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="4">{{ old('description', $course->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">

                                            <label for="image" class="form-label">image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            @if ($course->image)
                                                <img src="{{ asset('storage/courses/' . (Storage::disk('public')->exists('courses/thumbnails/' . $course->image) ? 'thumbnails/' . $course->image : $course->image)) }}"
                                                    alt="Thumbnail">
                                                <input type="checkbox" name="remove_image" id="remove_image">
                                                <label for="remove_image">Remove image</label>
                                            @endif

                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>


                                    <button type="submit" class="btn btn-primary">Update Course</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
