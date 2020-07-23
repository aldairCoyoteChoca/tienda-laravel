@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Roles</h1>
        @can('roles.edit')
        <a href=" {{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary shadow-sm">Editar Role</a>
        @endcan
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $role->name }} </p>
                    <p><strong>Descripción:</strong> {{ $role->description }} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

