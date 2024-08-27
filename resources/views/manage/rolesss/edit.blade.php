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

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">Edit Role</div>
    
                        <div class="card-body">
                            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                                @csrf
                                @method('PUT')
    
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Role Name</label>
    
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}" required autofocus>
    
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="permissions" class="col-md-4 col-form-label text-md-right">Permissions</label>
    
                                    <div class="col-md-6">
                                        <select multiple id="permissions" class="form-control @error('permissions') is-invalid @enderror" name="permissions[]">
                                            @foreach($permissions as $permission)
                                                <option value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <select class="form-control" id="permissions" name="permissions[]" multiple>
                                            @foreach($permissions as $permission)
                                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select> --}}
    
                                        @error('permissions')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
    
                                <div class="form-group row">
                                    <label for="new_permission" class="col-md-4 col-form-label text-md-right">New Permission</label>
    
                                    <div class="col-md-6">
                                        <input id="new_permission" type="text" class="form-control @error('new_permission') is-invalid @enderror" name="new_permission" value="{{ old('new_permission') }}" autofocus>
    
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
                                            Update Role
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

          
        </div>
    </div>
@endsection

