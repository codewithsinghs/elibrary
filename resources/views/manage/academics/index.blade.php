@extends('layouts.app')
@section('headerTitle', 'Resources Dashboard')

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('build/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('build/assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins-init/datatables.init.js') }}"></script>
@endpush

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
                            <h4 class="card-title">academics List</h4>
                            <a class="btn btn-primary text-right" href="{{ route('academics.create') }}">Add New
                                academics</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.sessions')
                            <div class="table-responsive">

                                <table id="example7" class="display table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Institute Name</th>
                                            <th>Faculty</th>
                                            <th>Departmant</th>
                                            <th>Course / Designation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($academicEntity as $academic)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                {{-- <td>{{ $academic->image }}</td> --}}
                                                {{-- <td>
                                                    @php
                                                        $imageExists = $academic->image && Storage::disk('public')->exists('academics/' . $academic->image);
                                                    @endphp

                                                    <img class="rounded-circle"
                                                        src="{{ $imageExists ? Storage::url('academics/thumbnails/' . $academic->image) : ($academic->image ? asset('storage/resources/loading.gif') : asset('storage/resources/no_image.png')) }}"
                                                        width="30">
                                                </td> --}}

                                                <td>
                                                    @php
                                                        $imageExists =
                                                            $academic->image &&
                                                            Storage::disk('public')->exists(
                                                                'academics/' . $academic->image,
                                                            );
                                                        $thumbnailExists =
                                                            $academic->image &&
                                                            Storage::disk('public')->exists(
                                                                'academics/thumbnails/' . $academic->image,
                                                            );
                                                    @endphp

                                                    <img class="rounded-circle"
                                                        src="{{ $thumbnailExists ? Storage::url('academics/thumbnails/' . $academic->image) : ($imageExists ? Storage::url('academics/' . $academic->image) : ($academic->image ? asset('storage/common/loading.gif') : asset('storage/common/no_image.png'))) }}"
                                                        width="30">
                                                </td>


                                                <td>{{ $academic->category }}</td>
                                                <td>{{ $academic->institute }}</td>
                                                <td>{{ $academic->faculty }}</td>
                                                <td>{{ $academic->department }}</td>
                                                <td>{{ $academic->course }}</td>


                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('academics.edit', $academic->id) }}"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        {{-- <a data-bs-toggle="modal"
                                                            data-bs-target="#editacademicsModal{{ $academic->id }}"
                                                            data-academics-id="{{ $academic->id }}"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="fas fa-pencil-alt"></i></a> --}}

                                                        <a href="#" onclick="deleteacademics({{ $academic->id }})"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>

                                                        <script>
                                                            function deleteacademics(academicsId) {
                                                                Swal.fire({
                                                                    title: 'Are you sure?',
                                                                    text: 'You will not be able to recover this academics!',
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
                                                                        document.getElementById('delete-form-' + academicsId).submit();
                                                                    }
                                                                });
                                                            }
                                                        </script>

                                                        <form id="delete-form-{{ $academic->id }}"
                                                            action="{{ route('academics.destroy', $academic->id) }}"
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<!-- Modal for adding a new academics -->


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- JavaScript code to update hidden input field with academics ID -->

@endsection
