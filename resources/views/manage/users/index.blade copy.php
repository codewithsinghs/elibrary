@extends('layouts.app')

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('build/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@endpush

<style>
    .status-toggle {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .toggle-checkbox {
        display: none;
    }

    .toggle-label {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        border-radius: 34px;
        transition: background-color 0.3s ease;
    }

    .toggle-label:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    #status-indicator {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 12px;
        color: white;
    }
</style>
@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('build/assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins-init/datatables.init.js') }}"></script>

    {{-- <script src="{{ asset('build/assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins-init/sweetalert.init.js') }}"></script> --}}
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
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Unic_ID</th>
                                            <th>Department</th>
                                            <th>Role / Position</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
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
                                                    @endphp

                                                    <img class="rounded-circle"
                                                        src="{{ $thumbnailExists ? Storage::url('users/thumbnails/' . $profileImage) : ($imageExists ? Storage::url('users/' . $profileImage) : ($profileImage ? asset('storage/common/loading.gif') : asset('storage/common/no_image.png'))) }}"
                                                        width="30">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    @if ($user->profile)
                                                        {{ $user->profile->unic_id }}
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
                                                        {{ $user->profile->role_position ?? 'Null' }}
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
                        <span class="badge badge-warning">Pending</span>
                        @break
                    @case('blocked')
                        <span class="badge badge-danger">blocked</span>
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


@endsection
