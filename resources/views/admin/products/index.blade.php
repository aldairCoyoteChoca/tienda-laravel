@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Productos
                    @can('products.create')
                    <a href=" {{ route('products.create') }}" class="btn btn-sm btn-primary float-right">Crear producto</a>
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
                            @foreach ($products as $product)
                            <tr>
                                <th scope="row"> {{ $product->id }} </th>
                                <th scope="row"> {{ $product->name }} </th>
                                <td width="10px">
                                    @can('products.show')
                                    <a href=" {{ route('products.show', $product->id) }} " class="btn btn-sm btn-success">Ver</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('products.edit')
                                    <a href=" {{ route('products.edit', $product->id) }} " class="btn btn-sm btn-info text-white">Editar</a>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('products.destroy')
                                    {!! Form::open(['route' => ['products.destroy', $product->id],
                                    'method' => 'DELETE']) !!}
                                    <button class="btn btn-sm btn-danger">Elminar</button>
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $products->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
