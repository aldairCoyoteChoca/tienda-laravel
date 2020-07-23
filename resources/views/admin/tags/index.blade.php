@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="align-items-center justify-content-between mb-4 clearfix">
        <h1 class="h3 mb-0 text-gray-800 float-left">Etiquetas</h1>
        @can('tags.create')
        <a href=" {{ route('tags.create') }}" class="btn btn-sm btn-primary float-right">Crear etiquetas</a>
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
                    @foreach ($tags as $tag)
                    <tr>
                        {{-- <th scope="row"> {{ $tag->id }} </th> --}}
                        <th scope="row"> <small>{{ $tag->name }}</small></th>
                        <td width="10px">
                            @can('tags.show')
                            <a href=" {{ route('tags.show', $tag->id) }} " class="btn btn-sm btn-light"><i class="fas fa-eye"></i></a>
                            @endcan
                        </td>
                        <td width="10px">
                            @can('tags.edit')
                            <a href=" {{ route('tags.edit', $tag->id) }} " class="btn btn-sm btn-light"><i class="fas fa-highlighter"></i></a>
                            @endcan
                        </td>
                        <td width="10px">
                            @can('tags.destroy')
                            <button class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#modaldelete{{ $tag->id}}"><i class="fas fa-trash"></i></button>
                            @endcan
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="modaldelete{{ $tag->id}}" tabindex="-1" role="dialog" aria-labelledby="modaldeleteTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header mx-auto">
                                    <h5 class="modal-title mx-auto" id="modaldeleteTitle">{{ $tag->name }}</h5>
                                </div>
                                <div class="modal-body mx-auto">
                                    ¿Estás seguro de querer eliminar esta etiqueta?</h6>
                                </div>
                                <div class="mx-auto">
                                    <small>Esta acción no puede deshacerse.</small>
                                </div>
                                <div class="modal-footer mx-auto">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                                    {!! Form::open(['route' => ['tags.destroy', $tag->id],
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
            {{ $tags->render() }}
        </div>
    </div>
</div>
@endsection

