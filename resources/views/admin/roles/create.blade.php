@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Role</h1>
        @can('roles.create')
        <a href=" {{ route('roles.create') }}" class="btn btn-sm btn-primary shadow-sm">Crear role</a>
        @endcan
    </div>
    <div class="card shadow mb-12">
        <div class="card-body">
            <div class="card-body">
                {!! Form::open(['route' => 'roles.store', 'files' => true]) !!}
                @include('admin.roles.partials.form')
               {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

