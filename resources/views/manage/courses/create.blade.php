@extends('layouts.app')
@section('headerTitle', 'Create Course')
@section('main-content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Course</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @include('layouts.sessions')
                                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name"
                                                class="form-control  @error('name') is-invalid @enderror"
                                                placeholder="Resource Name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Category</label>
                                            <input type="text" name="category"
                                                class="form-control @error('category') is-invalid @enderror"
                                                placeholder="category" value="{{ old('category') }}">
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Level</label>
                                            <input type="text" name="level"
                                                class="form-control @error('level') is-invalid @enderror"
                                                placeholder="level Name" value="{{ old('level') }}">
                                            @error('level')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Duration (in Months)</label>
                                            <input type="number" name="duration"
                                                class="form-control @error('duration') is-invalid @enderror"
                                                placeholder="duration in moths" value="{{ old('duration') }}">
                                            @error('duration')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Instructor</label>
                                            <input type="text" name="instructor"
                                                class="form-control @error('instructor') is-invalid @enderror"
                                                placeholder="instructor Name" value="{{ old('instructor') }}">
                                            @error('instructor')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6 ">
                                            <label class="form-label">Price <strong>&#8377;</strong></label>
                                            <div class="input-group">
                                                {{-- <span class="input-group-text border-0">https://example.com</span> --}}
                                                <input type="number" name="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    placeholder="Price in Rupees(&#8377;)" value="{{ old('price') }}">
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                id="start_date" name="start_date" value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date"
                                                class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                                                name="end_date" value="{{ old('end_date') }}">
                                            @error('end_date')
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

                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">

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
