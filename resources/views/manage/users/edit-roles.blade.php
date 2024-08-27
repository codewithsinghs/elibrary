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
                        <div class="card-header">
                            <h4 class="card-title">Roles Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="{{ route('users.roles.update', $user) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                
                                    <!-- Display user details -->
                                    <div>
                                        <p><strong>Name:</strong> {{ $user->name }}</p>
                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                        <!-- Add more user details as needed -->
                                
                                        <!-- Display current roles -->
                                        <p><strong>Current Role:</strong>
                                            @foreach($user->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </p>
                                    </div>
                                
                                    <!-- Display available roles and allow the user to select them -->
                                    <div class="form-group">
                                        <label for="roles">Roles:</label>
                                        <select name="roles[]" id="roles" class="form-control" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary">Update Roles</button>
                                </form>
                                
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @error('roles')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <!-- Display user details -->
                                        <div>
                                            <p><strong>Name:</strong> {{ $user->name }}</p>
                                            <p><strong>Email:</strong> {{ $user->email }}</p>
                                            <p><strong>Department:</strong> {{ $user->department }}</p>
                                            <!-- Add more user details as needed -->

                                            <!-- Display current roles -->
                                            <p><strong>Current Roles:</strong>
                                                @foreach ($user->roles as $role)
                                                    {{ $role->name }}
                                                    @unless ($loop->last)
                                                        ,
                                                    @endunless
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                @error('field_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <!-- User roles update form -->
                                <form action="{{ route('users.roles.update', $user) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Display available roles and allow the user to select them -->
                                    <div class="form-group">
                                        <label for="roles">Roles:</label>
                                        <select name="roles[]" id="roles" class="form-control" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Roles</button>
                                </form>

                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                                {{-- <form action="{{ route('users.roles.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                            
                                    <div class="form-group">
                                        <label for="roles">Roles</label><br>
                                        @foreach ($roles as $role)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="roles[]" id="role{{ $role->id }}" value="{{ $role->id }}" {{ $user->hasRole($role) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="role{{ $role->id }}">
                                                    {{ $role->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                            
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
