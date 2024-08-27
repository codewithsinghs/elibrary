@extends('layouts.app')

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('build/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('build/assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins-init/datatables.init.js') }}"></script>
@endpush

@section('headerTitle', 'Manage Roles')

@section('main-content')
    <!-- Your users list content goes here -->
    <div class="content-body">
        <div class="container-fluid">

            {{-- <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
                </ol>
            </div> --}}
            <!-- row -->


            <div class="row">

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Roles Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>

                                                <td>{{ $role->name }}</td>


                                                <td>
                                                    <div class="d-flex ml-auto">
                                                        <a href="{{ route('roles.edit', $role) }}"
                                                            class="btn btn-primary shadow btn-xs sharp me-1  ml-auto"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        <a href="{{ route('roles.destroy', $role) }}"
                                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $role }}').submit(); }"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>

                                                        <form id="delete-form-{{ $role }}"
                                                            action="{{ route('roles.destroy', $role) }}" method="POST"
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
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Roles Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {{-- <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>

                                                <td>{{ $role->name }}</td>


                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('roles.edit', $role) }}"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        <a href="{{ route('roles.destroy', $role) }}"
                                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $role }}').submit(); }"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>

                                                        <form id="delete-form-{{ $role }}"
                                                            action="{{ route('roles.destroy', $role) }}" method="POST"
                                                            style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> --}}
                                <h1>Manage Permissions for Role: {{ $role->name }}</h1>

                                <form method="POST" action="{{ route('roles.store', $role) }}">
                                    @csrf

                                    <h2>Assign Permissions:</h2>
                                    @foreach ($permissions as $permission)
                                        <div>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                    {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}>
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach

                                    <button type="submit">Save Permissions</button>
                                </form>

                                <hr>

                                <h2>Current Permissions:</h2>
                                <ul>
                                    @foreach ($role->permissions as $permission)
                                        <li>{{ $permission->name }} <form method="POST"
                                                action="{{ route('roles.destroy', [$role, $permission]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Revoke</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Edit User Modal -->
            <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form fields to edit user data -->
                            <form id="editUserForm">
                                <!-- Populate this with user data via JavaScript -->
                                <!-- Example: -->
                                <input type="hidden" id="userId">
                                <input type="text" id="userName" class="form-control" placeholder="Name">
                                <input type="email" id="userEmail" class="form-control" placeholder="Email">
                                <!-- Add more fields as needed -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updateUser()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Your other content here -->
        </div>
    </div>
@endsection

{{-- @section('scripts')
    <script>
        // Function to fetch user data and populate modal fields
        function fetchUser(userId) {
            $.ajax({
                url: '/users/' + userId,
                type: 'GET',
                success: function(data) {
                    // Populate modal fields with user data
                    $('#userId').val(data.id);
                    $('#userName').val(data.name);
                    $('#userEmail').val(data.email);
                    // Populate other fields as needed
                    $('#editUserModal').modal('show');
                }
            });
        }

        // Function to update user data
        function updateUser() {
            var userId = $('#userId').val();
            var userData = {
                name: $('#userName').val(),
                email: $('#userEmail').val(),
                // Add other fields as needed
            };

            $.ajax({
                url: '/users/' + userId,
                type: 'PUT',
                data: userData,
                success: function(response) {
                    // Handle success
                    // For example, close the modal or show a success message
                    $('#editUserModal').modal('hide');
                },
                error: function(error) {
                    // Handle error
                    console.error(error);
                }
            });
        }
    </script>
@endsection --}}
