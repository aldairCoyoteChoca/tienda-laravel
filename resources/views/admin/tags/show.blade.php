@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Etiqueta</h1>
        @can('tags.edit')
        <a href=" {{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-primary shadow-sm">Editar etiqueta</a>
        @endcan
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-body">
                   <p><strong>Nombre:</strong> {{ $tag->name }} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
