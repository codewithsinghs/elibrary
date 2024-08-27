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

                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            Edit Role
                        </div>
                        <div class="float-end">
                            <a href="{{ route('roles.index') }}" class="btn btn-primary">&larr; Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-xs-12 mb-3">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        <input type="text" value="{{ $role->name }}" name="name"
                                            class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-xs-12 mb-3">
                                    <div class="form-group">
                                        <strong>Permission:</strong>
                                       <div class="row">
                                        @foreach ($permission as $value)
                                        <div class="col-md-auto col-sm-6">
                                            <label>
                                                <input type="checkbox" @if (in_array($value->id, $rolePermissions)) checked @endif
                                                    name="permissions[]" value="{{ $value->id }}" class="name">
                                                {{ $value->name }}</label>
                                            </div>
                                        @endforeach
                                    </div></div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>New Permissions:</strong>
                                        <input type="text" name="new_permissions" class="form-control"
                                            placeholder="Enter new permissions separated by commas">
                                    </div>
                                </div>
                                <div class="col-xs-12 mb-3 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
