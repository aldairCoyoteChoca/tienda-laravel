@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="align-items-center justify-content-between mb-4 clearfix">
        <h1 class="h3 mb-0 text-gray-800 float-left">Categorias</h1>
        @can('categories.create')
        <a href=" {{ route('categories.create') }}" class="btn btn-sm btn-primary float-right">Crear categoria</a>
        @endcan
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table">
                <thead>
                  <tr>
                    {{-- <th scope="col">ID</th> --}}
                    <th scope="col">Nombre</th>
                    <th scope="col">Ver</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        {{-- <th scope="row"> {{ $category->id }} </th> --}}
                        <th scope="row"> <small>{{ $category->name }}</small></th>
                        <td width="10px">
                            @can('categories.show')
                            <a href=" {{ route('categories.show', $category->id) }} " class="btn btn-sm btn-light"><i class="fas fa-eye"></i></a>
                            @endcan
                        </td>
                        <td width="10px">
                            @can('categories.edit')
                            <a href=" {{ route('categories.edit', $category->id) }} " class="btn btn-sm btn-light"><i class="fas fa-highlighter"></i></a>
                            @endcan
                        </td>
                        <td width="10px">
                            @can('categories.destroy')
                            <button class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#modaldelete{{ $category->id}}"><i class="fas fa-trash"></i></button>
                            @endcan
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="modaldelete{{ $category->id}}" tabindex="-1" role="dialog" aria-labelledby="modaldeleteTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header mx-auto">
                                    <h5 class="modal-title mx-auto" id="modaldeleteTitle">{{ $category->name }}</h5>
                                </div>
                                <div class="modal-body mx-auto">
                                    ¿Estás seguro de querer eliminar esta categoria?</h6>
                                </div>
                                <div class="mx-auto">
                                    <small>Esta acción no puede deshacerse.</small>
                                </div>
                                <div class="modal-footer mx-auto">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                                    {!! Form::open(['route' => ['categories.destroy', $category->id],
                                    'method' => 'DELETE']) !!}
                                    <button class="btn btn-sm btn-danger text-white"><i class="fas fa-trash"></i> Eliminar</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mx-auto">
            {{ $categories->render() }}
        </div>
    </div>
</div>
@endsection

