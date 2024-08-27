@extends('layouts.app')
@include('components.datatable')


@section('headerTitle', 'User List')

@section('main-content')

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
                            <a class="btn btn-primary text-right" href="{{ route('roles.create') }}">Add New
                                Roles</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.sessions')
                            <div class="table-responsive">
                                <table class="table table-wrapper table-striped table-hover ">
                                    <tr>
                                        <th>Role Name</th>
                                        <th>Permissions</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td class="text-capitalize">{{ $role->name }}</td>
                                            {{-- <td class="text-capitalize">{{ $role->permissions }}</td> --}}
                                            <td>
                                                <ul>
                                                    @foreach ($role->permissions as $permission)
                                                        <li>{{ $permission->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                           
                                            <td class="col-dt-hidden">
                                                <div class="d-flex">

                                                    <a href="{{ route('roles.edit', $role->id) }}"
                                                        class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                            class="fas fa-pencil-alt" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Edit role"title="Edit role"></i></a>
                                                    <!-- Add a new link/button for changing role roles -->

                                                    <a href="{{ route('roles.show', $role->id) }}"
                                                        class="btn btn-secondary shadow btn-xs sharp me-1"><i
                                                            class="fas fa-eye" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Edit role"title="Edit role"></i></a>


                                                    <a href="#" onclick="deleteRole({{ $role->id }})"
                                                        class="btn btn-danger shadow btn-xs sharp"><i
                                                            class="fa fa-trash"></i></a>


                                                    <script>
                                                        function deleteRole(roleId) {
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
                                                                allowOutsideClick: false, // Prevent closing the dialog by clicking outside
                                                                focusCancel: true // Set the cancel button as default focused button
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    // Manually submit the form
                                                                    document.getElementById('delete-form-' + roleId).submit();
                                                                }
                                                            });
                                                        }
                                                    </script>

                                                    <form id="delete-form-{{ $role->id }}"
                                                        action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </table>
                                {{-- <table id="example44546" class="display table table-striped table-hover nowwrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><i>#</i></th>
                                            <th class="col-dt-hidden noExport">Img</th>
                                            <th>Name</th>
                                            <th>Unic_ID</th>
                                            <th>Department</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th class="col-dt-hidden noExport action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="col-dt-hidden noExport">
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
                                                    <!-- Badge to display user status -->
                                                    <span id="status-badge-{{ $user->id }}"
                                                        class="badge {{ $user->status == 'active' ? 'badge-success' : ($user->status == 'inactive' ? 'badge-danger' : ($user->status == 'pending' ? 'badge-warning' : ($user->status == 'suspended' ? 'badge-info' : ($user->status == 'blocked' ? 'badge-dark' : 'badge-secondary')))) }}">{{ $user->status }}</span>

                                                    <a class="btn btn-primary shadow btn-xs sharp me-1"
                                                        onclick="openStatusModal('{{ $user->id }}')"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                </td>

                                                <td class="col-dt-hidden">
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
                                                                    allowOutsideClick: false, // Prevent closing the dialog by clicking outside
                                                                    focusCancel: true // Set the cancel button as default focused button
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
                                            <th class="col-dt-hidden noExport">Img</th>
                                            <th>Name</th>
                                            <th>Unic_ID</th>
                                            <th>Department</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th class="col-dt-hidden noExport">Action</th>
                                        </tr>
                                    </tfoot>
                                </table> --}}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @include('components.elementsstyle')
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
        // Call the function with the desired table ID
        initializeDataTable('#example44546');
    </script>



@endsection
