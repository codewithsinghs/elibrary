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
                        <div class="card-header">
                            <div class="float-start">
                                Add New Role
                            </div>
                            <div class="float-end">
                                <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('roles.store') }}" method="post">
                                @csrf
            
                                <div class="mb-3 row">
                                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                                    <div class="col-md-6">
                                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
            
                                <div class="mb-3 row">
                                    <label for="permissions" class="col-md-4 col-form-label text-md-end text-start">Permissions</label>
                                    <div class="col-md-6">           
                                        <select class="form-select @error('permissions') is-invalid @enderror" multiple aria-label="Permissions" id="permissions" name="permissions[]" style="height: 210px;">
                                            @forelse ($permissions as $permission)
                                                <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions') ?? []) ? 'selected' : '' }}>
                                                    {{ $permission->name }}
                                                </option>
                                            @empty
            
                                            @endforelse
                                        </select>
                                        @if ($errors->has('permissions'))
                                            <span class="text-danger">{{ $errors->first('permissions') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Role">
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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

        // $(document).ready(function() {
        //     // Add permission button click event
        //     $('#addPermissionBtn').click(function() {
        //         var newPermissionInput = $('#new_permission');
        //         var newPermission = newPermissionInput.val().trim();
        //         var permissionsSelect = $('#permissions');
        //         if (newPermission !== '') {
        //             // Check if the new permission is not already selected
        //             if (!$("option[value='" + newPermission + "']", permissionsSelect).length) {
        //                 permissionsSelect.append('<option value="' + newPermission + '" selected>' +
        //                     newPermission + '</option>');
        //             }
        //             newPermissionInput.val('');
        //         }
        //     });
        // });
    </script>
@endpush
