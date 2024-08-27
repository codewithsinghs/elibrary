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
@include('components.datatable')
<style>
    .text-truncated {
        max-width: 150px;
        /* Adjust as needed */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: pointer;
    }

    .text-truncated:hover {
        white-space: normal;
        overflow: visible;
        text-overflow: initial;
        z-index: 9999;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>
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
                            <h4 class="card-title">Resource List</h4>
                            <a class="btn btn-primary text-right" href="{{ route('resources.create') }}">Add New
                                Resource</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.sessions')
                            @if (count($resources) > 0)
                                <div class="table-responsive">
                                    <table id="resource1" class="table display nowwrap table-striped table-hover w-auto">
                                        <thead>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>Image</th>
                                                <th>Resource Name</th>
                                                <th>Category</th>
                                                <th>URL</th>
                                                <th>Description</th>
                                                <th>Author</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($resources as $resource)
                                                <tr>
                                                    <td data-label="S.N.">{{ $loop->iteration }}</td>
                                                    {{-- <td>{{ $resource->image }}</td> --}}
                                                    {{-- <td>
                                        @php
                                            $thumbnailExists = $resource->image && Storage::disk('public')->exists($resource->image);
                                        @endphp

                                        <img class="rounded-circle"
                                            src="{{ $thumbnailExists ? Storage::url($resource->image) : ($resource->image ? asset('storage/resources/loading.gif') : asset('storage/resources/no_image.png')) }}"
                                            width="30">
                                    </td> --}}

                                                    <td data-label="Image">
                                                        @php
                                                            $imageExists =
                                                                $resource->image &&
                                                                Storage::disk('public')->exists(
                                                                    'resources/' . $resource->image,
                                                                );
                                                            $thumbnailExists =
                                                                $resource->image &&
                                                                Storage::disk('public')->exists(
                                                                    'resources/thumbnails/' . $resource->image,
                                                                );
                                                        @endphp

                                                        <img class="rounded-circle"
                                                            src="{{ $thumbnailExists ? Storage::url('resources/thumbnails/' . $resource->image) : ($imageExists ? Storage::url('courses/' . $resource->image) : ($resource->image ? asset('storage/common/loading.gif') : asset('storage/common/no_image.png'))) }}"
                                                            width="30">
                                                    </td>



                                                    <td data-label="Resource Name">{{ $resource->name }}</td>
                                                    <td data-label="Category">{{ $resource->category }}</td>
                                                    <td data-label="URL" class="text-truncated">{{ $resource->url }}</td>
                                                    <td data-label="Description" class="text-truncated">
                                                        {{ $resource->description }}</td>
                                                    <td data-label="Author">{{ $resource->author }}</td>
                                                    <td data-label="Action">
                                                        <div class="d-flex">
                                                            <a href="{{ route('resources.edit', $resource->id) }}"
                                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                    class="fas fa-pencil-alt"></i></a>

                                                            <a href="#" onclick="deleteResource({{ $resource->id }})"
                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                    class="fa fa-trash"></i></a>

                                                            <script>
                                                                function deleteResource(resourceId) {
                                                                    Swal.fire({
                                                                        title: 'Are you sure?',
                                                                        text: 'You will not be able to recover this Resource!',
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
                                                                        allowOutsideClick: false // Prevent closing the dialog by clicking outside
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            // Manually submit the form
                                                                            document.getElementById('delete-form-' + resourceId).submit();
                                                                        }
                                                                    });
                                                                }
                                                            </script>

                                                            <form id="delete-form-{{ $resource->id }}"
                                                                action="{{ route('resources.destroy', $resource->id) }}"
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
                                <div class="text-center">No Resorces available</div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection

@section('scripts')
    @include('components.elementsstyle')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Call the function with the desired table ID
        initializeDataTable('#resource1');
    </script>

    <style>
        /* table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        } */

        @media (max-width: 600px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin: 0 0 1rem 0;
                border: 1px solid #ddd;
            }

            td {
                border: none;
                border-bottom: 1px solid #ddd;
                position: relative;
                padding-left: 50% !important;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 10px;
                font-weight: bold;
                white-space: nowrap;
            }

            .text-truncated {
                max-width: 100%;
                /* Adjust as needed */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                cursor: pointer;
            }

            .text-truncated:hover {
                white-space: normal;
                overflow: visible;
                text-overflow: initial;
                z-index: 9999;
            }
            .dt-type-numeric{
                text-align: inherit!important;
            }
        }
    </style>

@endsection
