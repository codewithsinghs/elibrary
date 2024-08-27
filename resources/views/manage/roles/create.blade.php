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
                            <form action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Name:</strong>
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group my-3">
                                            <strong>Permissions:</strong>
                                            <br />
                                            <div class="row mt-3">
                                                @foreach ($permissions as $permission)
                                                    <div class="col-md-auto col-sm-auto">
                                                        <label>
                                                            <input type="checkbox" name="permissions[]"
                                                                value="{{ $permission->name }}" class="name">
                                                            {{ $permission->name }}</label>
                                                        <br />
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>New Permissions:</strong>
                                            <input type="text" name="new_permissions" class="form-control"
                                                placeholder="Enter new permissions separated by commas">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                            {{-- <form action="{{ route('roles.store') }}" method="post">
                                @csrf

                                <div class="mb-3 row">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end text-start">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="permissions"
                                        class="col-md-4 col-form-label text-md-end text-start">Permissions</label>
                                    <div class="col-md-6">
                                        <select class="form-select @error('permissions') is-invalid @enderror" multiple
                                            aria-label="Permissions" id="permissions" name="permissions[]"
                                            style="height: 210px;">
                                            @forelse ($permissions as $permission)
                                                <option value="{{ $permission->id }}"
                                                    {{ in_array($permission->id, old('permissions') ?? []) ? 'selected' : '' }}>
                                                    {{ $permission->name }}
                                                </option>
                                            @empty
                                                <option value="" disabled>No permissions available</option>
                                            @endforelse
                                        </select>
                                        @if ($errors->has('permissions'))
                                            <span class="text-danger">{{ $errors->first('permissions') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="new_permission" class="col-md-4 col-form-label text-md-end text-start">New
                                        Permission(s)</label>
                                    <div class="col-md-6">
                                        <input type="text"
                                            class="form-control @error('new_permission') is-invalid @enderror"
                                            id="new_permission" name="new_permission" value="{{ old('new_permission') }}"
                                            placeholder="Enter new permission(s) separated by commas">
                                        @if ($errors->has('new_permission'))
                                            <span class="text-danger">{{ $errors->first('new_permission') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Role">
                                </div>
                            </form> --}}
                        </div>
                    </div>

                </div>
            </div>

            <!-- Your other content here -->
        </div>
    </div>
@endsection
