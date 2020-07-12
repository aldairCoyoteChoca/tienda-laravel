@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Etiqueta
                    @can('tags.create')
                    <a href=" {{ route('tags.create') }}" class="btn btn-sm btn-primary float-right">Crear etiqueta</a>
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
                            @foreach ($tags as $tag)
                            <tr>
                                <th scope="row"> {{ $tag->id }} </th>
                                <th scope="row"> {{ $tag->name }} </th>
                                <td width="10px">
                                    @can('tags.show')
                                    <a href=" {{ route('tags.show', $tag->id) }} " class="btn btn-sm btn-success">Ver</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('tags.edit')
                                    <a href=" {{ route('tags.edit', $tag->id) }} " class="btn btn-sm btn-info text-white">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('tags.destroy')
                                    {!! Form::open(['route' => ['tags.destroy', $tag->id],
                                    'method' => 'DELETE']) !!}
                                    <button class="btn btn-sm btn-danger">Elminar</button>
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $tags->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
