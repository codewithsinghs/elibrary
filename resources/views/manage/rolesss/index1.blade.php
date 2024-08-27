@extends('layouts.app')

@section('main-content')
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-6">
                <div class="accordion" id="rolesAccordion">
                    @foreach($roles as $role)
                        <div class="card">
                            <div class="card-header" id="role{{ $role->id }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#rolePermissions{{ $role->id }}" aria-expanded="true" aria-controls="rolePermissions{{ $role->id }}">
                                        {{ $role->name }}
                                    </button>
                                </h2>
                            </div>
                            <div id="rolePermissions{{ $role->id }}" class="collapse" aria-labelledby="role{{ $role->id }}" data-parent="#rolesAccordion">
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($role->permissions as $permission)
                                            <li class="list-group-item">{{ $permission->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
@endsection
