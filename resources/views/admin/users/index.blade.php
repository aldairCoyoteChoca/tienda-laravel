@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuarios</div>
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
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row"> {{ $user->id }} </th>
                                <th scope="row"> {{ $user->name }} </th>
                                <td width="10px">
                                    @can('users.show')
                                    <a href=" {{ route('users.show', $user->id) }} " class="btn btn-sm btn-success">Ver</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('users.edit')
                                    <a href=" {{ route('users.edit', $user->id) }} " class="btn btn-sm btn-info text-white">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('users.destroy')
                                    {!! Form::open(['route' => ['users.destroy', $user->id],
                                    'method' => 'DELETE']) !!}
                                    <button class="btn btn-sm btn-danger">Elminar</button>
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $users->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
