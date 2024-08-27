@extends('layouts.app')

@section('headerTitle', 'Manage User Roles')
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
                            <h4 class="card-title">Profile Datatable</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Unic_ID</th>
                                            <th>Department</th>

                                            <th>Email</th>
                                            <th>Role / Position</th>

                                            <th>Action</th>
                                            <!-- New Column for Role Management -->

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <a href="{{ route('roles.edit', $role) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- @foreach ($usersWithRoles as $user)
                                            <tr>
                                                <td><img class="rounded-circle" width="35"
                                                    src="{{ asset('build/assets/images/profile/small/pic10.jpg') }}"
                                                    alt=""></td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->profile->unic_id ?? 'N/A' }}</td>
                                                <td>{{ $user->profile->department ?? 'N/A' }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <!-- Display user's current role -->
                                                    @foreach ($user->roles as $role)
                                                        {{ $role->name }}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <!-- Option to change role -->
                                                    <form action="{{ route('roles.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="role_id">
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->id }}">{{ $role->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit">Change Role</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                        {{-- @foreach ($usersWithRoles as $user)
                                            <tr>
                                                <td><img class="rounded-circle" width="35"
                                                        src="{{ asset('build/assets/images/profile/small/pic10.jpg') }}"
                                                        alt=""></td>
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
                                                <td>{{ $user->joining_date ?? 'Default Value' }}</td>

                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        <a href="{{ route('users.destroy', $user->id) }}"
                                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>

                                                        <form id="delete-form-{{ $user->id }}"
                                                            action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                            style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>
                                                <!-- Form to Change User's Role -->
                                                <td>
                                                     <form action="{{ route('roles.changeRole', $user->id) }}"
                                                       
                                                         method="POST">
                                                        @csrf
                                                        <select name="role_id">
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->id }}">{{ $role->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" class="btn btn-primary btn-xs">Change
                                                            Role</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div>
                                <h2>Roles</h2>
                                <a href="{{ route('roles.create') }}" class="btn btn-primary">Create Role</a>
                                <table>
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
                                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
