@extends('layouts.app')

@section('main-content')
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Roles</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($roles as $role)
                                <li class="list-group-item">
                                    <span class="role-name">{{ $role->name }}</span>
                                    <ul class="permissions-list" style="display: none;">
                                        @foreach($role->permissions as $permission)
                                            <li>{{ $permission->name }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Permissions</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($permissions as $permission)
                                <li class="list-group-item">{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.role-name').click(function() {
                $(this).siblings('.permissions-list').toggle();
            });
        });
    </script>
@endsection
