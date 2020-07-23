@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuario</h1>
        @can('users.edit')
        <a href=" {{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary shadow-sm">Editar usuario</a>
        @endcan
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-body">
                    @if ($user->photo)
                    <img src="{{ asset('/'.$user->photo) }}" class="card-img-top img-fluid">
                    @endif
                    <p><strong>Nombre:</strong> {{ $user->name }} </p>
                    <p><strong>Correo:</strong> {{ $user->email }} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

