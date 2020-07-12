@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categorias
                    @can('categories.create')
                    <a href=" {{ route('categories.create') }}" class="btn btn-sm btn-primary float-right">Crear categoria</a>
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
                            @foreach ($categories as $category)
                            <tr>
                                <th scope="row"> {{ $category->id }} </th>
                                <th scope="row"> {{ $category->name }} </th>
                                <td width="10px">
                                    @can('categories.show')
                                    <a href=" {{ route('categories.show', $category->id) }} " class="btn btn-sm btn-success">Ver</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('categories.edit')
                                    <a href=" {{ route('categories.edit', $category->id) }} " class="btn btn-sm btn-info text-white">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('categories.destroy')
                                    {!! Form::open(['route' => ['categories.destroy', $category->id],
                                    'method' => 'DELETE']) !!}
                                    <button class="btn btn-sm btn-danger">Elminar</button>
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $categories->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
