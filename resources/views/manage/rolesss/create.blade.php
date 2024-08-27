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

            <!-- <div class="row page-titles">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
                                </ol>
                            </div> -->
            <!-- row -->


            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Role Management</div>
                        <div class="card-body">
                            {{-- Display Existing Roles and Permissions --}}
                            <section class="existing-roles mb-5">
                                <h5>Existing Roles</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Role</th>
                                                <th>Permissions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($roles as $role)
                                                <tr>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        @foreach ($role->permissions as $permission)
                                                            <span
                                                                class="badge badge-secondary">{{ $permission->name }}</span>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2">No roles found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </section>

                            {{-- Form to Create a New Role --}}
                            <section class="create-role">
                                <h5>Create New Role</h5>
                                <form method="POST" action="{{ route('roles.store') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Role
                                            Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="permissions"
                                            class="col-md-4 col-form-label text-md-right">Permissions</label>

                                        <div class="col-md-6">
                                            <select id="permissions"
                                                class="form-control @error('permissions') is-invalid @enderror"
                                                name="permissions[]" multiple required>
                                                @foreach ($permissions as $permission)
                                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('permissions')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
                                        <label for="new_permission" class="col-md-4 col-form-label text-md-right">Add New Permission (optional)</label>
                                
                                        <div class="col-md-6 input-group">
                                            <input id="new_permission" type="text" class="form-control @error('new_permission') is-invalid @enderror" name="new_permission" value="{{ old('new_permission') }}" autocomplete="new_permission" placeholder="Enter new permission name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="addPermissionBtn">Add</button>
                                            </div>
                                            @error('new_permission')
                                                <div class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="form-group row">
                                        <label for="new_permission" class="col-md-4 col-form-label text-md-right">Add New
                                            Permission (optional)</label>

                                        <div class="col-md-6 input-group">
                                            <input id="new_permission" type="text"
                                                class="form-control @error('new_permission') is-invalid @enderror"
                                                name="new_permission" value="{{ old('new_permission') }}"
                                                autocomplete="new_permission" placeholder="Enter new permission name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="addPermissionBtn"
                                                    onclick="addNewPermission()">Add</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-success">
                                                Create Role and Permission
                                            </button>
                                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </form>

                            </section>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create New Role</div>
        
                        <div class="card-body">
                            <div class="mb-4">
                                <h5>Existing Roles</h5>
                                <ul>
                                    @foreach ($roles as $role)
                                        <li>{{ $role->name }} - Permissions:
                                            @foreach ($role->permissions as $permission)
                                                {{ $permission->name }},
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
        
                            <hr>
        
                            <form method="POST" action="{{ route('roles.store') }}">
                                @csrf
        
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Role Name</label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="permissions" class="col-md-4 col-form-label text-md-right">Permissions (optional)</label>
        
                                    <div class="col-md-6">
                                        <select id="permissions" class="form-control @error('permissions') is-invalid @enderror" name="permissions[]" multiple>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
        
                                        @error('permissions')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="new_permission" class="col-md-4 col-form-label text-md-right">New Permission (optional)</label>
        
                                    <div class="col-md-6">
                                        <input id="new_permission" type="text" class="form-control @error('new_permission') is-invalid @enderror" name="new_permission" value="{{ old('new_permission') }}" autocomplete="new_permission" placeholder="Enter new permission name">
        
                                        @error('new_permission')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Create Role
                                        </button>
                                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create New Role</div>
        
                        <div class="card-body">
                            <div class="mb-4">
                                <h5>Existing Roles</h5>
                                <ul>
                                    @foreach ($roles as $role)
                                        <li>{{ $role->name }} - Permissions:
                                            @foreach ($role->permissions as $permission)
                                                {{ $permission->name }},
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
        
                            <hr>
        
                            <form method="POST" action="{{ route('roles.store') }}">
                                @csrf
        
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Role Name</label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="permissions" class="col-md-4 col-form-label text-md-right">Permissions (optional)</label>
        
                                    <div class="col-md-6">
                                        <select id="permissions" class="form-control @error('permissions') is-invalid @enderror" name="permissions[]" multiple>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
        
                                        @error('permissions')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Create Role
                                        </button>
                                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row">

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Roles Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
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

            </div> --}}



            <!-- Your other content here -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // document.getElementById('addPermissionBtn').addEventListener('click', function() {
        //     var newPermissionInput = document.getElementById('new_permission');
        //     var newPermissionValue = newPermissionInput.value.trim();

        //     if (newPermissionValue !== '') {
        //         // Append the new permission value to the permissions select list
        //         var permissionsSelect = document.getElementById('permissions');
        //         var newPermissionOption = document.createElement('option');
        //         newPermissionOption.value = newPermissionValue;
        //         newPermissionOption.text = newPermissionValue;
        //         permissionsSelect.appendChild(newPermissionOption);

        //         // Create a hidden input field to capture the new permission separately
        //         var newPermissionHiddenInput = document.createElement('input');
        //         newPermissionHiddenInput.type = 'hidden';
        //         newPermissionHiddenInput.name = 'new_permission[]';
        //         newPermissionHiddenInput.value = newPermissionValue;
        //         document.getElementById('form').appendChild(newPermissionHiddenInput);

        //         // Clear the new permission input field
        //         newPermissionInput.value = '';
        //     }
        // });

        $(document).ready(function() {
            // Add permission button click event
            $('#addPermissionBtn').click(function() {
                var newPermissionInput = $('#new_permission');
                var newPermission = newPermissionInput.val().trim();
                var permissionsSelect = $('#permissions');
                if (newPermission !== '') {
                    // Check if the new permission is not already selected
                    if (!$("option[value='" + newPermission + "']", permissionsSelect).length) {
                        permissionsSelect.append('<option value="' + newPermission + '" selected>' +
                            newPermission + '</option>');
                    }
                    newPermissionInput.val('');
                }
            });
        });
    </script>
@endpush
