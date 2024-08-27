@extends('layouts.app')

{{-- @push('styles')
    <!-- Datatable -->
    <link href="{{ asset('build/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('build/assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins-init/datatables.init.js') }}"></script>

@endpush --}}

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('build/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">

    <!-- Pick date -->
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/vendor/pickadate/themes/default.date.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous {
        width: 100px !important;
    }

    .dataTables_wrapper .dataTables_info {

        padding-top: 2em !important;
    }

    @media print {
        body {
            /* background-color: #fff !important; */
        }

        .print-layout {
            background-color: white !important;
            /* Set background color for print layout */
        }

    }
</style>
@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('build/assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins-init/datatables.init.js') }}"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Include DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

    <!-- Include DataTables JavaScript -->

    <!-- Include DataTables Buttons JavaScript -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- pickdate -->
    <script src="{{ asset('build/assets/vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('build/assets/vendor/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('build/assets/vendor/pickadate/picker.date.js') }}"></script>

    <!-- Pickdate -->
    <script src="{{ asset('build/assets/js/plugins-init/pickadate-init.js') }}"></script>
@endpush

@section('headerTitle', 'User List')

@section('main-content')
    <!-- Your users list content goes here -->
    <div class="content-body">
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
                            <h4 class="card-title">User List</h4>
                            <a class="btn btn-primary text-right" href="{{ route('users.create') }}">Add New member</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.sessions')
                            <div class="table-responsive">
                                <table id="example44545" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th><i>#</i></th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Unic_ID</th>
                                            <th>Department</th>
                                            <th>Role/Position</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    @php
                                                        $profileImage = $user->profile->image ?? null;
                                                        $imageExists =
                                                            $profileImage &&
                                                            Storage::disk('public')->exists('users/' . $profileImage);
                                                        $thumbnailExists =
                                                            $profileImage &&
                                                            Storage::disk('public')->exists(
                                                                'users/thumbnails/' . $profileImage,
                                                            );
                                                        $imageUrl = $thumbnailExists
                                                            ? Storage::url('users/thumbnails/' . $profileImage)
                                                            : ($imageExists
                                                                ? Storage::url('users/' . $profileImage)
                                                                : ($profileImage
                                                                    ? asset('storage/common/loading.gif')
                                                                    : asset('storage/common/no_image.png')));
                                                    @endphp

                                                    {{-- <img class="rounded-circle"
                                                        src="{{ $thumbnailExists ? Storage::url('users/thumbnails/' . $profileImage) : ($imageExists ? Storage::url('users/' . $profileImage) : ($profileImage ? asset('storage/common/loading.gif') : asset('storage/common/no_image.png'))) }}"
                                                        width="30" media="print"> --}}
                                                    <img class="rounded-circle" src="{{ $imageUrl }}" width="30">
                                                </td>

                                                <td>
                                                    <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                                                </td>

                                                <td>
                                                    @if ($user->profile)
                                                        {{ $user->profile->member_id }}
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->profile)
                                                        {{ $user->profile->department ?? 'Null' }}
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->profile)
                                                        {{ $user->profile->member_type ?? 'Null' }}
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>
                                                <td><a href="javascript:void(0);"><strong>{{ $user->email }}</strong></a>
                                                </td>
                                                <td>
                                                    {{-- {{ $user->status ?? 'Default Value' }} --}}
                                                    {{-- @if ($user->isActive())
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-secondary">Inactive</span>
                                                @endif --}}
                                                    {{-- @switch($user->status)
                                                @case('active')
                                                    <span class="badge badge-success">Active</span>
                                                    @break
                                                @case('pending')
                                                    <span class="badge badge-warning">Pending Approval</span>
                                                    @break
                                                @case('rejected')
                                                    <span class="badge badge-danger">Rejected</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-secondary">{{ ucfirst($user->status) }}</span>
                                            @endswitch --}}
                                                    <!-- Update Status Form -->
                                                    <!-- Badge to display user status -->
                                                    <!-- Badge to display user status -->
                                                    <span id="status-badge-{{ $user->id }}"
                                                        class="badge {{ $user->status == 'active' ? 'badge-success' : ($user->status == 'inactive' ? 'badge-danger' : ($user->status == 'pending' ? 'badge-warning' : ($user->status == 'suspended' ? 'badge-info' : ($user->status == 'blocked' ? 'badge-dark' : 'badge-secondary')))) }}">{{ $user->status }}</span>

                                                    <a class="btn btn-primary shadow btn-xs sharp me-1"
                                                        onclick="openStatusModal('{{ $user->id }}')"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                </td>

                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="fas fa-pencil-alt" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Edit User"title="Edit User"></i></a>
                                                        <!-- Add a new link/button for changing user roles -->
                                                        <a href="{{ route('users.roles.edit', $user->id) }}"
                                                            class="btn btn-info shadow btn-xs sharp me-1"><i
                                                                class="fas fa-user-cog"></i></a>
                                                        {{-- <a href="{{ route('users.destroy', $user->id) }}"
                                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>

                                                        <form id="delete-form-{{ $user->id }}"
                                                            action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                            style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form> --}}

                                                        <a href="#" onclick="deleteUser({{ $user->id }})"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>

                                                        <script>
                                                            function deleteUser(userId) {
                                                                Swal.fire({
                                                                    title: 'Are you sure?',
                                                                    text: 'You will not be able to recover this user!',
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
                                                                        document.getElementById('delete-form-' + userId).submit();
                                                                    }
                                                                });
                                                            }
                                                        </script>

                                                        <form id="delete-form-{{ $user->id }}"
                                                            action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                            style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><i>#</i></th>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Unic_ID</th>
                                            <th>Department</th>
                                            <th>Role/Position</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Your other content here -->
        </div>
    </div>

    <!-- Modal for status change -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Change User Status</h5>
                    <button type="button" class="close bg-white m-2 p-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="statusForm">
                        <div class="form-group">
                            <label for="statusSelect">Select Status:</label>
                            <select class="form-control" id="statusSelect">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                                <option value="suspended">Suspended</option>
                                <option value="blocked">Blocked</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitStatusForm()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>
        function openStatusModal(userId) {
            // Set the selected user ID as a data attribute on the modal
            $('#statusModal').attr('data-user-id', userId);
            // Show the modal
            $('#statusModal').modal('show');
        }

        function submitStatusForm() {
            // Get the selected user ID from the modal data attribute
            const userId = $('#statusModal').attr('data-user-id');
            const newStatus = $('#statusSelect').val();


            // Submit the form via AJAX
            $.ajax({
                url: '/manage/users/' + userId + '/update-status',
                method: 'PUT',
                data: {
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Update the status badge
                    $('#status-badge-' + userId).text(newStatus).removeClass().addClass('badge badge-status ' +
                        getStatusBadgeClass(newStatus));
                    // Close the modal
                    $('#statusModal').modal('hide');
                },
                error: function(xhr) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        }

        function getStatusBadgeClass(status) {
            switch (status) {
                case 'active':
                    return 'badge badge-success';
                case 'inactive':
                    return 'badge badge-danger';
                case 'pending':
                    return 'badge badge-warning';
                case 'suspended':
                    return 'badge badge-info';
                case 'blocked':
                    return 'badge badge-dark';
                default:
                    return 'badge badge-secondary';
            }
        }
    </script>
    {{-- <script src="{{ asset('build/assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('build/assets/js/plugins-init/sweetalert.init.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // function loadImagesForPrint() {
        //     $('#example44545').find('img').each(function() {
        //         var src = $(this).attr('src');
        //         $(this).attr('src', src);
        //     });
        // }

        function initializeDataTable(tableId) {
            $(tableId).DataTable({
                searching: true,
                paging: true,
                select: true,
                info: true,
                lengthChange: true,

                dom: 'lBfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'copy', 'print',
                ],
                buttons: [{
                        extend: 'csv',
                        title: 'CSV - Custom Title'
                    },
                    {
                        extend: 'excel',
                        title: 'Excel - Custom Title'
                    },
                    {
                        extend: 'pdf',
                        title: 'PDF - Custom Title'
                    },
                    {
                        extend: 'copy',
                        title: 'Copy - Custom Title'
                    },
                    // {
                    //     extend: 'print',
                    //     title: 'Print - Custom Title'
                    // },
                    {
                        // extend: 'print',
                        // title: 'User List',
                        // customize: function(win) {
                        //     // Ensure the document inside the print window is fully loaded

                        //     $(win.document.body).find('table').addClass('display').css(
                        //         'font-size', '12px');
                        //     // Apply background color to odd rows' cells
                        //     $(win.document.body).find('tr:nth-child(odd) td').each(function(
                        //         index) {
                        //         $(this).css('background-color', '#D0D0D0 !important');
                        //     });
                        //     $(win.document.body).find('h1').css('text-align', 'center');
                        //     // // Convert image URLs to actual images for the second column
                        //     // $(win.document.body).find('table tbody td:nth-child(3)').each(function() {
                        //     //     var imgSrc = $(this).find('img').attr('src');
                        //     //     $(this).empty().append('<img src="' + imgSrc + '">');
                        //     // });

                        //     // Remove the columns you don't want to print
                        //     $(win.document.body).find(
                        //         'table thead th:nth-child(1), table tbody td:nth-child(1), table thead th:nth-child(8),table tbody td:nth-child(8),   table thead th:nth-child(9), table tbody td:nth-child(9)'
                        //     ).remove(); // Remove the 1st and 9th column
                        // }
                        extend: 'print',
                        title: 'User List',
                        customize: function(win) {
                            // Add CSS classes or styles to customize the print layout
                            $(win.document.body).addClass('print-layout');

                            $(win.document.body).find('tr:nth-child(odd) td').each(function(
                                index) {
                                $(this).css('background-color', '#D0D0D0 !important');
                            });
                            $(win.document.body).find('h1').css('text-align', 'center');
                            // Only include selected columns in the print preview
                            var selectedColumns = [0, 2, 3, 4, 5,
                                6
                            ]; // Example: include columns 0, 1, and 2
                            $(win.document.body).find('table thead th, table tbody td')
                                .hide(); // Hide all columns initially
                            selectedColumns.forEach(function(columnIndex) {
                                $(win.document.body).find('table thead th:nth-child(' + (
                                    columnIndex + 1) + '), table tbody td:nth-child(' + (
                                    columnIndex + 1) + ')').show(); // Show selected columns
                            });

                            // Add zebra-striping to the print layout
                            $(win.document.body).find('table').addClass('table-striped ');

                            // Adjust font size for print layout
                            $(win.document.body).find('table').css('font-size', '9px');
                        }
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, 100, 200, 500, 1000, -1],
                    [10, 25, 50, 100, 200, 500, 1000, "All"]
                ],

                drawCallback: function() {
                    // Remove unnecessary pagination links
                    $('.paginate_button').addClass('d-none');
                    $('.paginate_button.previous, .paginate_button.next').removeClass('d-none');

                    // Show only the desired number of page links
                    var numPages = $('.paginate_button').length -
                        2; // Excluding 'Previous' and 'Next' buttons
                    var showPages = 5; // Number of pages to show
                    var currentPage = parseInt($('.paginate_button.current').text());

                    var startPage = Math.max(currentPage - 2, 1);
                    var endPage = Math.min(currentPage + 2, numPages);

                    // Show the pages within the range [startPage, endPage]
                    for (var i = startPage; i <= endPage; i++) {
                        $('.paginate_button').eq(i).removeClass('d-none');
                    }

                    // Add ellipses if necessary
                    if (startPage > 3) {
                        $('.paginate_button').eq(2).removeClass('d-none').text('...');
                    }
                    if (endPage < numPages - 2) {
                        $('.paginate_button').eq(numPages - 1).removeClass('d-none').text('...');
                    }
                }
            });
        }

        $(document).ready(function() {
            initializeDataTable('#example44545');
            // Preload images before printing
            // $('button.buttons-print').click(function() {
            //     $('table tbody td img').each(function() {
            //         var imgSrc = $(this).attr('src');
            //         var img = new Image();
            //         img.src = imgSrc;
            //     });
            // });
        });
    </script>


    <script>
        // // Function to initialize tables dynamically
        // function initializeTables() {
        //     $('table').each(function() {
        //         $(this).DataTable();
        //     });
        // }

        // // Call the function when the document is ready
        // $(document).ready(function() {
        //     initializeTables();
        // });
    </script>

    {{-- <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                // Your existing initialization options
            });

            // Modify the existing print button to customize its behavior
            table.button('print').action(function(e, dt, button, config) {
                var data = table.buttons.exportData(config.exportOptions);

                // Get the indices of columns to include in the print
                var columnsToPrint = [];
                table.columns().every(function(index) {
                    if (table.column(index).visible()) {
                        columnsToPrint.push(index);
                    }
                });

                // Filter out columns that should not be printed
                var columnsNotToPrint = [8]; // Example: Column indices to exclude from printing
                columnsToPrint = columnsToPrint.filter(function(columnIndex) {
                    return !columnsNotToPrint.includes(columnIndex);
                });

                // Construct a new window with the printable content
                var printableContent =
                    '<!DOCTYPE html><html><head><title>Printable Table</title></head><body>';
                printableContent += '<table><thead><tr>';

                // Add table headers for the columns to print
                $.each(columnsToPrint, function(index, columnIndex) {
                    printableContent += '<th>' + config.columns[columnIndex].title + '</th>';
                });
                printableContent += '</tr></thead><tbody>';

                // Add table rows for the columns to print
                $.each(data.body, function(index, row) {
                    printableContent += '<tr>';
                    $.each(columnsToPrint, function(index, columnIndex) {
                        // Check if the cell contains an image
                        if (config.columns[columnIndex].title ===
                            "Image") { // Example: Check if column title is "Image"
                            var imgSrc = row[columnIndex];
                            printableContent += '<td><img src="' + imgSrc + '"></td>';
                        } else {
                            printableContent += '<td>' + row[columnIndex] + '</td>';
                        }
                    });
                    printableContent += '</tr>';
                });
                printableContent += '</tbody></table>';
                printableContent += '</body></html>';

                // Open a new window with the printable content
                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write(printableContent);
                printWindow.document.close();

                // Trigger print function in the new window
                printWindow.print();
            });
        });
    </script> --}}


@endsection
