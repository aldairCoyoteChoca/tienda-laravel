@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Roles
                    @can('roles.create')
                    <a href=" {{ route('roles.create') }}" class="btn btn-sm btn-primary float-right">Crear Rol</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Ver</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <th scope="row"> {{ $role->id }} </th>
                                <th scope="row"> {{ $role->name }} </th>
                                <td width="10px">
                                    @can('roles.show')
                                    <a href=" {{ route('roles.show', $role->id) }} " class="btn btn-sm btn-success">Ver</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('roles.edit')
                                    <a href=" {{ route('roles.edit', $role->id) }} " class="btn btn-sm btn-info text-white">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('roles.destroy')
                                    {!! Form::open(['route' => ['roles.destroy', $role->id],
                                    'method' => 'DELETE']) !!}
                                    <button class="btn btn-sm btn-danger">Elminar</button>
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $roles->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
