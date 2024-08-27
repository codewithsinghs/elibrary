@extends('layouts.app')

@section('main-content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Roles Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
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
                                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this role?')) { document.getElementById('delete-role-form-{{ $role->id }}').submit(); }"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>
                                                        <form id="delete-role-form-{{ $role->id }}"
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manage Permissions</h4>
                        </div>
                        @extends('layouts.app')
                        {{-- <div class="card">
                            <div class="card-header">Manage Roles and Permissions</div>
        
                            <div class="card-body">
                                <!-- Display all roles and their permissions -->
                                <h4>Roles and Permissions</h4>
                                <ul class="list-group">
                                    @foreach ($roles as $role)
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>{{ $role->name }}</span>
                                                <div>
                                                    <button class="btn btn-sm btn-outline-primary mr-2" onclick="togglePermissions({{ $role->id }})">View Permissions</button>
                                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                                </div>
                                            </div>
                                            <div id="permissions_{{ $role->id }}" class="collapse mt-2">
                                                <ul class="list-unstyled">
                                                    @forelse($role->permissions as $permission)
                                                        <li>{{ $permission->name }}</li>
                                                    @empty
                                                        <li>No permissions assigned.</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
        
                                <!-- Form to add or revoke permissions for a role -->
                                <h4 class="mt-4">Add or Revoke Permissions</h4>
                                <form method="POST" action="{{ route('roles.update', $role) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="role">Select Role</label>
                                        <select class="form-control" id="role" name="role_id" required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Permissions</label><br>
                                        @foreach ($permissions as $permission)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Permissions</button>
                                </form>
                            </div>
                        </div> --}}
                        {{-- <div class="card">
                            <div class="card-header">Manage Roles and Permissions</div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Role</th>
                                                <th>Permissions</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($role->permissions as $permission)
                                                                <li>{{ $permission->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('roles.edit', $role->id) }}"
                                                            class="btn btn-sm btn-primary">Edit</a>
                                                        <form action="{{ route('roles.destroy', $role->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="card">
                            <div class="card-header">Manage Roles and Permissions</div>
        
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Role</th>
                                                <th>Permissions</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $role)
                                                <tr>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach($role->permissions as $permission)
                                                                <li>{{ $permission->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary" title="Edit Role">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete Role" onclick="return confirm('Are you sure you want to delete this role?')">
                                                                <i class="fas fa-trash-alt"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}

                        <div class="card">
                            <div class="card-header">Manage Roles and Permissions</div>
        
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Role</th>
                                                <th>Permissions</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($roles as $role)
                                                <tr>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach($role->permissions as $permission)
                                                                <li>{{ $permission->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary" title="Edit Role">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete Role" onclick="return confirm('Are you sure you want to delete this role?')">
                                                                <i class="fas fa-trash-alt"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">No roles found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="d-flex justify-content-center">
                                    {{ $roles->links() }}
                                </div> --}}
                            </div>
                        </div>
                        {{-- <div class="card">
                            <div class="card-header">Manage Roles and Permissions</div>

                            <div class="card-body">
                                <!-- Display all roles -->
                                <h4>Roles</h4>
                                <ul>
                                    @foreach ($roles as $role)
                                        <li>{{ $role->name }}</li>
                                    @endforeach
                                </ul>

                                <!-- Add new role form -->
                                <h4>Add New Role</h4>
                                <form method="POST" action="{{ route('roles.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="role_name">Role Name</label>
                                        <input type="text" class="form-control" id="role_name" name="name" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Role</button>
                                </form>

                                <!-- Revoke/Assign permissions -->
                                <h4>Manage Permissions</h4>
                                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="permission">Permissions</label>
                                        <select multiple class="form-control" id="permission" name="permissions[]" required>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Permissions</button>
                                </form>
                            </div>
                        </div> --}}


                        {{-- <div class="card">
                            <div class="card-header">Manage Roles and Permissions</div>
        
                            <div class="card-body">
                                <!-- Display all roles and their permissions -->
                                <h4>Roles and Permissions</h4>
                                <ul>
                                    @foreach ($roles as $role)
                                        <li>{{ $role->name }}:
                                            <ul>
                                                @foreach ($role->permissions as $permission)
                                                    <li>{{ $permission->name }}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
        
                                <!-- Form to add or revoke permissions for a role -->
                                <h4>Add or Revoke Permissions</h4>
                                <form method="POST" action="{{ route('roles.update', $role) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="role">Select Role</label>
                                        <select class="form-control" id="role" name="role_id" required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Permissions</label><br>
                                        @foreach ($permissions as $permission)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Permissions</button>
                                </form>
                            </div>
                        </div> --}}



                        {{-- <div class="card-body">
                            <h2>Assign Permissions for Role: {{ $role->name }}</h2>
                            <form method="POST" action="{{ route('roles.store', $role) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="permissions">Select Permissions:</label>
                                    <select name="permissions[]" class="form-control" multiple>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Permissions</button>
                            </form>
                            <hr>
                            <h2>Current Permissions:</h2>
                            <ul>
                                @foreach ($role->permissions as $permission)
                                    <li>{{ $permission->name }}
                                        <form method="POST" action="{{ route('roles.destroy', [$role, $permission]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Revoke</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Function to toggle permissions collapse
        function togglePermissions(roleId) {
            var permissionsDiv = document.getElementById('permissions_' + roleId);
            if (permissionsDiv.classList.contains('show')) {
                permissionsDiv.classList.remove('show');
            } else {
                permissionsDiv.classList.add('show');
            }
        }
    </script>
@endpush
