@extends('layouts.app')
@section('headerTitle', 'Resources Dashboard')
@section('main-content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <table class="table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Image</th>
                                <th>Course Name</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Instructor</th>
                                <th>Level</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td>{{ $course->image }}</td> --}}
                                    <td>
                                        @php
                                            $imageExists = $course->image && Storage::disk('public')->exists($course->image);
                                        @endphp

                                        <img class="rounded-circle"
                                            src="{{ $imageExists ? Storage::url($course->image) : ($course->image ? asset('storage/resources/loading.gif') : asset('storage/resources/no_image.png')) }}"
                                            width="30">
                                    </td>
                                    <td>
                                        @php
                                            // Check if the image exists
                                            $imageExists = $course->image && Storage::disk('public')->exists($course->image);
                                    
                                            // Extract filename from image path
                                            $imageName = pathinfo($course->image, PATHINFO_FILENAME); // Extract filename without extension
                                            $extension = pathinfo($course->image, PATHINFO_EXTENSION); // Extract file extension
                                    
                                            // Construct thumbnail path
                                            $thumbnailPath = 'storage/courses/thumbnails/' . $imageName . '.' . $extension; // Construct thumbnail path with the same extension as the original image
                                        @endphp
                                    
                                        <img class="rounded-circle"
                                            src="{{ $imageExists ? asset($thumbnailPath) : ($course->image ? asset('storage/resources/loading.gif') : asset('storage/resources/no_image.png')) }}"
                                            width="30">
                                    </td>

                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->category }}</td>
                                    <td>{{ $course->duration }}</td>
                                    <td>{{ $course->instructor }}</td>
                                    <td>{{ $course->level }}</td>
                                    <td>{{ $course->start_date }}</td>
                                    <td>{{ $course->end_date }}</td>
                                    <td>{{ $course->price }}</td>
                                    
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('resources.edit', $course->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                    class="fas fa-pencil-alt"></i></a>

                                            <a href="{{ route('resources.destroy', $course->id) }}"
                                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $course->id }}').submit(); }"
                                                class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>

                                            <form id="delete-form-{{ $course->id }}"
                                                action="{{ route('resources.destroy', $course->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
