@extends('layouts.app')
@section('headerTitle', 'Resources Dashboard')

{{-- @push('styles')
    <!-- Datatable -->
    <link href="{{ asset('build/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('build/assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins-init/datatables.init.js') }}"></script>
@endpush --}}

@section('main-content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
                </ol>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title">Course List</h4>
                            <a class="btn btn-primary text-right" href="{{ route('courses.create') }}">Add New Course</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.sessions')
                          
                            @if (count($courses) > 0)
                                <div class="table-responsive">

                                    <table id="example7" class="display table-hover table-responsive">
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
                                                    {{-- <td>
                                                    @php
                                                        $imageExists = $course->image && Storage::disk('public')->exists('courses/' . $course->image);
                                                    @endphp

                                                    <img class="rounded-circle"
                                                        src="{{ $imageExists ? Storage::url('courses/thumbnails/' . $course->image) : ($course->image ? asset('storage/resources/loading.gif') : asset('storage/resources/no_image.png')) }}"
                                                        width="30">
                                                </td> --}}

                                                    <td>
                                                        @php
                                                            $imageExists =
                                                                $course->image &&
                                                                Storage::disk('public')->exists(
                                                                    'courses/' . $course->image,
                                                                );
                                                            $thumbnailExists =
                                                                $course->image &&
                                                                Storage::disk('public')->exists(
                                                                    'courses/thumbnails/' . $course->image,
                                                                );
                                                        @endphp

                                                        <img class="rounded-circle"
                                                            src="{{ $thumbnailExists ? Storage::url('courses/thumbnails/' . $course->image) : ($imageExists ? Storage::url('courses/' . $course->image) : ($course->image ? asset('storage/common/loading.gif') : asset('storage/common/no_image.png'))) }}"
                                                            width="30">
                                                    </td>


                                                    <td>{{ $course->name }}</td>
                                                    <td>{{ $course->category }}</td>
                                                    <td>{{ $course->duration }} Months</td>
                                                    <td>{{ $course->instructor }}</td>
                                                    <td>{{ $course->level }}</td>
                                                    <td>{{ $course->start_date }}</td>
                                                    <td>{{ $course->end_date }}</td>
                                                    <td>&#8377; {{ $course->price }} </td>

                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('courses.edit', $course->id) }}"
                                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                            {{-- <a data-bs-toggle="modal"
                                                            data-bs-target="#editCourseModal{{ $course->id }}"
                                                            data-course-id="{{ $course->id }}"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="fas fa-pencil-alt"></i></a> --}}

                                                            <a href="#" onclick="deleteCourse({{ $course->id }})"
                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                    class="fa fa-trash"></i></a>

                                                            <script>
                                                                function deleteCourse(courseId) {
                                                                    Swal.fire({
                                                                        title: 'Are you sure?',
                                                                        text: 'You will not be able to recover this Course!',
                                                                        icon: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#d33',
                                                                        cancelButtonColor: '#3085d6',
                                                                        confirmButtonText: 'Yes, delete it!',
                                                                        cancelButtonText: 'No, cancel',
                                                                        reverseButtons: true, // Swap the positions of the confirm and cancel buttons
                                                                        customClass: {
                                                                            confirmButton: 'btn btn-danger mx-2',
                                                                            cancelButton: 'btn btn-secondary mx-2'
                                                                        },
                                                                        buttonsStyling: false, // Disable default button styling
                                                                        backdrop: 'rgba(0, 0, 0, 0.5)', // Darken the background
                                                                        allowOutsideClick: false, // Prevent closing the dialog by clicking outside
                                                                        focusCancel: true // Set the cancel button as default focused button
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            // Manually submit the form
                                                                            document.getElementById('delete-form-' + courseId).submit();
                                                                        }
                                                                    });
                                                                }
                                                            </script>

                                                            <form id="delete-form-{{ $course->id }}"
                                                                action="{{ route('courses.destroy', $course->id) }}"
                                                                method="POST" style="display: none;">
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
                            @else
                                <div class="text-center">No Cources available.</div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<!-- Modal for adding a new course -->


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- JavaScript code to update hidden input field with course ID -->
    <script>
        // Call the function with the desired table ID
        initializeDataTable('#example44546');
    </script>
       
 
@endsection
