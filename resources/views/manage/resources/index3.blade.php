@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <style>
        .dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }
        .text-truncated {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .dt-buttons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }
        .dropdown-menu {
            padding: 0;
        }
    </style>
@endsection

@section('main-content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Resource List</h4>
                            <a class="btn btn-primary text-right" href="{{ route('resources.create') }}">Add New Resource</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.sessions')
                            @if (count($resources) > 0)
                                <div class="table-responsive">
                                    <table id="resource1" class="table table-striped table-hover w-100">
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
                                                    <td data-label="Image">
                                                        @php
                                                            $imageExists = $resource->image && Storage::disk('public')->exists('resources/' . $resource->image);
                                                            $thumbnailExists = $resource->image && Storage::disk('public')->exists('resources/thumbnails/' . $resource->image);
                                                        @endphp
                                                        <img class="rounded-circle" src="{{ $thumbnailExists ? Storage::url('resources/thumbnails/' . $resource->image) : ($imageExists ? Storage::url('resources/' . $resource->image) : ($resource->image ? asset('storage/common/loading.gif') : asset('storage/common/no_image.png'))) }}" width="30">
                                                    </td>
                                                    <td data-label="Resource Name">{{ $resource->name }}</td>
                                                    <td data-label="Category">{{ $resource->category }}</td>
                                                    <td data-label="URL" class="text-truncated">{{ $resource->url }}</td>
                                                    <td data-label="Description">{{ $resource->description }}</td>
                                                    <td data-label="Author">{{ $resource->author }}</td>
                                                    <td data-label="Action">
                                                        <div class="d-flex">
                                                            <a href="{{ route('resources.edit', $resource->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                            <a href="#" onclick="deleteResource({{ $resource->id }})" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
                                                                        reverseButtons: true,
                                                                        customClass: {
                                                                            confirmButton: 'btn btn-danger mx-2',
                                                                            cancelButton: 'btn btn-secondary mx-2'
                                                                        },
                                                                        buttonsStyling: false,
                                                                        backdrop: 'rgba(0, 0, 0, 0.5)',
                                                                        allowOutsideClick: false
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            document.getElementById('delete-form-' + resourceId).submit();
                                                                        }
                                                                    });
                                                                }
                                                            </script>
                                                            <form id="delete-form-{{ $resource->id }}" action="{{ route('resources.destroy', $resource->id) }}" method="POST" style="display: none;">
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
                                <div class="text-center">No Resources available</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#resource1').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                autoWidth: false,
                columnDefs: [
                    { targets: [5], render: function(data, type, row, meta) {
                        return type === 'display' && data.length > 50 ?
                            '<span title="'+data+'">'+data.substr(0, 50)+'...</span>' :
                            data;
                    }}
                ],
                buttons: [
                    {
                        extend: 'colvis',
                        text: 'Column Visibility'
                    },
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                            {
                                extend: 'copyHtml5',
                                text: 'Copy',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'csvHtml5',
                                text: 'CSV',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                text: 'Excel',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            }
                        ]
                    }
                ]
            });
        });
    </script>
@endsection
